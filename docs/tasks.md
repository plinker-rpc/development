# Tasks

The tasks component allows you to write code based tasks which are completed by a daemon, 
this could allow you to create a single interface to control a cluster of servers tasks.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/tasks
```

## CRON Daemon

You should create a file which will be run via cron:

**cron.php**

    <?php
    require 'vendor/autoload.php';

    if (php_sapi_name() != 'cli') {
        header('HTTP/1.0 403 Forbidden');
        exit('CLI script');
    }

    $task = new Plinker\Tasks\Runner([
        'database' => [
            'dsn'      => 'sqlite:./.plinker/database.db',
            'host'     => '',
            'name'     => '',
            'username' => '',
            'password' => '',
            'freeze'   => false,
            'debug'    => false
        ],
        'debug'       => true,
        'log'         => true,
        'sleep_time'  => 2,
        'tmp_path'    => './.plinker',
        'auto_update' => 86400
    ]);
    
    $task->daemon('Queue');
    
Then add a cron job:

 - `@reboot while sleep 1; do cd /var/www/html/examples/tasks && /usr/bin/php run.php ; done`


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
            ],
            // displays output to task runner console
            'debug' => true,
        
            // daemon sleep time
            'sleep_time' => 1,
            'tmp_path'   => './.plinker'
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
        ],
        // displays output to task runner console
        'debug' => true,
    
        // daemon sleep time
        'sleep_time' => 1,
        'tmp_path'   => './.plinker'
    ]);
    

## Methods

Once setup, you call the class though its namespace to its method.

### Create

Create a new task, tasks with the same name will be overwritten.

| Parameter   | Type           | Description   | Default         |
| ----------  | -------------  | ------------- |  -------------- | 
| name        | string         | Name of task  |                 |
| source      | string         | Task source code |              |
| type        | string         | Type of task (php\|bash) |       |
| description | string         | Description of task |           |
| params      | array          | Default params passed to task | |


**Call**
``` php
$client->tasks->create(
    'Hello World',
    '<?php echo "Hello World";',
    'php',
    'My Hello World task',
    []
)
```

**Response**
``` text
Array
(
    [id] => 1
    [name] => Hello World
    [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
    [type] => php
    [description] => My Hello World task
    [params] => 
    [updated] => 2018-01-01 00:00:00
    [created] => 2018-01-01 00:00:00
)
```

### Update

Update a task.

| Parameter   | Type           | Description   | Default         |
| ----------  | -------------  | ------------- |  -------------- | 
| id          | int            | Id of task    |                 |
| name        | string         | Name of task  |                 |
| source      | string         | Task source code |              |
| type        | string         | Type of task (php\|bash) |       |
| description | string         | Description of task |           |
| params      | array          | Default params passed to task | |


**Call**
``` php
$client->tasks->update(
    1
    'Hello World',
    '<?php echo "Hello World - Updated";',
    'php',
    'My Hello World task',
    []
)
```

**Response**
``` text
Array
(
    [id] => 1
    [name] => Hello World - Updated
    [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
    [type] => php
    [description] => My Hello World task
    [params] => 
    [updated] => 2018-01-01 00:00:00
    [created] => 2018-01-01 00:00:00
)
```

### Get

Get a task.

| Parameter   | Type           | Description   | Default         |
| ----------  | -------------  | ------------- |  -------------- | 
| name        | string         | Name of task  |                 |

**Call**
``` php
$client->tasks->get('Hello World');
```

**Response (RedBean Object)**
``` text
RedBeanPHP\OODBBean Object
(
    [properties:protected] => Array
        (
            [id] => 1
            [name] => Hello World
            [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
            [type] => php
            [description] => My Hello World task
            [params] => 
            [updated] => 2018-01-01 00:00:00
            [created] => 2018-01-01 00:00:00
        )

    [__info:protected] => Array
        (
            [type] => tasksource
            [sys.id] => id
            [sys.orig] => Array
                (
                    [id] => 1
                    [name] => Hello World
                    [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
                    [type] => php
                    [description] => My Hello World task
                    [params] => 
                    [updated] => 2018-01-01 00:00:00
                    [created] => 2018-01-01 00:00:00
                )

            [tainted] => 
            [changed] => 
            [changelist] => Array
                (
                )

            [model] => 
        )

    [beanHelper:protected] => RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper Object
        (
        )

    [fetchType:protected] => 
    [withSql:protected] => 
    [withParams:protected] => Array
        (
        )

    [aliasName:protected] => 
    [via:protected] => 
    [noLoad:protected] => 
    [all:protected] => 
)
```

### Get By Id

Get a task by id.

| Parameter   | Type           | Description   | Default         |
| ----------  | -------------  | ------------- |  -------------- | 
| id          | int            | Id of task    |                 |

**Call**
``` php
$client->tasks->getById(1);
```

**Response (RedBean Object)**
``` text
RedBeanPHP\OODBBean Object
(
    [properties:protected] => Array
        (
            [id] => 1
            [name] => Hello World
            [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
            [type] => php
            [description] => My Hello World task
            [params] => 
            [updated] => 2018-01-01 00:00:00
            [created] => 2018-01-01 00:00:00
        )

    [__info:protected] => Array
        (
            [type] => tasksource
            [sys.id] => id
            [sys.orig] => Array
                (
                    [id] => 1
                    [name] => Hello World
                    [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
                    [type] => php
                    [description] => My Hello World task
                    [params] => 
                    [updated] => 2018-01-01 00:00:00
                    [created] => 2018-01-01 00:00:00
                )

            [tainted] => 
            [changed] => 
            [changelist] => Array
                (
                )

            [model] => 
        )

    [beanHelper:protected] => RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper Object
        (
        )

    [fetchType:protected] => 
    [withSql:protected] => 
    [withParams:protected] => Array
        (
        )

    [aliasName:protected] => 
    [via:protected] => 
    [noLoad:protected] => 
    [all:protected] => 
)
```

### Get Task Sources

Get all tasks.

**Call**
``` php
$client->tasks->getTaskSources();
```

**Response (RedBean Object)**
``` text
Array
(
    [1] => RedBeanPHP\OODBBean Object
        (
            [properties:protected] => Array
                (
                    [id] => 1
                    [name] => Hello World
                    [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
                    [type] => php
                    [description] => My Hello World task
                    [params] => 
                    [updated] => 2018-01-01 00:00:00
                    [created] => 2018-01-01 00:00:00
                )
        
            [__info:protected] => Array
                (
                    [type] => tasksource
                    [sys.id] => id
                    [sys.orig] => Array
                        (
                            [id] => 1
                            [name] => Hello World
                            [source] =>  cda22aa1e43992c1103a9f8a386b5dcb
                            [type] => php
                            [description] => My Hello World task
                            [params] => 
                            [updated] => 2018-01-01 00:00:00
                            [created] => 2018-01-01 00:00:00
                        )
        
                    [tainted] => 
                    [changed] => 
                    [changelist] => Array
                        (
                        )
        
                    [model] => 
                )
        
            [beanHelper:protected] => RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper Object
                (
                )
        
            [fetchType:protected] => 
            [withSql:protected] => 
            [withParams:protected] => Array
                (
                )
        
            [aliasName:protected] => 
            [via:protected] => 
            [noLoad:protected] => 
            [all:protected] => 
        )
    )
)
```

### Status

Get the status of a task.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| name        | string         | Name of task  | |

**Call**
``` php
$client->tasks->status('Hello World');
```

**Response**
``` text
running
```

### Run Count

Get the run count of a particular task.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| name        | string         | Name of task  | |

**Call**
``` php
$client->tasks->runCount('Hello World');
```

**Response**
``` text
100
```

### Remove

Remove a task by its name.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| name        | string         | Name of task  | |

**Call**
``` php
$client->tasks->remove('Hello World');
```

**Response**
``` text
true
```

### Remove By Id

Remove a task by its id.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| id          | int            | Id of task    |                |

**Call**
``` php
$client->tasks->removeById(1);
```

**Response**
``` text
true
```

### Get Tasks Log

Task logs are entries created, when a task is run. Use this method to get the data.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| tasksource_id | int          | The id of the task source (optional) |  |


**Call**
``` php
$result = $client->tasks->getTasksLog();
```

**Response**
``` text
Array
(
    [1] => RedBeanPHP\OODBBean Object
        (
            [properties:protected] => Array
                (
                    [id] => 1
                    [name] => Hello World
                    [params] => []
                    [repeats] => 1
                    [completed] => 0
                    [sleep] => 1
                    [tasksource_id] => 1
                    [run_last] => 2018-01-01 00:00:00
                    [run_next] => 2018-01-01 00:00:00
                    [run_count] => 6
                    [result] => 
                    [tasksource] => 
                )

            [__info:protected] => Array
                (
                    [type] => tasks
                    [sys.id] => id
                    [sys.orig] => Array
                        (
                            [id] => 1
                            [name] => Hello World
                            [params] => []
                            [repeats] => 1
                            [completed] => 0
                            [sleep] => 1
                            [tasksource_id] => 1
                            [run_last] => 2018-01-01 00:00:00
                            [run_next] => 2018-01-01 00:00:00
                            [run_count] => 6
                            [result] => 
                            [tasksource] => 
                        )

                    [tainted] => 
                    [changed] => 
                    [changelist] => Array
                        (
                        )

                    [model] => 
                )

            [beanHelper:protected] => RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper Object
                (
                )

            [fetchType:protected] => 
            [withSql:protected] => 
            [withParams:protected] => Array
                (
                )

            [aliasName:protected] => 
            [via:protected] => 
            [noLoad:protected] => 
            [all:protected] => 
        )
    )
)
```

### Get Tasks Log Count

Task logs are entries created, when a task is run. Use this method to get the counts.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| tasksource_id | int          | The id of the task (optional) |  |


**Call**
``` php
$result = $client->tasks->getTasksLogCount();
```

**Response**
``` text
1
```

### Remove Tasks Log

Remove a task log from the task.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| task_id     | int            | The id of the task |           |


**Call**
``` php
$result = $client->tasks->removeTasksLog(1);
```

**Response**
``` text
true
```

### Get Tasks

Task logs are entries created, when a task is run. Use this method to get the data.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| task_id     | int            | The id of the task (optional) |  |


**Call**
``` php
$result = $client->tasks->getTasks();
```

**Response**
``` text
Array
(
    [1] => RedBeanPHP\OODBBean Object
        (
            [properties:protected] => Array
                (
                    [id] => 1
                    [name] => Hello World
                    [params] => []
                    [repeats] => 1
                    [completed] => 0
                    [sleep] => 1
                    [tasksource_id] => 1
                    [run_last] => 2018-01-01 00:00:00
                    [run_next] => 2018-01-01 00:00:00
                    [run_count] => 6
                    [result] => 
                    [tasksource] => 
                )

            [__info:protected] => Array
                (
                    [type] => tasks
                    [sys.id] => id
                    [sys.orig] => Array
                        (
                            [id] => 1
                            [name] => Hello World
                            [params] => []
                            [repeats] => 1
                            [completed] => 0
                            [sleep] => 1
                            [tasksource_id] => 1
                            [run_last] => 2018-01-01 00:00:00
                            [run_next] => 2018-01-01 00:00:00
                            [run_count] => 6
                            [result] => 
                            [tasksource] => 
                        )

                    [tainted] => 
                    [changed] => 
                    [changelist] => Array
                        (
                        )

                    [model] => 
                )

            [beanHelper:protected] => RedBeanPHP\BeanHelper\SimpleFacadeBeanHelper Object
                (
                )

            [fetchType:protected] => 
            [withSql:protected] => 
            [withParams:protected] => Array
                (
                )

            [aliasName:protected] => 
            [via:protected] => 
            [noLoad:protected] => 
            [all:protected] => 
        )
    )
)
```

### Run

Place task entry in tasking table for deamon to run.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| name        | string         | Name of the task | ``          |
| params      | array          | Array of values which are passed to task | `` |
| sleep       | int            | Sleep time between iterations, if 0 its run once | `0` |


**Call**
``` php
// run once
$client->tasks->run('Hello World', [], 0);

// run every day
$client->tasks->run('Hello World', [], 86400);
```

**Response**
``` text
Array
(
    [id] => 1
    [name] => Hello World
    [params] => []
    [repeats] => 1
    [completed] => 0
    [sleep] => 86400
    [tasksource_id] => 1
    [run_last] => 2018-01-01 00:00:00
    [run_next] => 2018-01-01 00:00:00
    [run_count] => 10
    [result] => Hello World
)
```

### Run Now

Run a task now (task is not placed in tasking table for deamon to run), and **run as the web server user**.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| name        | string         | Name of the task | ``          |

**Call**
``` php
$client->tasks->runNow('Hello World');
```

**Response**
``` text
Hello World
```

### Clear

Delete all tasks.

**Call**
``` php
$result = $client->tasks->clear();
```

**Response**
``` text
true
```

### Reset

Delete database. **Use with caution.**

**Call**
``` php
$result = $client->tasks->reset();
```

**Response**
``` text
true
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

## Links

Want to see an example project which uses this component?

 - [PlinkerUI](https://github.com/lcherone/PlinkerUI)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/files/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.
