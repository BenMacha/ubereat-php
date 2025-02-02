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

namespace UberEats\Model\Delivery\Response;

use UberEats\Model\Delivery\Delivery;

/**
 * Response containing delivery information
 */
class DeliveryResponse
{
    private Delivery $delivery;

    private string $status;

    private ?string $message;

    public function __construct(
        Delivery $delivery,
        string $status,
        ?string $message = null
    ) {
        $this->delivery = $delivery;
        $this->status = $status;
        $this->message = $message;
    }

    public function getDelivery(): Delivery
    {
        return $this->delivery;
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
