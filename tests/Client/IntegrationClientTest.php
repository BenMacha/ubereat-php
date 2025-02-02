<?php

declare(strict_types=1);

/**
 * PHP version 7.4 - 8.4 .
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * https://www.php.net/license/3_01.txt.
 *
 * POS developed by Ben Macha.
 *
 * @category   UberEat SDK
 *
 * @author     Ali BEN MECHA       <contact@benmacha.tn>
 *
 * @copyright  Ⓒ 2025 benmacha.tn
 *
 * @see       https://www.benmacha.tn
 *
 */

namespace UberEats\Tests\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;
use UberEats\Client\IntegrationClient;
use UberEats\Exception\UberEatsException;
use UberEats\Model\Integration\Menu;
use UberEats\Model\Integration\Request\UpdateInventoryRequest;
use UberEats\Model\Integration\Request\UpdateMenuRequest;
use UberEats\Model\Integration\Request\WebhookSubscriptionRequest;
use UberEats\Model\Integration\Response\InventoryResponse;
use UberEats\Model\Integration\Response\MenuResponse;
use UberEats\Model\Integration\Response\WebhookSubscriptionResponse;

class IntegrationClientTest extends TestCase
{
    private MockHandler $mockHandler;

    private IntegrationClient $client;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->client = new IntegrationClient($httpClient, $this->serializer, 'test-token', null);
    }

    public function testGetMenu(): void
    {
        $menu = new Menu(
            'test-menu-id',
            'test-store-id',
            [],
            [],
            [],
            new \DateTimeImmutable()
        );

        $this->mockHandler->append(new Response(200, [], json_encode($menu)));
        $this->serializer->method('deserialize')->willReturn($menu);

        $result = $this->client->getMenu('test-store-id');

        $this->assertInstanceOf(Menu::class, $result);
        $this->assertEquals($menu, $result);
    }

    public function testUpdateMenu(): void
    {
        $menu = new Menu(
            'test-menu-id',
            'test-store-id',
            [],
            [],
            [],
            new \DateTimeImmutable()
        );

        $response = new MenuResponse($menu, 'success');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new UpdateMenuRequest([], [], [], true);

        $result = $this->client->updateMenu('test-store-id', $request);

        $this->assertInstanceOf(MenuResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testUpdateInventory(): void
    {
        $response = new InventoryResponse('success');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new UpdateInventoryRequest([
            'item-1' => ['available' => true, 'quantity' => 10],
        ]);

        $result = $this->client->updateInventory('test-store-id', $request);

        $this->assertInstanceOf(InventoryResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testCreateWebhookSubscription(): void
    {
        $response = new WebhookSubscriptionResponse(
            'test-subscription-id',
            'https://example.com/webhook',
            ['orders.notification'],
            'active'
        );

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new WebhookSubscriptionRequest(
            'https://example.com/webhook',
            ['orders.notification']
        );

        $result = $this->client->createWebhookSubscription($request);

        $this->assertInstanceOf(WebhookSubscriptionResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testDeleteWebhookSubscription(): void
    {
        $this->mockHandler->append(new Response(204));

        $this->client->deleteWebhookSubscription('test-subscription-id');

        // Assert no exception was thrown
        $this->assertTrue(true);
    }

    public function testListWebhookSubscriptions(): void
    {
        $subscriptions = [
            new WebhookSubscriptionResponse(
                'test-subscription-id',
                'https://example.com/webhook',
                ['orders.notification'],
                'active'
            ),
        ];

        $this->mockHandler->append(new Response(200, [], json_encode($subscriptions)));
        $this->serializer->method('deserialize')->willReturn($subscriptions);

        $result = $this->client->listWebhookSubscriptions();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertInstanceOf(WebhookSubscriptionResponse::class, $result[0]);
    }

    public function testApiError(): void
    {
        $this->mockHandler->append(new Response(400, [], json_encode([
            'error' => 'Bad Request',
            'message' => 'Invalid store ID',
        ])));

        $this->expectException(UberEatsException::class);
        $this->client->getMenu('invalid-id');
    }
}
