<?php
require '../../vendor/autoload.php';

/**
 * Its POST..
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /**
     * Its Plinker!
     */
    if (isset($_SERVER['HTTP_PLINKER'])) {
        // test its encrypted
        file_put_contents('./encryption-proof.txt', print_r($_POST, true));

        /**
         * Define Plinker Config
         */
        $plinker = [
            'public_key'  => 'makeSomethingUp',
            'private_key' => 'againMakeSomethingUp',
            // optional config
            /*'config' => [
                // allowed ips, restrict access by ip
                'allowed_ips' => [
                    '127.0.0.1'
                ]
            ]*/
        ];

        // init plinker server
        $server = new \Plinker\Core\Server(
            $_POST,
            $plinker['public_key'],
            $plinker['private_key'],
            $plinker['config']
        );

        exit($server->execute());
    }
}
