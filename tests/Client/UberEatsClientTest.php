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
use UberEats\Client\UberEatsClient;
use UberEats\Model\Auth\AccessToken;
use UberEats\Model\Order\Enum\OrderState;
use UberEats\Model\Order\Enum\OrderStatus;
use UberEats\Model\Order\Order;
use UberEats\Model\Store\Store;

class UberEatsClientTest extends TestCase
{
    private MockHandler $mockHandler;

    private UberEatsClient $client;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->client = new UberEatsClient($httpClient, $this->serializer);
    }

    private function authenticate(): void
    {
        $token = new AccessToken('test_token', 'Bearer', 3600, 'eats.order');

        $this->mockHandler->append(new Response(200, [], json_encode([
            'access_token' => 'test_token',
            'token_type' => 'Bearer',
            'expires_in' => 3600,
            'scope' => 'eats.order',
        ])));

        $this->serializer->method('deserialize')
            ->willReturnCallback(function ($data, $type) use ($token) {
                if ($type === AccessToken::class) {
                    return $token;
                }

                return null;
            });

        $this->client->authenticate('client_id', 'client_secret');
    }

    public function testAuthenticate(): void
    {
        $token = new AccessToken('test_token', 'Bearer', 3600, 'eats.order');

        $this->mockHandler->append(new Response(200, [], json_encode([
            'access_token' => 'test_token',
            'token_type' => 'Bearer',
            'expires_in' => 3600,
            'scope' => 'eats.order',
        ])));

        $this->serializer->method('deserialize')
            ->willReturnCallback(function ($data, $type) use ($token) {
                if ($type === AccessToken::class) {
                    return $token;
                }

                return null;
            });

        $result = $this->client->authenticate('client_id', 'client_secret');

        $this->assertInstanceOf(AccessToken::class, $result);
        $this->assertEquals('test_token', $result->getAccessToken());
        $this->assertEquals('Bearer', $result->getTokenType());
        $this->assertEquals(3600, $result->getExpiresIn());
        $this->assertEquals('eats.order', $result->getScope());
    }

    public function testGetOrder(): void
    {
        $order = new Order(
            'test_order',
            'TEST-1234',
            null,
            OrderState::CREATED(),
            OrderStatus::ACTIVE(),
            new \DateTimeImmutable('2024-01-01T00:00:00Z')
        );

        $token = new AccessToken('test_token', 'Bearer', 3600, 'eats.order');

        $this->mockHandler->append(
            new Response(200, [], json_encode([
                'access_token' => 'test_token',
                'token_type' => 'Bearer',
                'expires_in' => 3600,
                'scope' => 'eats.order',
            ])),
            new Response(200, [], json_encode([
                'id' => 'test_order',
                'display_id' => 'TEST-1234',
                'state' => 'CREATED',
                'status' => 'ACTIVE',
                'created_at' => '2024-01-01T00:00:00Z',
            ]))
        );

        $this->serializer->method('deserialize')
            ->willReturnCallback(function ($data, $type) use ($token, $order) {
                if ($type === AccessToken::class) {
                    return $token;
                }
                if ($type === Order::class) {
                    return $order;
                }

                return null;
            });

        $this->client->authenticate('client_id', 'client_secret');
        $result = $this->client->getOrder('test_order');

        $this->assertInstanceOf(Order::class, $result);
        $this->assertEquals('test_order', $result->getId());
    }

    public function testGetStore(): void
    {
        $store = new Store(
            'test_store',
            'Test Store',
            'ONLINE',
            ['street' => '123 Test St'],
            'UTC',
            ['monday' => ['open' => '09:00', 'close' => '17:00']]
        );

        $token = new AccessToken('test_token', 'Bearer', 3600, 'eats.order');

        $this->mockHandler->append(
            new Response(200, [], json_encode([
                'access_token' => 'test_token',
                'token_type' => 'Bearer',
                'expires_in' => 3600,
                'scope' => 'eats.order',
            ])),
            new Response(200, [], json_encode([
                'id' => 'test_store',
                'name' => 'Test Store',
                'status' => 'ONLINE',
                'address' => ['street' => '123 Test St'],
                'timezone' => 'UTC',
                'hours' => ['monday' => ['open' => '09:00', 'close' => '17:00']],
            ]))
        );

        $this->serializer->method('deserialize')
            ->willReturnCallback(function ($data, $type) use ($token, $store) {
                if ($type === AccessToken::class) {
                    return $token;
                }
                if ($type === Store::class) {
                    return $store;
                }

                return null;
            });

        $this->client->authenticate('client_id', 'client_secret');
        $result = $this->client->getStore('test_store');

        $this->assertInstanceOf(Store::class, $result);
        $this->assertEquals('test_store', $result->getId());
    }
}
