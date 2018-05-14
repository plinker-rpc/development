# Test

A test/demo component which has a few basic methods which demostrate how easy it is 
to define a class to interface to, a range of data types can be sent back from
strings, arrays, objects, closures or even self/this for testing/example purposes.

Make sure you check out [the components code](https://github.com/plinker-rpc/test/blob/master/src/Test.php),
there is no complicated voodoo going on, its just a simple PHP class.

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
            'secret' => 'a secret password',
            'array' => [
                'key' => 'value'
            ]
        ]
    );
    
    // or using global function
    $client = plinker_client('http://example.com/server.php', 'a secret password', [
        'array' => [
            'key' => 'value'
        ]
    ]);
    

## Methods

Once setup, you call the class though its namespace to its method.

### This

By calling this you can return the entire class to call locally.

**Call**
``` php
$client->test->this();
```

**Response**
``` text
Plinker\Test\Test Object
(
    [config] => Array
        (
            [array] => Array
                (
                    [key] => value
                )

        )

)
```

If your wondering where the `config` array is coming from.. its passed in the connection, see above client section.

### Config

This shows a "getter" for the class which returns the config.

**Call**
``` php
$client->test->config();
```

**Response**
``` text
Array
(
    [array] => Array
        (
            [key] => value
        )

)
```

### An Array

This shows returning a basic array. :/

**Call**
``` php
$client->test->an_array();
```

**Response**
``` text
Array
(
    [0] => Hello World
)
```

### A Closure

This shows returning a closure (anonymous function) which was serialised with [(opis/closure) SerializableClosure](https://github.com/opis/closure).

**Call**
``` php
$client->test->closure()('foo');
```

**Response**
``` text
foo
```

### Run Closure

This shows running a closure (anonymous function) on the server from the client which was serialised with [(opis/closure) SerializableClosure](https://github.com/opis/closure). 
This allows you to neatly mutate any data before its returned back from the server.

**Call**
``` php
$client->test->run_closure(function ($value = []) {
    return implode(' ', $value);
})
```

**Response**
``` text
Hello World
```

### An Object

This shows returning an object, in this example a DateTime object.

**Call**
``` php
$client->test->date();
```

**Response**
``` text
DateTime Object
(
    [date] => 2018-05-11 15:53:34.655980
    [timezone_type] => 3
    [timezone] => UTC
)
```

### A String

This shows returning an string, in this example it returns the IP address of the server.

**Call**
``` php
$client->test->my_ip();

$client->test->your_ip();
```

**Response**
``` text
10.158.250.158

10.158.250.1
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