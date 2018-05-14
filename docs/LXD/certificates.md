Helper methods for certificates.

## List

List client certificates.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxc->certificates->list('local');
```

**Response**
``` json
[
    "/1.0/certificates/33c50480212ea93c0afbb8125c280b1a66445cac64706066ade30851f54cc8bx"
]
```

## Add

Add client certificate.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| options      | object        | Certificate options   |           |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxc->certificates->add('local', [
    "type" => "client",
    "certificate" => "PEM certificate",
    "name" => "foo",
    "password" => "server-trust-password"
]);
```

**Response**

``` json
{
    
}
```

## Info

Get certificate information.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| fingerprint  | string        | Certificate fingerprint |     |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxc->certificates->info('local', '33c50480212ea93c0afbb8125c280b1a66445cac64706066ade30851f54cc8bx');
```

**Response**

``` json
{
    "certificate": "-----BEGIN CERTIFICATE-----\n snip \n-----END CERTIFICATE-----\n",
    "fingerprint": "33c50480212ea93c0afbb8125c280b1a66445cac64706066ade30851f54cc8bx",
    "name": "",
    "type": "client"
}
```

## Replace

Replace certificate properties.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| fingerprint  | string        | Certificate fingerprint |     |
| options      | object        | Certificate options   |           |
| mutator      | function      | Mutation function |           |
 
``` javascript
$client->lxc->certificates->replace('local', '33c50480212ea93c0afbb8125c280b1a66445cac64706066ade30851f54cc8bx', [
    "type" => "client",
    "name" => "bar"
]);
```

**Response**

``` json
{
	
}
```

## Update

Update certificate properties.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| fingerprint  | string        | Certificate fingerprint |     |
| options      | object        | Certificate options   |           |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxd->certificates->update('local', '33c50480212ea93c0afbb8125c280b1a66445cac64706066ade30851f54cc8bx', [
    "name" => "baz"
]);
```

**Response**

``` json
{
	
}
```

## Delete

Delete a client certificate.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| fingerprint  | string        | Certificate fingerprint |     |
| mutator      | function      | Mutation function |           |

``` javascript
$client->lxd->certificates->delete('local', '33c50480212ea93c0afbb8125c280b1a66445cac64706066ade30851f54cc8bx');
```

**Response**

``` json
{
	
}
```