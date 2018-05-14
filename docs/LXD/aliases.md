Helper methods for image aliases.

## List

List image aliases

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxc->images->aliases->list('local');
```

**Response**
``` json
[
    "/1.0/images/aliases/alias-name"
]
```

## Info

Get image alias information.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Alias name    |               |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxc->images->aliases->info('local', 'alias-name');
```

**Response**

``` json
{
    "description": "The alias description",
    "name": "alias-name",
    "target": "<image fingerprint>"
}
```

## Create

Get image alias information.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| options      | object        | Alias options     |           |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxc->images->aliases->create('local', [
    "description" => "The alias description",
    "target" => "<image fingerprint>",
    "name" => "alias-name"
]);
```

**Response**

``` json
{

}
```

## Replace

Replace alias target or description.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Alias name        |           |
| options      | object        | Alias options     |           |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxc->images->aliases->replace('local', 'alias-name', [
    "description" => "New description",
    "target" => "<image fingerprint>"
]);
```

**Response**

``` json
{
	
}
```

## Update

Update alias target or description.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Alias name        |           |
| options      | object        | Images options    |           |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxd->images->aliases->update('local', 'alias-name', [
    "description" => "New description",
    "target" => "<image fingerprint>"
]);
```

**Response**

``` json
{
	
}
```

## Rename

Rename an image alias.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | string        | Alias name        |           |
| options      | object        | Images options    |           |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxd->images->aliases->rename('local', 'alias-name', [
    "name": "new-name"
]);
```

**Response**

``` json
{
	
}
```

## Delete

Delete an image alias.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| name         | name          | Alias name    |               |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxd->images->aliases->delete('local', 'alias-name');
```

**Response**

``` json
{
	
}
```