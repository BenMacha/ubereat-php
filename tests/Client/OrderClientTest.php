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
use UberEats\Client\OrderClient;
use UberEats\Exception\UberEatsException;
use UberEats\Model\Order\Enum\CancelReason;
use UberEats\Model\Order\Enum\DenyReason;
use UberEats\Model\Order\Enum\OrderState;
use UberEats\Model\Order\Enum\OrderStatus;
use UberEats\Model\Order\Order;
use UberEats\Model\Order\OrderCollection;
use UberEats\Model\Order\Request\AcceptOrderRequest;
use UberEats\Model\Order\Request\CancelOrderRequest;
use UberEats\Model\Order\Request\DenyOrderRequest;
use UberEats\Model\Order\Response\OrderResponse;

class OrderClientTest extends TestCase
{
    private MockHandler $mockHandler;

    private OrderClient $client;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->client = new OrderClient($httpClient, $this->serializer, 'test-token', null);
    }

    public function testGetOrder(): void
    {
        $order = new Order(
            'test-id',
            'TEST-1234',
            null,
            OrderState::CREATED(),
            OrderStatus::ACTIVE(),
            new \DateTimeImmutable()
        );

        $this->mockHandler->append(new Response(200, [], json_encode($order)));
        $this->serializer->method('deserialize')->willReturn($order);

        $result = $this->client->getOrder('test-order-id');

        $this->assertInstanceOf(Order::class, $result);
        $this->assertEquals($order, $result);
    }

    public function testListOrders(): void
    {
        $collection = new OrderCollection([], 0, 0, 10);

        $this->mockHandler->append(new Response(200, [], json_encode($collection)));
        $this->serializer->method('deserialize')->willReturn($collection);

        $result = $this->client->listOrders('test-store-id');

        $this->assertInstanceOf(OrderCollection::class, $result);
        $this->assertEquals($collection, $result);
    }

    public function testAcceptOrder(): void
    {
        $order = new Order(
            'test-id',
            'TEST-1234',
            null,
            OrderState::ACCEPTED(),
            OrderStatus::ACTIVE(),
            new \DateTimeImmutable()
        );

        $response = new OrderResponse($order, 'accepted');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new AcceptOrderRequest();
        $result = $this->client->acceptOrder('test-order-id', $request);

        $this->assertInstanceOf(OrderResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testDenyOrder(): void
    {
        $order = new Order(
            'test-id',
            'TEST-1234',
            null,
            OrderState::FAILED(),
            OrderStatus::COMPLETED(),
            new \DateTimeImmutable()
        );

        $response = new OrderResponse($order, 'denied');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new DenyOrderRequest(DenyReason::STORE_CLOSED());
        $result = $this->client->denyOrder('test-order-id', $request);

        $this->assertInstanceOf(OrderResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testCancelOrder(): void
    {
        $order = new Order(
            'test-id',
            'TEST-1234',
            null,
            OrderState::FAILED(),
            OrderStatus::COMPLETED(),
            new \DateTimeImmutable()
        );

        $response = new OrderResponse($order, 'cancelled');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new CancelOrderRequest(CancelReason::STORE_CLOSED());
        $result = $this->client->cancelOrder('test-order-id', $request);

        $this->assertInstanceOf(OrderResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testApiError(): void
    {
        $this->mockHandler->append(new Response(400, [], json_encode([
            'error' => 'Bad Request',
            'message' => 'Invalid order ID',
        ])));

        $this->expectException(UberEatsException::class);
        $this->client->getOrder('invalid-id');
    }
}
