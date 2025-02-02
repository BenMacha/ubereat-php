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
 * Request to update an existing delivery
 */
class UpdateDeliveryRequest
{
    private ?array $pickupDetails;

    private ?array $dropoffDetails;

    private ?array $items;

    private ?array $specialInstructions;

    public function __construct(
        ?array $pickupDetails = null,
        ?array $dropoffDetails = null,
        ?array $items = null,
        ?array $specialInstructions = null
    ) {
        $this->pickupDetails = $pickupDetails;
        $this->dropoffDetails = $dropoffDetails;
        $this->items = $items;
        $this->specialInstructions = $specialInstructions;
    }

    public function getPickupDetails(): ?array
    {
        return $this->pickupDetails;
    }

    public function getDropoffDetails(): ?array
    {
        return $this->dropoffDetails;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function getSpecialInstructions(): ?array
    {
        return $this->specialInstructions;
    }
}
