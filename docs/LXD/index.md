## LXD

[![Build Status](https://travis-ci.org/plinker/lxd.svg?branch=master)](https://travis-ci.org/plinker/lxd)
[![StyleCI](https://styleci.io/repos/REPO_ID_CHANGE_THIS/shield?branch=master)](https://styleci.io/repos/REPO_ID_CHANGE_THIS)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/plinker/lxd/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/plinker/lxd/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/plinker/lxd/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/plinker/lxd/code-structure/master/code-coverage)
[![Packagist Version](https://img.shields.io/packagist/v/plinker/lxd.svg?style=flat-square)](https://github.com/plinker/lxd/releases)
[![Packagist Downloads](https://img.shields.io/packagist/dt/plinker/lxd.svg?style=flat-square)](https://packagist.org/packages/plinker/lxd)

Control LXD through RPC which uses the local instance of LXD and `lxc query` to manage local or remote LXD servers.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/lxd
```

## Setup

The webserver user must be able to execute `lxc` commands, so add the user to sudoers file:

```
# User privilege specification
root     ALL=(ALL:ALL) ALL
www-data ALL=(ALL:ALL) NOPASSWD: /usr/bin/lxc
```

## Client

Creating a client instance is done as follows:


    <?php
    require 'vendor/autoload.php';

    /**
     * Initialize plinker client.
     *
     * @param string $server - URL to server listener.
     * @param string $config - server secret, and/or a additional component data
     */
    $client = new \Plinker\Core\Client(
        'http://example.com/server.php',
        [
            'secret' => 'a secret password'
        ]
    );
    
    // or using global function
    $client = plinker_client('http://example.com/server.php', 'a secret password');
    
## Basic Usage

Essentially you can do any LXD operation with the single `$client->lxd->query()` method, or you can use the [helper methods](https://plinker-rpc.github.io/lxd/)  which cover all the LXD endpoints.

**Parameters & Call**

| Parameter    | Type          | Description   | Default                     |
| ----------   | ------------- | ------------- | -------------               | 
| remote       | string        | LXD remote and endpoint            | local |
| rest method  | string        | e.g GET, POST, DELETE, PUT, PATCH  | GET    |
| payload      | object \| json string | Rest json payload          |        |
| mutator      | function      | Pre-resolve mutation function      |        |

```
$client->lxd->query('remote:/1.0', 'GET', []);
```

## Full Documentation

To view the complete docs for this component including all methods see: [https://plinker-rpc.github.io/lxd/](https://plinker-rpc.github.io/lxd/)

## Methods

Once setup, you call the class though its namespace to its method, see docs for further details.

## List Containers

List containers on remote.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->containers->list('local', function ($result) {
    return str_replace('/1.0/containers/', '', $result);    
});
```

**Response**
``` text
Array
(
    [0] => my-container
)
```

## Testing

There are no tests setup for this component.

## Contributing

Please see [CONTRIBUTING](https://github.com/plinker-rpc/lxd/blob/master/CONTRIBUTING) for details.

## Security

If you discover any security related issues, please contact me via [https://cherone.co.uk](https://cherone.co.uk) instead of using the issue tracker.

## Credits

- [Lawrence Cherone](https://github.com/lcherone)
- [All Contributors](https://github.com/plinker-rpc/lxd/graphs/contributors)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/lxd/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.
