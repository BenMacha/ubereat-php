# Working with Deliveries

This guide explains how to work with deliveries using the UberEats PHP SDK.

## Getting Deliveries

```php
// Get a single delivery
$delivery = $client->getDelivery('delivery-id');

// List deliveries for a store
$deliveries = $client->listDeliveries('store-id');
```

## Managing Deliveries

### Create a Delivery

```php
use UberEats\Model\Delivery\Request\CreateDeliveryRequest;

$request = new CreateDeliveryRequest(
    orderId: 'order-id',
    pickupDetails: [
        'address' => '123 Pickup St',
        'instructions' => 'Ring doorbell',
    ],
    dropoffDetails: [
        'address' => '456 Dropoff Ave',
        'instructions' => 'Leave at door',
    ]
);

$response = $client->createDelivery($request);
```

### Update a Delivery

```php
use UberEats\Model\Delivery\Request\UpdateDeliveryRequest;

$request = new UpdateDeliveryRequest(
    dropoffDetails: [
        'instructions' => 'Updated instructions',
    ]
);

$response = $client->updateDelivery('delivery-id', $request);
```

### Cancel a Delivery

```php
use UberEats\Model\Delivery\Request\CancelDeliveryRequest;

$request = new CancelDeliveryRequest(
    reason: 'STORE_CLOSED'
);

$response = $client->cancelDelivery('delivery-id', $request);
```

### Get Tracking URL

```php
$trackingUrl = $client->getDeliveryTrackingUrl('delivery-id');
```