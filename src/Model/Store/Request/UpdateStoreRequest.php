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
 * Request to update store information
 */
class UpdateStoreRequest
{
    private ?string $name;

    private ?array $address;

    private ?string $phone;

    private ?string $email;

    private ?array $hours;

    private ?array $settings;

    public function __construct(
        ?string $name = null,
        ?array $address = null,
        ?string $phone = null,
        ?string $email = null,
        ?array $hours = null,
        ?array $settings = null
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
        $this->hours = $hours;
        $this->settings = $settings;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAddress(): ?array
    {
        return $this->address;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getHours(): ?array
    {
        return $this->hours;
    }

    public function getSettings(): ?array
    {
        return $this->settings;
    }
}
