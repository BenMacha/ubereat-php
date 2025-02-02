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

namespace UberEats\Model\Delivery;

use UberEats\Model\Delivery\Enum\DeliveryState;

/**
 * Represents a delivery in the UberEats system
 */
class Delivery
{
    private string $id;

    private string $orderId;

    private ?string $externalOrderId;

    private DeliveryState $state;

    private \DateTimeImmutable $createdAt;

    private \DateTimeImmutable $updatedAt;

    private ?string $trackingUrl;

    private ?array $pickupDetails;

    private ?array $dropoffDetails;

    private ?array $courier;

    public function __construct(
        string $id,
        string $orderId,
        ?string $externalOrderId,
        DeliveryState $state,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt,
        ?string $trackingUrl = null,
        ?array $pickupDetails = null,
        ?array $dropoffDetails = null,
        ?array $courier = null
    ) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->externalOrderId = $externalOrderId;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->trackingUrl = $trackingUrl;
        $this->pickupDetails = $pickupDetails;
        $this->dropoffDetails = $dropoffDetails;
        $this->courier = $courier;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getExternalOrderId(): ?string
    {
        return $this->externalOrderId;
    }

    public function getState(): DeliveryState
    {
        return $this->state;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function getPickupDetails(): ?array
    {
        return $this->pickupDetails;
    }

    public function getDropoffDetails(): ?array
    {
        return $this->dropoffDetails;
    }

    public function getCourier(): ?array
    {
        return $this->courier;
    }
}
