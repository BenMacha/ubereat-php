# UberEats PHP SDK

[![Latest Stable Version](https://poser.pugx.org/ubereats/php-sdk/v/stable)](https://packagist.org/packages/ubereats/php-sdk)
[![Total Downloads](https://poser.pugx.org/ubereats/php-sdk/downloads)](https://packagist.org/packages/ubereats/php-sdk)
[![License](https://poser.pugx.org/ubereats/php-sdk/license)](https://packagist.org/packages/ubereats/php-sdk)
[![PHP Version Require](https://poser.pugx.org/ubereats/php-sdk/require/php)](https://packagist.org/packages/ubereats/php-sdk)

A modern PHP SDK for the UberEats API, supporting PHP 7.4 and above.

## Requirements

- PHP 7.4 or higher
- Composer
- Guzzle HTTP Client
- PSR-3 Logger (optional)

## Documentation

- [Getting Started](docs/getting-started.md)
- [Working with Orders](docs/orders.md)
- [Working with Stores](docs/stores.md)
- [Working with Deliveries](docs/deliveries.md)
- [Integration Features](docs/integration.md)

## Installation

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

## Available Methods

### Authentication
- `authenticate(string $clientId, string $clientSecret): AccessToken`

### Orders
- `getOrder(string $orderId): Order`
- `acceptOrder(string $orderId, AcceptOrderRequest $request): Order`
- `denyOrder(string $orderId, DenyOrderRequest $request): Order`
- `cancelOrder(string $orderId, CancelOrderRequest $request): Order`

### Stores
- `getStore(string $storeId): Store`
- `getStores(): StoreCollection`

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

## Error Handling

The SDK throws `UberEatsException` for any API errors. Each exception includes:
- HTTP status code
- Error message
- Original response data

```php
try {
    $order = $client->getOrder('invalid-id');
} catch (UberEatsException $e) {
    echo $e->getMessage();
    echo $e->getCode();
}
```

## Testing

```bash
composer test
```

## Static Analysis

```bash
composer phpstan
```

## Code Style

```bash
composer cs-fix
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This package is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.