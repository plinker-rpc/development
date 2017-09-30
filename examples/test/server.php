<?php
require '../../vendor/autoload.php';

/**
 * Plinker Server
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /**
     * Plinker Config
     */
    $plinker = [
        'public_key'  => 'makeSomethingUp',
        'private_key' => 'againMakeSomethingUp',
        'config' => [
            'allowed_ips' => [
                '127.0.0.1'    
            ]    
        ]
    ];

    /**
     * Plinker server listener
     */
    if (isset($_POST['data']) &&
        isset($_POST['token']) &&
        isset($_POST['public_key'])
    ) {
        // test its encrypted
        file_put_contents('./encryption-proof.txt', print_r($_POST, true), FILE_APPEND);
        file_put_contents('./encryption-proof.txt', print_r($_SERVER, true), FILE_APPEND);
        
        //
        $server = new \Plinker\Core\Server(
            $_POST,
            hash('sha256', gmdate('h').$plinker['public_key']),
            hash('sha256', gmdate('h').$plinker['private_key']),
            $plinker['config']
        );

        exit($server->execute());
    }
}
