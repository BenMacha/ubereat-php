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

namespace UberEats\Model\Delivery\Enum;

/**
 * @method static self SCHEDULED()
 * @method static self EN_ROUTE_TO_PICKUP()
 * @method static self ARRIVED_AT_PICKUP()
 * @method static self EN_ROUTE_TO_DROPOFF()
 * @method static self ARRIVED_AT_DROPOFF()
 * @method static self COMPLETED()
 * @method static self FAILED()
 */
class DeliveryState
{
    private const SCHEDULED = 'SCHEDULED';
    private const EN_ROUTE_TO_PICKUP = 'EN_ROUTE_TO_PICKUP';
    private const ARRIVED_AT_PICKUP = 'ARRIVED_AT_PICKUP';
    private const EN_ROUTE_TO_DROPOFF = 'EN_ROUTE_TO_DROPOFF';
    private const ARRIVED_AT_DROPOFF = 'ARRIVED_AT_DROPOFF';
    private const COMPLETED = 'COMPLETED';
    private const FAILED = 'FAILED';

    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $name
     * @param array<mixed> $arguments
     */
    public static function __callStatic(string $name, array $arguments): self
    {
        $const = constant("self::$name");

        return new self($const);
    }

    public static function fromString(string $value): self
    {
        $const = strtoupper($value);
        if (! defined("self::$const")) {
            return self::FAILED();
        }

        return new self(constant("self::$const"));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
