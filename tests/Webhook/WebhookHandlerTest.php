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

namespace UberEats\Tests\Webhook;

use PHPUnit\Framework\TestCase;
use UberEats\Exception\WebhookException;
use UberEats\Model\Webhook\Event\OrderNotificationEvent;
use UberEats\Webhook\WebhookHandler;

class WebhookHandlerTest extends TestCase
{
    private WebhookHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new WebhookHandler();
    }

    public function testHandleOrderNotification(): void
    {
        $payload = json_encode([
            'event_id' => '123',
            'event_type' => 'orders.notification',
            'event_time' => 1234567890,
            'resource_href' => 'https://api.uber.com/v1/orders/123',
            'meta' => [
                'resource_id' => 'order-123',
                'status' => 'ACTIVE',
            ],
        ]);
        $this->assertIsString($payload);

        $event = $this->handler->handle($payload);

        $this->assertInstanceOf(OrderNotificationEvent::class, $event);
        $this->assertEquals('orders.notification', $event->getEventType());
        $this->assertEquals('order-123', $event->orderId);
        $this->assertEquals('ACTIVE', $event->status);
    }

    public function testHandleInvalidJson(): void
    {
        $this->expectException(WebhookException::class);
        $this->handler->handle('invalid json');
    }

    public function testHandleUnknownEventType(): void
    {
        $payload = json_encode([
            'event_type' => 'unknown',
        ]);

        $this->assertIsString($payload);
        $this->expectException(WebhookException::class);
        $this->handler->handle($payload);
    }
}
