<?php
require '../../vendor/autoload.php';

/**
 * Plinker Config
 */
$config = [
    // plinker connection
    'plinker' => [
        'endpoint' => 'http://127.0.0.1/examples/tasks/server.php',
        'public_key'  => 'makeSomethingUp',
        'private_key' => 'againMakeSomethingUp'
    ],
    
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
];

// init plinker client
$tasks = new \Plinker\Core\Client(
    // where is the plinker server
    $config['plinker']['endpoint'],

    // component namespace to interface to
    'Tasks\Manager',

    // keys
    hash('sha256', gmdate('h').$config['plinker']['public_key']),
    hash('sha256', gmdate('h').$config['plinker']['private_key']),

    // construct values which you pass to the component, which the component
    //  will use, for RedbeanPHP component you would send the database connection
    //  dont worry its AES encrypted. see: encryption-proof.txt
    $config
);

/**
 * Example
 */

// create the task
try {
    // create task
    $tasks->create(
        // name
        'Hello World',
        // source
        '<?php echo "Hello World";',
        // type
        'php',
        // description
        '...',
        // default params
        []
    );
} catch (\Exception $e) {
    if ($e->getMessage() == 'Unauthorised') {
        echo 'Error: Connected successfully but could not authenticate! Check public and private keys.';
    } else {
        echo 'Error:'.str_replace('Could not unserialize response:', '', trim(htmlentities($e->getMessage())));
    }
}

//run task now - executed as apache user
//print_r($tasks->runNow('Hello World'));

// place task in queue to run
print_r($tasks->run('Hello World', [1], 5));

// get task status
print_r($tasks->status('Hello World'));

// get task run count
print_r($tasks->runCount('Hello World'));

// clear all tasks
//$tasks->clear();
