<?php
require '../../vendor/autoload.php';

// load config file - (for testing)
$config = parse_ini_file('../config.ini', true);

/**
 * Plinker Config
 */
$plinker = $config['plinker'];

// init plinker endpoint client
$demo = new \Plinker\Core\Client(
    // where is the plinker server
    $plinker['endpoint'],

    // component namespace to interface to
    'Test\Demo',

    // keys
    $plinker['public_key'],
    $plinker['private_key'],

    // construct values which you pass to the component, which the component
    //  will use, for RedbeanPHP component you would send the database connection
    //  dont worry its AES encrypted. see: encryption-proof.txt
    [
        'foo' => 'bar'
    ]
);

try {
    
    // call this()
    echo '<pre>'.print_r($demo->this(), true).'</pre>';
    
    // call config()
    echo '<pre>'.print_r($demo->config(), true).'</pre>';
    
    // call this() and then locally execute an_array()
    echo '<pre>'.print_r($demo->this()->an_array(), true).'</pre>';
    
    // call an_array()
    echo '<pre>'.print_r($demo->an_array(), true).'</pre>';
    
    // call an_array()
    echo '<pre>'.print_r($demo->closure()('How you doing?'), true).'</pre>';
    
    // call my_time()
    echo '<pre>'.print_r($demo->my_time(), true).'</pre>';
    
    // call my_ip()
    echo '<pre>'.print_r($demo->my_ip(), true).'</pre>';
    
    // call your_ip()
    echo '<pre>'.print_r($demo->your_ip(), true).'</pre>';

} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}