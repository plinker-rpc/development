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

//$task->run('Test');

$task->daemon('Daemon', [
    'sleep_time' => 1
]);

die;


/**
 * Plinker Config
 */
$plinker = [
    'endpoint' => 'http://127.0.0.1/example/server.php',
    'public_key'  => 'makeSomethingUp',
    'private_key' => 'againMakeSomethingUp'
];

// init plinker endpoint client
$tasks = new \Plinker\Core\Client(
    // where is the plinker server
    $plinker['endpoint'],

    // component namespace to interface to
    'Tasks\Manager',

    // keys
    hash('sha256', gmdate('h').$plinker['public_key']),
    hash('sha256', gmdate('h').$plinker['private_key']),

    // construct values which you pass to the component, which the component
    //  will use, for RedbeanPHP component you would send the database connection
    //  dont worry its AES encrypted. see: encryption-proof.txt
    [
        'foo' => 'bar'
    ]
);

// add task
echo '<pre>'.print_r($tasks->add(), true).'</pre>';

