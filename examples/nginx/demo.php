<?php
require '../../vendor/autoload.php';

/**
 * Plinker Config
 */
$config = [
    // plinker connection | using tasks as to write in the correct .sqlite file
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
    ]
];

// init plinker endpoint client
$nginx = new \Plinker\Core\Client(
    // where is the plinker server
    $config['plinker']['endpoint'],

    // component namespace to interface to
    'Nginx\Manager',

    // keys
    hash('sha256', gmdate('h').$config['plinker']['public_key']),
    hash('sha256', gmdate('h').$config['plinker']['private_key']),

    // construct values which you pass to the component, which the component
    //  will use, for RedbeanPHP component you would send the database connection
    //  dont worry its AES encrypted. see: encryption-proof.txt
    $config
);


// call your_ip()
echo '<pre>'.print_r($nginx->setup(), true).'</pre>';

//echo '<pre>'.print_r($nginx->fetch('route'), true).'</pre>';

// set base form structure
$form = [
    // form model
    'values' => [
        'name' => 'Example-Should-Be-Unique',
        'label' => 'Example',
        'domains' => [
            'example.com',
            'www.example.com',
        ],
        'upstreams' => [
            ['ip' => '127.0.0.1', 'port' => '80']
        ],
        'letsencrypt' => 0,
        'enabled' => 1
    ]
];

// add linking then add route
$form['values']['serverid']  = '1234567890';
$form['values']['user_id']   = '1234567890';
$form['values']['container'] = 'container';
$form['values']['machineid'] = '1234567890';

//echo '<pre>'.print_r($nginx->add($form['values']), true).'</pre>';
//echo '<pre>'.print_r($nginx->add([]), true).'</pre>';

echo '<pre>'.print_r($nginx->fetch('route'), true).'</pre>';

//$nginx->reset();
