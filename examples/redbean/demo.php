<?php
require '../../vendor/autoload.php';

try {
    
    // load config file - (for testing)
    $config = parse_ini_file('../config.ini', true);
    
    /**
     * Plinker Config
     */
    $config = [
        // plinker connection
        'plinker' => $config['plinker'],
    
        // database connection
        'database' => [
            'dsn'      => 'sqlite:./.plinker/database.db',
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
