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
 * Represents a menu category in UberEats
 */
class Category
{
    private string $id;

    private string $name;

    private ?string $description;

    private ?int $position;

    private ?array $items;

    private bool $enabled;

    public function __construct(
        string $id,
        string $name,
        ?string $description = null,
        ?int $position = null,
        ?array $items = null,
        bool $enabled = true
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->position = $position;
        $this->items = $items;
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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
