<?php
require '../../vendor/autoload.php';

try {
    
    /**
     * Plinker Config
     */
    $config = [
        // plinker connection | using tasks as to write in the correct .sqlite file
        'plinker' => [
            'endpoint' => 'http://127.0.0.1/examples/redbean/server.php',
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
    $rdb = new \Plinker\Core\Client(
        // where is the plinker server
        $config['plinker']['endpoint'],
    
        // component namespace to interface to
        'Redbean\Redbean',
    
        // keys
        $config['plinker']['public_key'],
        $config['plinker']['private_key'],
    
        // construct values which you pass to the component
        $config['database']
    );

    //..
    
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}
