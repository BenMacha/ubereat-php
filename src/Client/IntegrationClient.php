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
use UberEats\Model\Integration\Menu;
use UberEats\Model\Integration\Request\UpdateInventoryRequest;
use UberEats\Model\Integration\Request\UpdateMenuRequest;
use UberEats\Model\Integration\Request\WebhookSubscriptionRequest;
use UberEats\Model\Integration\Response\InventoryResponse;
use UberEats\Model\Integration\Response\MenuResponse;
use UberEats\Model\Integration\Response\WebhookSubscriptionResponse;

/**
 * Client for managing UberEats integrations
 */
class IntegrationClient extends AbstractClient
{
    /**
     * Get menu for a store
     *
     * @throws UberEatsException
     */
    public function getMenu(string $storeId): Menu
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/store/{$storeId}/menu", [
                'headers' => $this->getHeaders(),
            ]);

            /** @var Menu */
            return $this->deserialize($response->getBody()->getContents(), Menu::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get menu: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update menu for a store
     *
     * @throws UberEatsException
     */
    public function updateMenu(string $storeId, UpdateMenuRequest $request): MenuResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/store/{$storeId}/menu", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var MenuResponse */
            return $this->deserialize($response->getBody()->getContents(), MenuResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to update menu: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update inventory for a store
     *
     * @throws UberEatsException
     */
    public function updateInventory(string $storeId, UpdateInventoryRequest $request): InventoryResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/store/{$storeId}/inventory", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var InventoryResponse */
            return $this->deserialize($response->getBody()->getContents(), InventoryResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to update inventory: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Create webhook subscription
     *
     * @throws UberEatsException
     */
    public function createWebhookSubscription(WebhookSubscriptionRequest $request): WebhookSubscriptionResponse
    {
        try {
            $response = $this->httpClient->request('POST', '/v1/delivery/webhooks', [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var WebhookSubscriptionResponse */
            return $this->deserialize($response->getBody()->getContents(), WebhookSubscriptionResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to create webhook subscription: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Delete webhook subscription
     *
     * @throws UberEatsException
     */
    public function deleteWebhookSubscription(string $subscriptionId): void
    {
        try {
            $this->httpClient->request('DELETE', "/v1/delivery/webhooks/{$subscriptionId}", [
                'headers' => $this->getHeaders(),
            ]);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to delete webhook subscription: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * List webhook subscriptions
     *
     * @return array<WebhookSubscriptionResponse>
     * @throws UberEatsException
     */
    public function listWebhookSubscriptions(): array
    {
        try {
            $response = $this->httpClient->request('GET', '/v1/delivery/webhooks', [
                'headers' => $this->getHeaders(),
            ]);

            /** @var array<WebhookSubscriptionResponse> */
            return $this->deserialize(
                $response->getBody()->getContents(),
                sprintf('array<%s>', WebhookSubscriptionResponse::class)
            );
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to list webhook subscriptions: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
