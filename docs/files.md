# Files

A files component which allows you to read and write files.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/files
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
    

## Methods

Once setup, you call the class though its namespace to its method.

### List

List files and folders.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| dir         | string         | Base path to list files and folders from | `./` |
| extended    | bool           | Return extended fileinfo | `false` |
| depth       | int            | Iterator depth | `10` |


**Call**
``` php
$result = $client->files->list('./', false, 10);
```

**Response**
``` text
Array
(
    [/] => Array
        (
            [0] => Array
                (
                    [name] => server.php
                    [type] => file
                    [size] => 706
                )

            [1] => Array
                (
                    [name] => .plinker
                    [type] => folder
                    [size] => 4096
                )

            [3] => Array
                (
                    [name] => user_classes
                    [type] => folder
                    [size] => 4096
                )

            [5] => Array
                (
                    [name] => demo.php
                    [type] => file
                    [size] => 1628
                )

        )

    [/.plinker] => Array
        (
            [2] => Array
                (
                    [name] => crontab.journal
                    [type] => file
                    [size] => 45
                )

        )

    [/user_classes] => Array
        (
            [4] => Array
                (
                    [name] => demo.php
                    [type] => file
                    [size] => 345
                )

        )

)
```

**Response (with extended true)**
```
Array
(
    [/] => Array
        (
            [0] => Array
                (
                    [name] => server.php
                    [type] => file
                    [size] => 706
                    [info] => Array
                        (
                            [last_access] => 1525369379
                            [change_time] => 1525368118
                            [modified_time] => 1517173011
                            [basename] => server.php
                            [extension] => php
                            [filename] => server.php
                            [group] => 33
                            [owner] => 33
                            [inode] => 3894233
                            [path] => .
                            [pathname] => ./server.php
                            [size] => 706
                            [type] => file
                            [isDir] => 
                            [isExecutable] => 
                            [isFile] => 1
                            [isLink] => 
                            [readable] => 1
                            [writable] => 1
                        )

                )
    // snip..
```

### Create File

Create a file.

**Call**
``` php
$result = $client->files->createFile('./path/to/file.txt', 'the file contents');
```

**Response**
``` text
number of bytes written to file
```

### Get File

Get a file.

**Call**
``` php
$result = $client->files->getFile('./path/to/file.txt');
```

**Response**
``` text
the file contents
```

### Delete File

Delete a file.

**Call**
``` php
$result = $client->files->deleteFile('./path/to/file.txt');
```

**Response**
``` text

```

## Testing

There are no tests setup for this component.

## Contributing

Please see [CONTRIBUTING](https://github.com/plinker-rpc/files/blob/master/CONTRIBUTING) for details.

## Security

If you discover any security related issues, please contact me via [https://cherone.co.uk](https://cherone.co.uk) instead of using the issue tracker.

## Credits

- [Lawrence Cherone](https://github.com/lcherone)
- [All Contributors](https://github.com/plinker-rpc/files/graphs/contributors)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/files/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.
