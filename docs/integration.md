# Integration Features

This guide explains how to use integration features of the UberEats PHP SDK.

## Menu Management

### Get Menu

```php
$menu = $client->getMenu('store-id');
```

### Update Menu

```php
use UberEats\Model\Integration\Request\UpdateMenuRequest;

$request = new UpdateMenuRequest(
    items: [
        [
            'id' => 'item-1',
            'name' => 'Burger',
            'price' => 9.99,
        ],
    ],
    categories: [
        [
            'id' => 'cat-1',
            'name' => 'Main Dishes',
        ],
    ],
    modifiers: [],
    replaceExisting: true
);

$response = $client->updateMenu('store-id', $request);
```

## Inventory Management

```php
use UberEats\Model\Integration\Request\UpdateInventoryRequest;

$request = new UpdateInventoryRequest(
    items: [
        'item-1' => [
            'available' => true,
            'quantity' => 10,
        ],
    ]
);

$response = $client->updateInventory('store-id', $request);
```

## Webhook Management

### Create Subscription

```php
use UberEats\Model\Integration\Request\WebhookSubscriptionRequest;

$request = new WebhookSubscriptionRequest(
    url: 'https://your-domain.com/webhook',
    events: ['orders.notification', 'delivery.state_changed']
);

$response = $client->createWebhookSubscription($request);
```

### List Subscriptions

```php
$subscriptions = $client->listWebhookSubscriptions();
```

### Delete Subscription

```php
$client->deleteWebhookSubscription('subscription-id');
```