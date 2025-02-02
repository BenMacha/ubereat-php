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

use GuzzleHttp\Client;
use UberEats\Exception\UberEatsException;
use UberEats\Model\Auth\AccessToken;
use UberEats\Model\Order\Order;
use UberEats\Model\Order\Request\AcceptOrderRequest;
use UberEats\Model\Order\Request\CancelOrderRequest;
use UberEats\Model\Order\Request\DenyOrderRequest;
use UberEats\Model\Store\Store;
use UberEats\Model\Store\StoreCollection;

/**
 * Main client for interacting with UberEats API
 */
class UberEatsClient extends AbstractClient
{
    /**
     * Authenticate with OAuth2 credentials
     *
     * @throws UberEatsException
     */
    public function authenticate(string $clientId, string $clientSecret): AccessToken
    {
        try {
            $response = $this->httpClient->request('POST', '/oauth/v2/token', [
                'form_params' => [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $data = json_decode((string) $response->getBody(), true);

            /** @var AccessToken $accessToken */
            $accessToken = $this->deserialize(json_encode($data), AccessToken::class);
            $this->setAccessToken($accessToken->getAccessToken());

            return $accessToken;
        } catch (\Exception $e) {
            throw new UberEatsException('Authentication failed: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

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
     * Get store details
     *
     * @throws UberEatsException
     */
    public function getStore(string $storeId): Store
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/store/{$storeId}", [
                'headers' => $this->getHeaders(),
            ]);

            return $this->deserialize($response->getBody()->getContents(), Store::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get store: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get list of stores
     *
     * @throws UberEatsException
     */
    public function getStores(): StoreCollection
    {
        try {
            $response = $this->httpClient->request('GET', '/v1/delivery/stores', [
                'headers' => $this->getHeaders(),
            ]);

            return $this->deserialize($response->getBody()->getContents(), StoreCollection::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get stores: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Accept an order
     *
     * @throws UberEatsException
     */
    public function acceptOrder(string $orderId, AcceptOrderRequest $request): Order
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/order/{$orderId}/accept", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            return $this->deserialize($response->getBody()->getContents(), Order::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to accept order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Deny an order
     *
     * @throws UberEatsException
     */
    public function denyOrder(string $orderId, DenyOrderRequest $request): Order
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/order/{$orderId}/deny", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            return $this->deserialize($response->getBody()->getContents(), Order::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to deny order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Cancel an order
     *
     * @throws UberEatsException
     */
    public function cancelOrder(string $orderId, CancelOrderRequest $request): Order
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/order/{$orderId}/cancel", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            return $this->deserialize($response->getBody()->getContents(), Order::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to cancel order: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
