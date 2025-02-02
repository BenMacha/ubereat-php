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

namespace UberEats\Model\Order\Enum;

/**
 * @method static self ITEM_ISSUE()
 * @method static self KITCHEN_CLOSED()
 * @method static self CUSTOMER_CALLED_TO_CANCEL()
 * @method static self RESTAURANT_TOO_BUSY()
 * @method static self ORDER_VALIDATION()
 * @method static self STORE_CLOSED()
 * @method static self TECHNICAL_FAILURE()
 * @method static self POS_NOT_READY()
 * @method static self POS_OFFLINE()
 * @method static self CAPACITY()
 * @method static self ADDRESS()
 * @method static self SPECIAL_INSTRUCTIONS()
 * @method static self PRICING()
 * @method static self UNKNOWN()
 * @method static self OTHER()
 */
class DenyReason
{
    private const ITEM_ISSUE = 'ITEM_ISSUE';
    private const KITCHEN_CLOSED = 'KITCHEN_CLOSED';
    private const CUSTOMER_CALLED_TO_CANCEL = 'CUSTOMER_CALLED_TO_CANCEL';
    private const RESTAURANT_TOO_BUSY = 'RESTAURANT_TOO_BUSY';
    private const ORDER_VALIDATION = 'ORDER_VALIDATION';
    private const STORE_CLOSED = 'STORE_CLOSED';
    private const TECHNICAL_FAILURE = 'TECHNICAL_FAILURE';
    private const POS_NOT_READY = 'POS_NOT_READY';
    private const POS_OFFLINE = 'POS_OFFLINE';
    private const CAPACITY = 'CAPACITY';
    private const ADDRESS = 'ADDRESS';
    private const SPECIAL_INSTRUCTIONS = 'SPECIAL_INSTRUCTIONS';
    private const PRICING = 'PRICING';
    private const UNKNOWN = 'UNKNOWN';
    private const OTHER = 'OTHER';

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
            return self::UNKNOWN();
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
