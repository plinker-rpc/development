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


// setup and add nginx tasks
echo '<h2>Setup</h2>';
echo '<pre>'.print_r(
    
    $nginx->setup([
        'build_sleep' => 5    
    ])
    
, true).'</pre>';


$nginx->reset(true);

die;

//echo '<pre>'.print_r($nginx->fetch('route'), true).'</pre>';

/**
 * Add web forward
 */
// set base form structure
$form = [
    // form model
    'values' => [
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

echo '<h2>Add</h2>';
echo '<pre>'.print_r($nginx->add($form['values']), true).'</pre>';

/**
 * Allow task to be completed
 */
//sleep(3);

/**
 * Update Web forward
 * 
 * 
 * 
 */
// set base form structure
$form = [
    // form model
    'values' => [
        'label' => 'Example Changed',
        'domains' => [
            'example.com',
            'www.example.com',
            'new.example.com',
        ],
        'upstreams' => [
            ['ip' => '127.0.0.2', 'port' => '8080']
        ],
        'letsencrypt' => 0,
        'enabled' => 1
    ]
];

echo '<h2>Update</h2>';
echo '<pre>'.print_r($nginx->update('id = ?', [2], $form['values']), true).'</pre>';

/*
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
echo '<pre>'.print_r($nginx->update($form['values']), true).'</pre>';
*/

//echo '<pre>'.print_r($nginx->add([]), true).'</pre>';

/**
 * Allow task to be completed
 */
//sleep(6);

echo '<h2>Fetch</h2>';
echo '<pre>'.print_r($nginx->fetch('route'), true).'</pre>';

echo '<h2>Remove</h2>';
echo '<pre>'.print_r($nginx->remove('id = ?', [2]), true).'</pre>';

//$nginx->reset();


# load test
foreach (range('A', 'Z') as $i => $char) {
    /**
     * Add web forward
     */
    // set base form structure
    $form = [
        // form model
        'values' => [
            'label' => $char,
            'domains' => [
                $char.'.example.com',
                $char.'.www.example.com',
            ],
            'upstreams' => [
                ['ip' => '127.0.0.'.$i, 'port' => '80']
            ],
            'letsencrypt' => 0,
            'enabled' => 1
        ]
    ];
    
    echo '<h2>Add: '.$char.'</h2>';
    echo '<pre>'.print_r($nginx->add($form['values']), true).'</pre>';

}


#delete all routes
die;
foreach ($nginx->fetch('route') as $route) {
    $nginx->remove('name = ?', [$route['name']]);
}

echo '<h2>Fetch</h2>';
echo '<pre>'.print_r($nginx->fetch('route'), true).'</pre>';