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
 * Represents a menu item in UberEats
 */
class MenuItem
{
    private string $id;

    private string $name;

    private string $description;

    private float $price;

    private ?string $imageUrl;

    private ?array $modifiers;

    private ?array $categories;

    private bool $available;

    private ?int $position;

    public function __construct(
        string $id,
        string $name,
        string $description,
        float $price,
        ?string $imageUrl = null,
        ?array $modifiers = null,
        ?array $categories = null,
        bool $available = true,
        ?int $position = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->modifiers = $modifiers;
        $this->categories = $categories;
        $this->available = $available;
        $this->position = $position;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function getModifiers(): ?array
    {
        return $this->modifiers;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }
}
