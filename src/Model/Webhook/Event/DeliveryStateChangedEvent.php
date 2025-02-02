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

use UberEats\Model\Delivery\Enum\DeliveryState;

/**
 * Event received when delivery status changes
 */
class DeliveryStateChangedEvent extends WebhookEvent
{
    public string $deliveryId;

    public string $orderId;

    public ?string $externalOrderId;

    public DeliveryState $currentState;

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (! isset($data['meta']['delivery_id'], $data['meta']['order_id'], $data['meta']['current_state'])) {
            throw new \InvalidArgumentException('Missing required delivery event data');
        }

        $this->deliveryId = (string) $data['meta']['delivery_id'];
        $this->orderId = (string) $data['meta']['order_id'];
        $this->externalOrderId = isset($data['meta']['external_order_id']) ? (string) $data['meta']['external_order_id'] : null;
        $this->currentState = DeliveryState::fromString((string) $data['meta']['current_state']);
    }
}
