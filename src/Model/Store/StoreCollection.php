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
 * Collection of Store objects with pagination support
 *
 * @implements \IteratorAggregate<int, Store>
 */
class StoreCollection implements \IteratorAggregate, \Countable
{
    /** @var array<Store> */
    private array $stores;

    private int $total;

    private int $offset;

    private int $limit;

    /**
     * @param array<Store> $stores
     */
    public function __construct(
        array $stores,
        int $total,
        int $offset,
        int $limit
    ) {
        $this->stores = $stores;
        $this->total = $total;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * @return \ArrayIterator<int, Store>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->stores);
    }

    public function count(): int
    {
        return count($this->stores);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
