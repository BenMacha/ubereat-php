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

namespace UberEats\Model\Order;

use UberEats\Model\Order\Enum\OrderState;
use UberEats\Model\Order\Enum\OrderStatus;
use UberEats\Model\Store\Store;

/**
 * Represents an UberEats order
 */
class Order
{
    private string $id;

    private string $displayId;

    private ?string $externalId;

    private OrderState $state;

    private OrderStatus $status;

    private \DateTimeImmutable $createdAt;

    private ?Store $store;

    /** @var array<string, mixed>|null */
    private ?array $customers;

    /** @var array<string, mixed>|null */
    private ?array $deliveries;

    /** @var array<string, mixed>|null */
    private ?array $carts;

    /**
     * @param array<string, mixed>|null $customers
     * @param array<string, mixed>|null $deliveries
     * @param array<string, mixed>|null $carts
     */
    public function __construct(
        string $id,
        string $displayId,
        ?string $externalId,
        OrderState $state,
        OrderStatus $status,
        \DateTimeImmutable $createdAt,
        ?Store $store = null,
        ?array $customers = null,
        ?array $deliveries = null,
        ?array $carts = null
    ) {
        $this->id = $id;
        $this->displayId = $displayId;
        $this->externalId = $externalId;
        $this->state = $state;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->store = $store;
        $this->customers = $customers;
        $this->deliveries = $deliveries;
        $this->carts = $carts;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDisplayId(): string
    {
        return $this->displayId;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function getState(): OrderState
    {
        return $this->state;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getCustomers(): ?array
    {
        return $this->customers;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getDeliveries(): ?array
    {
        return $this->deliveries;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getCarts(): ?array
    {
        return $this->carts;
    }
}
