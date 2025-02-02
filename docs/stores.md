# Working with Stores

This guide explains how to work with stores using the UberEats PHP SDK.

## Getting Stores

```php
// Get all stores
$stores = $client->getStores();

// Get a single store
$store = $client->getStore('store-id');
```

## Managing Stores

### Update Store Information

```php
use UberEats\Model\Store\Request\UpdateStoreRequest;

$request = new UpdateStoreRequest(
    name: 'Updated Store Name',
    phone: '+1234567890'
);

$response = $client->updateStore('store-id', $request);
```

### Update Store Status

```php
use UberEats\Model\Store\Request\UpdateStoreStatusRequest;

$request = new UpdateStoreStatusRequest(
    status: 'OFFLINE',
    reason: 'CLOSED'
);

$response = $client->updateStoreStatus('store-id', $request);
```

### Update Preparation Time

```php
use UberEats\Model\Store\Request\UpdateStorePrepTimeRequest;

$request = new UpdateStorePrepTimeRequest(
    prepTime: 30
);

$response = $client->updateStorePrepTime('store-id', $request);
```