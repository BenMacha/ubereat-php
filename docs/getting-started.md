# Getting Started with UberEats PHP SDK

This guide will help you get started with the UberEats PHP SDK.

## Installation

Install the SDK using Composer:

```bash
composer require ubereats/php-sdk
```

## Basic Usage

```php
use UberEats\Client\UberEatsClient;

// Create client instance
$client = new UberEatsClient();

// Authenticate
$token = $client->authenticate(
    clientId: 'your-client-id',
    clientSecret: 'your-client-secret'
);

// Get order details
$order = $client->getOrder('order-id');

// Get store details
$store = $client->getStore('store-id');
```

## Client Classes

The SDK provides several specialized clients for different aspects of the UberEats API:

- `UberEatsClient`: Main client for common operations
- `OrderClient`: Order management
- `StoreClient`: Store management
- `DeliveryClient`: Delivery management
- `IntegrationClient`: Menu and webhook management

## Error Handling

The SDK throws `UberEatsException` for any API errors:

```php
try {
    $order = $client->getOrder('invalid-id');
} catch (UberEatsException $e) {
    echo $e->getMessage();
    echo $e->getCode();
}
```

## Webhook Handling

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