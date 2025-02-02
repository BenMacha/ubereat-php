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

use UberEats\Model\Integration\Menu;

/**
 * Response containing menu information
 */
class MenuResponse
{
    private Menu $menu;

    private string $status;

    private ?string $message;

    public function __construct(
        Menu $menu,
        string $status,
        ?string $message = null
    ) {
        $this->menu = $menu;
        $this->status = $status;
        $this->message = $message;
    }

    public function getMenu(): Menu
    {
        return $this->menu;
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
