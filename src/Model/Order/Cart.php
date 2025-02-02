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

/**
 * Represents a customer's cart in an order
 */
class Cart
{
    private string $id;

    private array $items;

    private float $subtotal;

    private float $tax;

    private float $total;

    private ?array $discounts;

    private ?array $fees;

    public function __construct(
        string $id,
        array $items,
        float $subtotal,
        float $tax,
        float $total,
        ?array $discounts = null,
        ?array $fees = null
    ) {
        $this->id = $id;
        $this->items = $items;
        $this->subtotal = $subtotal;
        $this->tax = $tax;
        $this->total = $total;
        $this->discounts = $discounts;
        $this->fees = $fees;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getDiscounts(): ?array
    {
        return $this->discounts;
    }

    public function getFees(): ?array
    {
        return $this->fees;
    }
}
