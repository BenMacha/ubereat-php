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

namespace UberEats\Webhook;

use UberEats\Exception\WebhookException;
use UberEats\Model\Webhook\Event\DeliveryStateChangedEvent;
use UberEats\Model\Webhook\Event\OrderNotificationEvent;
use UberEats\Model\Webhook\Event\OrderScheduledEvent;
use UberEats\Model\Webhook\Event\WebhookEvent;

/**
 * Handles incoming webhooks from UberEats
 */
class WebhookHandler
{
    /**
     * Handle an incoming webhook payload
     *
     * @throws WebhookException
     */
    public function handle(string $payload): WebhookEvent
    {
        $data = json_decode($payload, true);

        if (! is_array($data)) {
            throw new WebhookException('Invalid JSON payload');
        }

        if (! isset($data['event_type'])) {
            throw new WebhookException('Missing event type');
        }

        $eventType = $data['event_type'];

        switch ($eventType) {
            case 'orders.notification':
                return new OrderNotificationEvent($data);
            case 'orders.scheduled.notification':
                return new OrderScheduledEvent($data);
            case 'delivery.state_changed':
                return new DeliveryStateChangedEvent($data);
            default:
                throw new WebhookException('Unknown event type');
        }
    }
}
