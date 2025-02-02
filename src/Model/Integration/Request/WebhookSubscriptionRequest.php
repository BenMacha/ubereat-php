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

namespace UberEats\Model\Integration\Request;

/**
 * Request to create a webhook subscription
 */
class WebhookSubscriptionRequest
{
    private string $url;

    private array $events;

    private ?string $name;

    private ?array $authentication;

    /**
     * @param array<string> $events
     */
    public function __construct(
        string $url,
        array $events,
        ?string $name = null,
        ?array $authentication = null
    ) {
        $this->url = $url;
        $this->events = $events;
        $this->name = $name;
        $this->authentication = $authentication;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return array<string>
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAuthentication(): ?array
    {
        return $this->authentication;
    }
}
