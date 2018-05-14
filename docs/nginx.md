# Nginx

The aim of this component is to build web forwards/reverse proxy to LXD/LXC 
containers on the host (or external upstreams), not as a `server{}` block configurator.

The component uses nginx as a reverse proxy, it relies on php7-fpm being 
installed and will overwrite `/etc/nginx/nginx.conf`! So if you already have
nginx installed then dont use this component as it will most likely break your stuff.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/nginx
```

Then navigate to `./vendor/plinker/nginx/scripts` and run `bash install.sh`.


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
            'secret' => 'a secret password',
            // database connection
            'database' => [
                'dsn'      => 'sqlite:./.plinker/database.db',
                'host'     => '',
                'name'     => '',
                'username' => '',
                'password' => '',
                'freeze'   => false,
                'debug'    => false,
            ]
        ]
    );
    
    // or using global function
    $client = plinker_client('http://example.com/server.php', 'a secret password', [
        // database connection
        'database' => [
            'dsn'      => 'sqlite:./.plinker/database.db',
            'host'     => '',
            'name'     => '',
            'username' => '',
            'password' => '',
            'freeze'   => false,
            'debug'    => false,
        ]
    ]);
    

## Methods

Once setup, you call the class though its namespace to its method.


### Setup

Applies build tasks to plinker/tasks queue.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| options     | array          | Build options |                |

**Call**

    $client->nginx->setup([
        'build_sleep' => 5,
        'reconcile_sleep' => 5,
    ]);

**Response**
``` text
```

### Update Package

Runs composer update to update package.

**Call**

    $client->nginx->update_package();

**Response**
``` text
```

### Add

Add a web proxy rule.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| data        | array          | Rule data     |                |

**Call**

    $client->nginx->addBlock([
        'label' => 'My website nginx route',
        'ownDomain' => [
            'example.com',
            'www.example.com'
        ],
        'ownUpstream' => [
            ['ip' => '10.158.250.5', 'port' => '80']
        ],
        'letsencrypt' => 1,
        'enabled' => 1
    ]);
    
**Response**

``` text
Array
(
    [status] => success
    [values] => Array
        (
            [id] => 1
            [label] => My website nginx route
            [name] => c094c6c1-0fa1-40f1-af66-60e173e8dbac
            [ssl_type] => letsencrypt
            [added] => 2018-05-13 17:25:51
            [updated] => 2018-05-13 17:25:51
            [has_change] => 1
            [has_error] => 0
            [delete] => 0
            [enabled] => 1
            [update_ip] => 0
            [ip] => 10.158.250.5
            [port] => 80
            [ownDomain] => Array
                (
                    [0] => Array
                        (
                            [id] => 1
                            [name] => example.com
                            [route_id] => 1
                        )

                    [1] => Array
                        (
                            [id] => 2
                            [name] => www.example.com
                            [route_id] => 1
                        )

                )

            [ownUpstream] => Array
                (
                    [0] => Array
                        (
                            [id] => 1
                            [ip] => 10.158.250.5
                            [port] => 80
                            [route_id] => 1
                        )

                )

        )

)
```

### Update Block

Update a web proxy rule.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| placeholder | string         | Query placeholder |            |
| values      | array          | Match values      |            |
| data        | array          | Updated rule data |            |

**Call**

    client->nginx->update('name = ?', ['b2f78de7-5994-4c21-9c55-76cefe327a67'], [
        'label' => $test_route_label,
        'ownDomain' => [
            'updated-example.com',
            'www.updated-example.com'
        ],
        'ownUpstream' => [
            ['ip' => '10.158.250.5', 'port' => '80']
        ],
        'letsencrypt' => 0,
        'enabled' => 1
    ]);
    
**Response**

``` text

