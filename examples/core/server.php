<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require '../../vendor/autoload.php';

/**
 * Its Plinker!
 */
if (isset($_SERVER['HTTP_PLINKER'])) {
    
    header("Content-Type: application/json; charset=utf-8");
    
    // init plinker server
    echo (new \Plinker\Core\Server([
        'secret' => 'a secret password',
        'allowed_ips' => [
            //'127.0.0.1'
        ],
        'classes' => [
            'Foo\\Demo' => [
                // path to file
                'user_classes/demo.php',
                // addtional key/values
                [
                    'key' => 'value'
                ]
            ],
            // ...
        ]
    ]))->listen();
}