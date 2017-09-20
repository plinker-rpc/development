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
        'private_key' => 'againMakeSomethingUp'
    ];

    /**
     * Plinker server listener
     */
    if (isset($_POST['data']) &&
        isset($_POST['token']) &&
        isset($_POST['public_key'])
    ) {
        // test its encrypted
        file_put_contents('./encryption-proof.txt', print_r($_POST, true));

        //
        $server = new \Plinker\Core\Server(
            $_POST,
            hash('sha256', gmdate('h').$plinker['public_key']),
            hash('sha256', gmdate('h').$plinker['private_key'])
        );

        exit($server->execute());
    }
}
