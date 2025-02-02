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
 * @method static self CREATED()
 * @method static self OFFERED()
 * @method static self ACCEPTED()
 * @method static self HANDED_OFF()
 * @method static self SUCCEEDED()
 * @method static self FAILED()
 * @method static self UNKNOWN()
 */
class OrderState
{
    private const CREATED = 'CREATED';
    private const OFFERED = 'OFFERED';
    private const ACCEPTED = 'ACCEPTED';
    private const HANDED_OFF = 'HANDED_OFF';
    private const SUCCEEDED = 'SUCCEEDED';
    private const FAILED = 'FAILED';
    private const UNKNOWN = 'UNKNOWN';

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
