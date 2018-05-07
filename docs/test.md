# Test

A Test component which has a few basic methods which demostrate how easy it is 
to define a class to interface to, a range of data types can be sent back from
strings, arrays, objects, closures or even self/this for testing/example purposes.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/test
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
    
<!--
## Component Config

| Parameter    | Description | Default |
| ----------   | ------------- |  ------------- | 
| journal | Path to journal file | `./.plinker/crontab.journal` |
| apply | Apply crontab after each call, default is to only apply upon calling `apply()` method | `false` |
-->

## Methods

Once setup, you call the class though its namespace to its method.

### User

Get current user, helps to debug which user the crontab is owned by.

**Call**
``` php
$result = $client->test->this();
```

**Response**
``` text

```

## Testing

There are no tests setup for this component.

## Contributing

Please see [CONTRIBUTING](https://github.com/plinker-rpc/test/blob/master/CONTRIBUTING) for details.

## Security

If you discover any security related issues, please contact me via [https://cherone.co.uk](https://cherone.co.uk) instead of using the issue tracker.

## Credits

- [Lawrence Cherone](https://github.com/lcherone)
- [All Contributors](https://github.com/plinker-rpc/test/graphs/contributors)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/test/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.