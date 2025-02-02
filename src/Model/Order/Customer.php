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

namespace UberEats\Model\Order;

/**
 * Represents a customer in an order
 */
class Customer
{
    private string $id;

    private string $firstName;

    private string $lastName;

    private string $phone;

    private ?string $email;

    private ?array $deliveryAddress;

    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $phone,
        ?string $email = null,
        ?array $deliveryAddress = null
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getDeliveryAddress(): ?array
    {
        return $this->deliveryAddress;
    }
}
