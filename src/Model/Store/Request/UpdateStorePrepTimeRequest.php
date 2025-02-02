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

namespace UberEats\Model\Store\Request;

/**
 * Request to update store preparation time
 */
class UpdateStorePrepTimeRequest
{
    private int $prepTime;

    private ?string $reason;

    public function __construct(
        int $prepTime,
        ?string $reason = null
    ) {
        $this->prepTime = $prepTime;
        $this->reason = $reason;
    }

    public function getPrepTime(): int
    {
        return $this->prepTime;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }
}
