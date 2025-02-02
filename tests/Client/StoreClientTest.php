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
use UberEats\Client\StoreClient;
use UberEats\Exception\UberEatsException;
use UberEats\Model\Store\Request\UpdateStoreRequest;
use UberEats\Model\Store\Request\UpdateStoreStatusRequest;
use UberEats\Model\Store\Response\StoreResponse;
use UberEats\Model\Store\Response\StoreStatusResponse;
use UberEats\Model\Store\Store;
use UberEats\Model\Store\StoreCollection;

class StoreClientTest extends TestCase
{
    private MockHandler $mockHandler;

    private StoreClient $client;

    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->mockHandler = new MockHandler();
        $handlerStack = HandlerStack::create($this->mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->client = new StoreClient($httpClient, $this->serializer, 'test-token', null);
    }

    public function testGetStores(): void
    {
        $collection = new StoreCollection([], 0, 0, 10);

        $this->mockHandler->append(new Response(200, [], json_encode($collection)));
        $this->serializer->method('deserialize')->willReturn($collection);

        $result = $this->client->getStores();

        $this->assertInstanceOf(StoreCollection::class, $result);
        $this->assertEquals($collection, $result);
    }

    public function testGetStore(): void
    {
        $store = new Store(
            'test-id',
            'Test Store',
            'ONLINE',
            ['street' => '123 Test St'],
            'UTC',
            ['monday' => ['open' => '09:00', 'close' => '17:00']]
        );

        $this->mockHandler->append(new Response(200, [], json_encode($store)));
        $this->serializer->method('deserialize')->willReturn($store);

        $result = $this->client->getStore('test-store-id');

        $this->assertInstanceOf(Store::class, $result);
        $this->assertEquals($store, $result);
    }

    public function testUpdateStore(): void
    {
        $store = new Store(
            'test-id',
            'Updated Store',
            'ONLINE',
            ['street' => '123 Test St'],
            'UTC',
            ['monday' => ['open' => '09:00', 'close' => '17:00']]
        );

        $response = new StoreResponse($store, 'success');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new UpdateStoreRequest('Updated Store');
        $result = $this->client->updateStore('test-store-id', $request);

        $this->assertInstanceOf(StoreResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testGetStoreStatus(): void
    {
        $response = new StoreStatusResponse('ONLINE');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);

        $result = $this->client->getStoreStatus('test-store-id');

        $this->assertInstanceOf(StoreStatusResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testUpdateStoreStatus(): void
    {
        $response = new StoreStatusResponse('OFFLINE', 'CLOSED');

        $this->mockHandler->append(new Response(200, [], json_encode($response)));
        $this->serializer->method('deserialize')->willReturn($response);
        $this->serializer->method('serialize')->willReturn('{}');

        $request = new UpdateStoreStatusRequest('OFFLINE', 'CLOSED');
        $result = $this->client->updateStoreStatus('test-store-id', $request);

        $this->assertInstanceOf(StoreStatusResponse::class, $result);
        $this->assertEquals($response, $result);
    }

    public function testApiError(): void
    {
        $this->mockHandler->append(new Response(400, [], json_encode([
            'error' => 'Bad Request',
            'message' => 'Invalid store ID',
        ])));

        $this->expectException(UberEatsException::class);
        $this->client->getStore('invalid-id');
    }
}
