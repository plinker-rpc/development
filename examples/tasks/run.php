<?php

if (php_sapi_name() != 'cli') {
    header('HTTP/1.0 403 Forbidden');
    exit('CLI script');
}

require '../../vendor/autoload.php';

/*
 *cron job
 *
 * @reboot while sleep 1; do cd /var/www/html/examples/tasks && /usr/bin/php run.php ; done
 */

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
    'auto_update' => 3600
]);

$task->daemon('Queue');
