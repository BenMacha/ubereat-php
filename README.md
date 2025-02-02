# UberEats PHP SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ubereats/php-sdk.svg?style=flat-square)](https://packagist.org/packages/ubereats/php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/ubereats/php-sdk.svg?style=flat-square)](https://packagist.org/packages/ubereats/php-sdk)
[![License](https://img.shields.io/github/license/ubereats/php-sdk.svg?style=flat-square)](LICENSE)
[![CI](https://github.com/BenMacha/ubereat-php/actions/workflows/ci.yml/badge.svg)](https://github.com/BenMacha/ubereat-php/actions/workflows/ci.yml)
[![PHP Version](https://img.shields.io/packagist/php-v/ubereats/php-sdk.svg?style=flat-square)](composer.json)
[![Build Status](https://img.shields.io/github/actions/workflow/status/ubereats/php-sdk/ci.yml?branch=main&style=flat-square)](https://github.com/ubereats/php-sdk/actions)
[![Code Coverage](https://img.shields.io/codecov/c/github/ubereats/php-sdk?style=flat-square)](https://codecov.io/gh/ubereats/php-sdk)
[![PHPStan](https://img.shields.io/badge/PHPStan-max-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)
[![PHP CS Fixer](https://img.shields.io/badge/PHP%20CS%20Fixer-PSR--12-brightgreen.svg?style=flat-square)](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)

A modern PHP SDK for the UberEats API, supporting PHP 7.4 and above.

## Features

- 🚀 Modern PHP 7.4+ with strict typing
- 🔒 Type-safe request/response objects
- 🧪 Comprehensive test coverage
- 📝 Detailed documentation
- 🔄 Webhook support
- 🛠️ PSR-3 logging support
- 🎯 PSR-12 coding standards
- 🔍 Static analysis with PHPStan level max

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

## Development

### Testing

```bash
composer test
```

### Static Analysis

```bash
composer phpstan
```

### Code Style

```bash
composer cs-fix
```

### Code Coverage

```bash
composer test-coverage
```

## Security

If you discover any security related issues, please email security@example.com instead of using the issue tracker.

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [BEN MECHA Ali](https://github.com/benmacha)
- [All Contributors](../../contributors)

## License

This package is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.