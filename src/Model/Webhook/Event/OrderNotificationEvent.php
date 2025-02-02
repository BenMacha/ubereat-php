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
 * Event received when a new order is placed
 */
class OrderNotificationEvent extends WebhookEvent
{
    public string $orderId;

    public string $status;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! isset($data['meta']['resource_id'], $data['meta']['status'])) {
            throw new \InvalidArgumentException('Missing required order notification data');
        }

        $this->orderId = (string) $data['meta']['resource_id'];
        $this->status = (string) $data['meta']['status'];
    }
}
