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
use UberEats\Client\DeliveryClient;
use UberEats\Exception\UberEatsException;
use UberEats\Model\Delivery\Delivery;
use UberEats\Model\Delivery\DeliveryCollection;
use UberEats\Model\Delivery\Enum\DeliveryState;
use UberEats\Model\Delivery\Request\CancelDeliveryRequest;
use UberEats\Model\Delivery\Request\CreateDeliveryRequest;
use UberEats\Model\Delivery\Request\UpdateDeliveryRequest;
use UberEats\Model\Delivery\Response\DeliveryResponse;

class DeliveryClientTest extends TestCase
{
    private MockHandler $mockHandler;

    private DeliveryClient $client;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->client = new DeliveryClient($httpClient, $this->serializer, 'test-token',  null);
    }

    public function testGetDelivery(): void
    {
        $delivery = new Delivery(
            'test-id',
            'test-order-id',
            null,
            DeliveryState::SCHEDULED(),
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );

        $this->mockHandler->append(new Response(200, [], json_encode($delivery)));
        $this->serializer->method('deserialize')->willReturn($delivery);

        $result = $this->client->getDelivery('test-delivery-id');

        $this->assertInstanceOf(Delivery::class, $result);
        $this->assertEquals($delivery, $result);
    }

    public function testListDeliveries(): void
    {
        $collection = new DeliveryCollection([], 0, 0, 10);

        $this->mockHandler->append(new Response(200, [], json_encode($collection)));
        $this->serializer->method('deserialize')->willReturn($collection);

        $result = $this->client->listDeliveries('test-store-id');

        $this->assertInstanceOf(DeliveryCollection::class, $result);
        $this->assertEquals($collection, $result);
    }

    public function testCreateDelivery(): void
    {
        $delivery = new Delivery(
            'test-id',
            'test-order-id',
            null,
            DeliveryState::SCHEDULED(),
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );

        $response = new DeliveryResponse($delivery, 'success');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new CreateDeliveryRequest(
            'test-order-id',
            null,
            [],
            []
        );

        $result = $this->client->createDelivery($request);

        $this->assertInstanceOf(DeliveryResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testUpdateDelivery(): void
    {
        $delivery = new Delivery(
            'test-id',
            'test-order-id',
            null,
            DeliveryState::SCHEDULED(),
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );

        $response = new DeliveryResponse($delivery, 'success');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new UpdateDeliveryRequest();
        $result = $this->client->updateDelivery('test-delivery-id', $request);

        $this->assertInstanceOf(DeliveryResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testCancelDelivery(): void
    {
        $delivery = new Delivery(
            'test-id',
            'test-order-id',
            null,
            DeliveryState::SCHEDULED(),
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );

        $response = new DeliveryResponse($delivery, 'cancelled');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new CancelDeliveryRequest('test-reason');
        $result = $this->client->cancelDelivery('test-delivery-id', $request);

        $this->assertInstanceOf(DeliveryResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testGetDeliveryTrackingUrl(): void
    {
        $trackingUrl = 'https://tracking.uber.com/delivery/123';

        $this->mockHandler->append(new Response(200, [], json_encode([
            'tracking_url' => $trackingUrl,
        ])));

        $result = $this->client->getDeliveryTrackingUrl('test-delivery-id');

        $this->assertEquals($trackingUrl, $result);
    }

    public function testApiError(): void
    {
        $this->mockHandler->append(new Response(400, [], json_encode([
            'error' => 'Bad Request',
            'message' => 'Invalid delivery ID',
        ])));

        $this->expectException(UberEatsException::class);
        $this->client->getDelivery('invalid-id');
    }
}
