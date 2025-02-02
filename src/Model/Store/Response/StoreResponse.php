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

namespace UberEats\Model\Store\Response;

use UberEats\Model\Store\Store;

/**
 * Response containing store information
 */
class StoreResponse
{
    private Store $store;

    private string $status;

    private ?string $message;

    public function __construct(
        Store $store,
        string $status,
        ?string $message = null
    ) {
        $this->store = $store;
        $this->status = $status;
        $this->message = $message;
    }

    public function getStore(): Store
    {
        return $this->store;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}
