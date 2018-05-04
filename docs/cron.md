# Cron

A cron component which allows you to read and control cron tasks on remote systems.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/cron
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
            // optional
            'config' => [
                'journal' => './.plinker/crontab.journal',
                'apply'   => false
            ]
        ]
    );
    
    // or using global function, with optional array
    $client = plinker_client('http://example.com/server.php', 'a secret password', [
        'config' => [
            'journal' => './.plinker/crontab.journal',
            'apply'   => false
        ]
    ]);
    

## Component Config

| Parameter    | Description | Default |
| ----------   | ------------- |  ------------- | 
| journal | Path to journal file | `./.plinker/crontab.journal` |
| apply | Apply crontab after each call, default is to only apply upon calling `apply()` method | `false` |


## Methods

Once setup, you call the class though its namespace to its method.

### User

Get current user, helps to debug which user the crontab is owned by.

**Call**
``` php
$result = $client->cron->user();
```

**Response**
``` text
www-data
```

### Crontab

Get current crontab, equivalent to `crontab -l`.

**Call**
``` php
$result = $client->cron->crontab();
```

**Response**
``` text
# My Cron Task
0 * * * * cd ~
# \My Cron Task
```

### Dump

Get current crontab journal. The journal is a file which gets built and then applied to the real crontab.

**Call**
``` php
$result = $client->cron->dump();
```

**Response**
``` text
# My Cron Task
0 * * * * cd ~
# \My Cron Task
```

### Create

Create a crontask entry. Note one entry per key, multiple calls with same key would simply update.

**Call**
``` php
$result = $client->cron->create('My Cron Task', '* * * * * cd ~');
```

**Response**
``` text

```

### Get

Get a crontask entry, also has an alias method read.

**Call**
``` php
$result = $client->cron->get('My Cron Task');
```

**Response**
``` text
0 * * * * cd ~
```

### Update

Update cron task.

**Call**
``` php
$result = $client->cron->update('My Cron Task', '0 * * * * cd ~');
```

**Response**
``` text

```

### Delete

Delete a cron task.

**Call**
``` php
$result = $client->cron->delete('My Cron Task');
```

**Response**
``` text

```

### Drop

Drop cron task journal (delete all, but does not apply it).

**Call**
``` php
$result =  $client->cron->drop();
```

**Response**
``` text

```

### Apply

Apply crontab journal to users crontab.

**Call**
``` php
$result = $client->cron->apply();
```

**Response**
``` text

```

## Testing

There are no tests setup for this component.

## Contributing

Please see [CONTRIBUTING](https://github.com/plinker-rpc/cron/blob/master/CONTRIBUTING) for details.

## Security

If you discover any security related issues, please contact me via [https://cherone.co.uk](https://cherone.co.uk) instead of using the issue tracker.

## Credits

- [Lawrence Cherone](https://github.com/lcherone)
- [All Contributors](https://github.com/plinker-rpc/cron/graphs/contributors)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/cron/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.
