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

namespace UberEats\Model\Integration;

/**
 * Represents a store's menu in UberEats
 */
class Menu
{
    private string $id;

    private string $storeId;

    /** @var array<MenuItem> */
    private array $items;

    /** @var array<Category> */
    private array $categories;

    /** @var array<Modifier> */
    private array $modifiers;

    private \DateTimeImmutable $lastUpdated;

    /**
     * @param array<MenuItem> $items
     * @param array<Category> $categories
     * @param array<Modifier> $modifiers
     */
    public function __construct(
        string $id,
        string $storeId,
        array $items,
        array $categories,
        array $modifiers,
        \DateTimeImmutable $lastUpdated
    ) {
        $this->id = $id;
        $this->storeId = $storeId;
        $this->items = $items;
        $this->categories = $categories;
        $this->modifiers = $modifiers;
        $this->lastUpdated = $lastUpdated;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStoreId(): string
    {
        return $this->storeId;
    }

    /**
     * @return array<MenuItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array<Category>
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return array<Modifier>
     */
    public function getModifiers(): array
    {
        return $this->modifiers;
    }

    public function getLastUpdated(): \DateTimeImmutable
    {
        return $this->lastUpdated;
    }
}
