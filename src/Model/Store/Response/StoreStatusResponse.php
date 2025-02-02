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

/**
 * Response containing store status information
 */
class StoreStatusResponse
{
    private string $status;

    private ?string $reason;

    private ?string $reopenAt;

    public function __construct(
        string $status,
        ?string $reason = null,
        ?string $reopenAt = null
    ) {
        $this->status = $status;
        $this->reason = $reason;
        $this->reopenAt = $reopenAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function getReopenAt(): ?string
    {
        return $this->reopenAt;
    }
}
