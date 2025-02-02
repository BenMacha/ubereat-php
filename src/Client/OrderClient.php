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

namespace UberEats\Client;

use UberEats\Exception\UberEatsException;
use UberEats\Model\Order\Order;
use UberEats\Model\Order\OrderCollection;
use UberEats\Model\Order\Request\AcceptOrderRequest;
use UberEats\Model\Order\Request\CancelOrderRequest;
use UberEats\Model\Order\Request\DenyOrderRequest;
use UberEats\Model\Order\Response\OrderResponse;

/**
 * Client for managing UberEats orders
 */
class OrderClient extends AbstractClient
{
    /**
     * Get order details
     *
     * @throws UberEatsException
     */
    public function getOrder(string $orderId): Order
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/order/{$orderId}", [
                'headers' => $this->getHeaders(),
            ]);

            return $this->deserialize($response->getBody()->getContents(), Order::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * List orders for a store
     *
     * @throws UberEatsException
     */
    public function listOrders(string $storeId): OrderCollection
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/store/{$storeId}/orders", [
                'headers' => $this->getHeaders(),
            ]);

            return $this->deserialize($response->getBody()->getContents(), OrderCollection::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to list orders: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Accept an order
     *
     * @throws UberEatsException
     */
    public function acceptOrder(string $orderId, AcceptOrderRequest $request): OrderResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/order/{$orderId}/accept", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            return $this->deserialize($response->getBody()->getContents(), OrderResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to accept order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Deny an order
     *
     * @throws UberEatsException
     */
    public function denyOrder(string $orderId, DenyOrderRequest $request): OrderResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/order/{$orderId}/deny", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            return $this->deserialize($response->getBody()->getContents(), OrderResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to deny order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Cancel an order
     *
     * @throws UberEatsException
     */
    public function cancelOrder(string $orderId, CancelOrderRequest $request): OrderResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/order/{$orderId}/cancel", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            return $this->deserialize($response->getBody()->getContents(), OrderResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to cancel order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
