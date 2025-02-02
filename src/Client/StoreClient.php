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
use UberEats\Model\Store\Request\UpdateStorePrepTimeRequest;
use UberEats\Model\Store\Request\UpdateStoreRequest;
use UberEats\Model\Store\Request\UpdateStoreStatusRequest;
use UberEats\Model\Store\Response\StoreResponse;
use UberEats\Model\Store\Response\StoreStatusResponse;
use UberEats\Model\Store\Store;
use UberEats\Model\Store\StoreCollection;

/**
 * Client for managing UberEats stores
 */
class StoreClient extends AbstractClient
{
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

            /** @var StoreCollection */
            return $this->deserialize($response->getBody()->getContents(), StoreCollection::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get stores: ' . $e->getMessage(), $e->getCode(), $e);
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

            /** @var Store */
            return $this->deserialize($response->getBody()->getContents(), Store::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get store: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update store information
     *
     * @throws UberEatsException
     */
    public function updateStore(string $storeId, UpdateStoreRequest $request): StoreResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/store/{$storeId}", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var StoreResponse */
            return $this->deserialize($response->getBody()->getContents(), StoreResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to update store: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get store status
     *
     * @throws UberEatsException
     */
    public function getStoreStatus(string $storeId): StoreStatusResponse
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/store/{$storeId}/status", [
                'headers' => $this->getHeaders(),
            ]);

            /** @var StoreStatusResponse */
            return $this->deserialize($response->getBody()->getContents(), StoreStatusResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get store status: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update store status
     *
     * @throws UberEatsException
     */
    public function updateStoreStatus(string $storeId, UpdateStoreStatusRequest $request): StoreStatusResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/store/{$storeId}/update-store-status", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var StoreStatusResponse */
            return $this->deserialize($response->getBody()->getContents(), StoreStatusResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to update store status: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update store preparation time
     *
     * @throws UberEatsException
     */
    public function updateStorePrepTime(string $storeId, UpdateStorePrepTimeRequest $request): StoreResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/store/{$storeId}/update-store-prep-time", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var StoreResponse */
            return $this->deserialize($response->getBody()->getContents(), StoreResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to update store prep time: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
