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

namespace UberEats\Model\Order\Request;

use UberEats\Model\Order\Enum\DenyReason;

/**
 * Request to deny an order
 */
class DenyOrderRequest
{
    private DenyReason $reason;

    private ?string $info;

    public function __construct(
        DenyReason $reason,
        ?string $info = null
    ) {
        $this->reason = $reason;
        $this->info = $info;
    }

    public function getReason(): DenyReason
    {
        return $this->reason;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }
}
