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

namespace UberEats\Model\Delivery\Request;

/**
 * Request to cancel a delivery
 */
class CancelDeliveryRequest
{
    private string $reason;

    private ?string $details;

    public function __construct(
        string $reason,
        ?string $details = null
    ) {
        $this->reason = $reason;
        $this->details = $details;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }
}
