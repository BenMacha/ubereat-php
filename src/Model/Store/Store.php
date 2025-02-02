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

namespace UberEats\Model\Store;

/**
 * Represents a store in UberEats
 */
class Store
{
    private string $id;

    private string $name;

    private string $status;

    /** @var array<string, mixed> */
    private array $address;

    private string $timezone;

    /** @var array<string, array<string, string>> */
    private array $hours;

    private ?string $phone;

    private ?string $email;

    /** @var array<string, mixed>|null */
    private ?array $pos;

    /** @var array<string, mixed>|null */
    private ?array $settings;

    /**
     * @param array<string, mixed> $address
     * @param array<string, array<string, string>> $hours
     * @param array<string, mixed>|null $pos
     * @param array<string, mixed>|null $settings
     */
    public function __construct(
        string $id,
        string $name,
        string $status,
        array $address,
        string $timezone,
        array $hours,
        ?string $phone = null,
        ?string $email = null,
        ?array $pos = null,
        ?array $settings = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->address = $address;
        $this->timezone = $timezone;
        $this->hours = $hours;
        $this->phone = $phone;
        $this->email = $email;
        $this->pos = $pos;
        $this->settings = $settings;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAddress(): array
    {
        return $this->address;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function getHours(): array
    {
        return $this->hours;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getPos(): ?array
    {
        return $this->pos;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getSettings(): ?array
    {
        return $this->settings;
    }
}
