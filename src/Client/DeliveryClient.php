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
use UberEats\Model\Delivery\Delivery;
use UberEats\Model\Delivery\DeliveryCollection;
use UberEats\Model\Delivery\Request\CancelDeliveryRequest;
use UberEats\Model\Delivery\Request\CreateDeliveryRequest;
use UberEats\Model\Delivery\Request\UpdateDeliveryRequest;
use UberEats\Model\Delivery\Response\DeliveryResponse;

/**
 * Client for managing UberEats deliveries
 */
class DeliveryClient extends AbstractClient
{
    /**
     * Get delivery details
     *
     * @throws UberEatsException
     */
    public function getDelivery(string $deliveryId): Delivery
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/{$deliveryId}", [
                'headers' => $this->getHeaders(),
            ]);

            /** @var Delivery */
            return $this->deserialize($response->getBody()->getContents(), Delivery::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get delivery: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * List deliveries for a store
     *
     * @throws UberEatsException
     */
    public function listDeliveries(string $storeId): DeliveryCollection
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/store/{$storeId}/deliveries", [
                'headers' => $this->getHeaders(),
            ]);

            /** @var DeliveryCollection */
            return $this->deserialize($response->getBody()->getContents(), DeliveryCollection::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to list deliveries: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Create a new delivery
     *
     * @throws UberEatsException
     */
    public function createDelivery(CreateDeliveryRequest $request): DeliveryResponse
    {
        try {
            $response = $this->httpClient->request('POST', '/v1/delivery', [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var DeliveryResponse */
            return $this->deserialize($response->getBody()->getContents(), DeliveryResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to create delivery: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update delivery details
     *
     * @throws UberEatsException
     */
    public function updateDelivery(string $deliveryId, UpdateDeliveryRequest $request): DeliveryResponse
    {
        try {
            $response = $this->httpClient->request('PUT', "/v1/delivery/{$deliveryId}", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var DeliveryResponse */
            return $this->deserialize($response->getBody()->getContents(), DeliveryResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to update delivery: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Cancel a delivery
     *
     * @throws UberEatsException
     */
    public function cancelDelivery(string $deliveryId, CancelDeliveryRequest $request): DeliveryResponse
    {
        try {
            $response = $this->httpClient->request('POST', "/v1/delivery/{$deliveryId}/cancel", [
                'headers' => $this->getHeaders(),
                'json' => $this->serialize($request),
            ]);

            /** @var DeliveryResponse */
            return $this->deserialize($response->getBody()->getContents(), DeliveryResponse::class);
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to cancel delivery: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get delivery tracking URL
     *
     * @throws UberEatsException
     */
    public function getDeliveryTrackingUrl(string $deliveryId): string
    {
        try {
            $response = $this->httpClient->request('GET', "/v1/delivery/{$deliveryId}/tracking-url", [
                'headers' => $this->getHeaders(),
            ]);

            $data = $this->decodeResponse($response->getBody()->getContents());
            if (! isset($data['tracking_url'])) {
                throw new UberEatsException('Missing tracking URL in response');
            }

            return (string) $data['tracking_url'];
        } catch (\Exception $e) {
            throw new UberEatsException('Failed to get delivery tracking URL: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
