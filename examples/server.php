<?php
require '../vendor/autoload.php';

// load config file - (for testing)
$config = parse_ini_file('config.ini', true);

/**
 * Its Plinker!
 */
if (isset($_SERVER['HTTP_PLINKER'])) {
    // test its encrypted
    file_put_contents('../encryption-proof.txt', print_r($_POST, true));
        
    /**
     * Define Plinker Config
     */
    $plinker = [
        'public_key'  => $config['public_key'],
        'private_key' => $config['private_key'],
        // optional config
        'config' => [
            // optional - allowed ips, restrict access by ip
            /*
            'allowed_ips' => [
                '127.0.0.1'
            ]
            */
        ]
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
