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
 * Request to update store inventory
 */
class UpdateInventoryRequest
{
    /**
     * @var array<string, array{available: bool, quantity?: int}>
     */
    private array $items;

    /**
     * @param array<string, array{available: bool, quantity?: int}> $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return array<string, array{available: bool, quantity?: int}>
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
