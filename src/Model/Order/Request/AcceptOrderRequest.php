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

/**
 * Request to accept an order
 */
class AcceptOrderRequest
{
    private ?string $readyForPickupTime;

    private ?string $externalId;

    private ?string $acceptedBy;

    public function __construct(
        ?string $readyForPickupTime = null,
        ?string $externalId = null,
        ?string $acceptedBy = null
    ) {
        $this->readyForPickupTime = $readyForPickupTime;
        $this->externalId = $externalId;
        $this->acceptedBy = $acceptedBy;
    }

    public function getReadyForPickupTime(): ?string
    {
        return $this->readyForPickupTime;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function getAcceptedBy(): ?string
    {
        return $this->acceptedBy;
    }
}
