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

namespace UberEats\Model\Store;

/**
 * Represents a menu item modifier in UberEats
 */
class Modifier
{
    private string $id;

    private string $name;

    private ?string $description;

    private float $price;

    private bool $required;

    private int $minQuantity;

    private int $maxQuantity;

    private bool $enabled;

    public function __construct(
        string $id,
        string $name,
        ?string $description = null,
        float $price = 0.0,
        bool $required = false,
        int $minQuantity = 0,
        int $maxQuantity = 1,
        bool $enabled = true
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->required = $required;
        $this->minQuantity = $minQuantity;
        $this->maxQuantity = $maxQuantity;
        $this->enabled = $enabled;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getMinQuantity(): int
    {
        return $this->minQuantity;
    }

    public function getMaxQuantity(): int
    {
        return $this->maxQuantity;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
