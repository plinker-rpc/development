Helper methods for networks.

## List

List networks.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| mutator      | function      | Mutation function |           |
 
``` php
$client->lxd->networks->list('local');
```

**Response**
``` json
[
    "/1.0/networks/lxdbr0",
    "/1.0/networks/lo"
]
```

## Info

Get network information.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Network name  |               |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->networks->info('local', 'lxdbr0');
```

**Response**

``` json
{
    "config": {
        "ipv4.address": "10.158.250.1/24",
        "ipv4.nat": "true",
        "ipv6.address": "fd42:a224:5bde:20c0::1/64",
        "ipv6.nat": "true"
    },
    "description": "",
    "managed": true,
    "name": "lxdbr0",
    "type": "bridge",
    "used_by": [
        "/1.0/containers/my-container"
    ]
}
```

## Create

Create network.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| options      | object        | Network options   |           |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->networks->create('local', [
    "name" => "my-network",
    "description" => "My network",
    "config" => [
        "ipv4.address" => "none",
        "ipv6.address" => "2001:470:b368:4242::1/64",
        "ipv6.nat" => "true"
    ]
]);
```

**Response**

``` json
{
    
}
```

## Replace

Replace the network information.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Network name  |               |
| options      | object        | Network options   |           |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->networks->replace('local', [
    "config" => [
        "ipv4.address" => "none",
        "ipv6.address" => "2001:470:b368:4242::1/64",
        "ipv6.nat" => "true"
    ]
]);
```

**Response**

``` json
{
	
}
```

## Update

Update the network information.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Network name  |               |
| options      | object        | Network options   |           |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->networks->update('local', [
    "name" => "my-network",
    "description" => "My network",
    "config" => [
         "dns.mode" => "dynamic"
    ]
]);
```

**Response**

``` json
{
	
}
```

## Rename

Rename a network.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Network name  |               |
| newName      | string        | New network name  |           |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->networks->rename('local', 'old-name', 'new-name');
```

**Response**

``` json
{
	
}
```

## Delete

Delete a network.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Network name  |               |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->networks->delete('local', 'network-name');
```

**Response**

``` json
{
	
}
```