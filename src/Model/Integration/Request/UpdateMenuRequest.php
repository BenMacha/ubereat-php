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

namespace UberEats\Model\Integration\Request;

/**
 * Request to update a store's menu
 */
class UpdateMenuRequest
{
    private array $items;

    private array $categories;

    private array $modifiers;

    private bool $replaceExisting;

    public function __construct(
        array $items,
        array $categories,
        array $modifiers,
        bool $replaceExisting = false
    ) {
        $this->items = $items;
        $this->categories = $categories;
        $this->modifiers = $modifiers;
        $this->replaceExisting = $replaceExisting;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getModifiers(): array
    {
        return $this->modifiers;
    }

    public function isReplaceExisting(): bool
    {
        return $this->replaceExisting;
    }
}