Array
(
    [status] => success
    [values] => Array
        (
            [id] => 3
            [label] => Example
            [name] => b2f78de7-5994-4c21-9c55-76cefe327a67
            [ssl_type] => 
            [added] => 2018-05-12 20:17:09
            [updated] => 2018-05-13 17:28:50
            [has_change] => 1
            [has_error] => 1
            [delete] => 0
            [enabled] => 1
            [update_ip] => 0
            [ip] => 10.158.250.5
            [port] => 80
            [error] => {}
            [ownDomain] => Array
                (
                    [0] => Array
                        (
                            [id] => 9
                            [name] => updated-example.com
                            [route_id] => 3
                        )

                    [1] => Array
                        (
                            [id] => 10
                            [name] => www.updated-example.com
                            [route_id] => 3
                        )

                )

            [ownUpstream] => Array
                (
                    [0] => Array
                        (
                            [id] => 5
                            [ip] => 10.158.250.5
                            [port] => 80
                            [route_id] => 3
                        )

                )

        )

)
```

### Remove

Remove web proxy rule.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| placeholder | string         | Query placeholder |            |
| values      | array          | Match values  |                |

**Call**

    ruleById(1)   - $client->nginx->remove('id = ?', [1]);
    ruleByName(1) - $client->nginx->remove('name = ?', ['guidV4-value'])
    
**Response**
``` text
Array
(
    [status] => success
)
```

### Reset

Remove all web proxy rules.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| purge       | bool           | Also remove tasks | `false`    |

**Call**

    $client->nginx->reset();     // remove just rules
    $client->nginx->reset(true); // remove rules and tasks (purge)
  
**Response**
``` text
Array
(
    [status] => success
)
```

### Fetch

Fetch currently configured web proxy rules from database.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| placeholder | string         | Query placeholder | |
| values      | array          | Match values  |              |

**Call**

    all           - $client->nginx->fetch();
    ruleById(1)   - $client->nginx->fetch('id = ?', [1]);
    ruleByName(1) - $client->nginx->fetch('name = ?', ['guidV4-value'])
    
**Response**
``` text
Array
(
    [0] => Array
        (
            [id] => 1
            [label] => Example
            [name] => 9801e216-a663-4f21-a3f5-047be2b3b9c9
            [ssl_type] => 
            [added] => 2018-05-12 19:52:58
            [updated] => 2018-05-12 19:52:58
            [has_change] => 0
            [has_error] => 0
            [delete] => 0
            [enabled] => 1
            [update_ip] => 0
            [ip] => 10.158.250.5
            [port] => 80
            [error] => 
            [ownDomain] => Array
                (
                    [0] => Array
                        (
                            [id] => 1
                            [name] => example.com
                            [route_id] => 2
                        )

                    [1] => Array
                        (
                            [id] => 2
                            [name] => www.example.com
                            [route_id] => 2
                        )

                )

            [ownUpstream] => Array
                (
                    [0] => Array
                        (
                            [id] => 1
                            [ip] => 10.158.250.5
                            [port] => 80
                            [route_id] => 2
                        )

                )

        )
)
```


### Count

Fetch count of currently configured web proxy rules from database.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| placeholder | string         | Query placeholder | |
| values      | array          | Match values  |              |

**Call**

    all           - $client->nginx->count();
    ruleById(1)   - $client->nginx->count('id = ?', [1]);
    ruleByName(1) - $client->nginx->count('name = ?', ['guidV4-value'])
    
**Response**
``` text
1
```

### Rebuild

Rebuild web proxy rule.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| placeholder | string         | Query placeholder | |
| values      | array          | Match values  |              |

**Call**

    ruleById(1)   - $client->nginx->rebuild('id = ?', [1]);
    ruleByName(1) - $client->nginx->rebuild('name = ?', ['guidV4-value'])
    
**Response**
``` text
Array
(
    [status] => success
)
```

### Status

Enumarate and return status of nginx connections.

**Call**

    $client->nginx->status();
    
**Response**

``` text
Array
(
    [active_connections] => 2
    [accepts] => 579
    [handled] => 579
    [requests] => 579
    [reading] => 0
    [writing] => 2
    [waiting] => 0
)
```

## Testing

There are no tests setup for this component.

## Contributing

Please see [CONTRIBUTING](https://github.com/plinker-rpc/nginx/blob/master/CONTRIBUTING) for details.

## Security

If you discover any security related issues, please contact me via [https://cherone.co.uk](https://cherone.co.uk) instead of using the issue tracker.

## Credits

- [Lawrence Cherone](https://github.com/lcherone)
- [All Contributors](https://github.com/plinker-rpc/nginx/graphs/contributors)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/nginx/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.
