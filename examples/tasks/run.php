<?php
require '../../vendor/autoload.php';

/*
cron job

@reboot while sleep 1; do cd /var/www/html/examples/tasks && /usr/bin/php run.php ; done
*/

// init task runner
$task = new Plinker\Tasks\Runner([
    // database connection
    'database' => [
        'dsn'      => 'sqlite:./database.db',
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
    'pid_path'   => './pids'
]);

// $task->run('Test');

$task->daemon('Queue', [
    'sleep_time' => 1
]);
