# Webhook Handling

The SDK provides a WebhookHandler class to process incoming webhooks from UberEats.

## Basic Usage

```php
use UberEats\Webhook\WebhookHandler;

$handler = new WebhookHandler();
$event = $handler->handle($payload);

switch ($event->type) {
    case 'orders.notification':
        handleOrderNotification($event);
        break;
    case 'orders.scheduled.notification':
        handleScheduledOrder($event);
        break;
    case 'delivery.state_changed':
        handleDeliveryStateChange($event);
        break;
    default:
        throw new \InvalidArgumentException('Unknown event type');
}
```

## Event Types

### Order Notification
Received when a new order is placed:

```php
if ($event instanceof OrderNotificationEvent) {
    echo $event->orderId;
    echo $event->status;
}
```

### Scheduled Order
Received when a scheduled order is placed:

```php
if ($event instanceof OrderScheduledEvent) {
    echo $event->orderId;
    echo $event->status;
}
```

### Delivery State Changed
Received when the delivery status changes:

```php
if ($event instanceof DeliveryStateChangedEvent) {
    echo $event->deliveryId;
    echo $event->currentState->value;
}
```

## Error Handling

The handler throws `WebhookException` for:
- Invalid JSON payload
- Unknown event types
- Missing required fields

```php
try {
    $event = $handler->handle($payload);
} catch (WebhookException $e) {
    // Handle error
}
```