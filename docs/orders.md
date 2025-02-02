# Working with Orders

This guide explains how to work with orders using the UberEats PHP SDK.

## Getting Orders

```php
// Get a single order
$order = $client->getOrder('order-id');

// List orders for a store
$orders = $client->listOrders('store-id');
```

## Managing Orders

### Accept an Order

```php
use UberEats\Model\Order\Request\AcceptOrderRequest;

$request = new AcceptOrderRequest(
    readyForPickupTime: '2024-01-01T12:00:00Z'
);

$response = $client->acceptOrder('order-id', $request);
```

### Deny an Order

```php
use UberEats\Model\Order\Request\DenyOrderRequest;
use UberEats\Model\Order\Enum\DenyReason;

$request = new DenyOrderRequest(
    reason: DenyReason::STORE_CLOSED
);

$response = $client->denyOrder('order-id', $request);
```

### Cancel an Order

```php
use UberEats\Model\Order\Request\CancelOrderRequest;
use UberEats\Model\Order\Enum\CancelReason;

$request = new CancelOrderRequest(
    reason: CancelReason::STORE_CLOSED
);

$response = $client->cancelOrder('order-id', $request);
```