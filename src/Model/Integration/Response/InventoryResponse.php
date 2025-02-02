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

namespace UberEats\Model\Integration\Response;

/**
 * Response containing inventory update status
 */
class InventoryResponse
{
    private string $status;

    private ?array $errors;

    private ?string $message;

    public function __construct(
        string $status,
        ?array $errors = null,
        ?string $message = null
    ) {
        $this->status = $status;
        $this->errors = $errors;
        $this->message = $message;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}
