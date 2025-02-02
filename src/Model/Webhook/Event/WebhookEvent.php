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

namespace UberEats\Model\Webhook\Event;

/**
 * Base class for all webhook events
 */
abstract class WebhookEvent
{
    private string $eventId;

    private string $eventType;

    private int $eventTime;

    private string $resourceHref;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        if (! isset($data['event_id'], $data['event_type'], $data['event_time'], $data['resource_href'])) {
            throw new \InvalidArgumentException('Missing required webhook event data');
        }

        $this->eventId = (string) $data['event_id'];
        $this->eventType = (string) $data['event_type'];
        $this->eventTime = (int) $data['event_time'];
        $this->resourceHref = (string) $data['resource_href'];
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getEventTime(): int
    {
        return $this->eventTime;
    }

    public function getResourceHref(): string
    {
        return $this->resourceHref;
    }
}
