<?php
require '../../vendor/autoload.php';

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-10px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

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
            'debug'    => false
        ]
    ];
    
    // init plinker endpoint client
    $nginx = new \Plinker\Core\Client(
        // where is the plinker server
        $config['plinker']['endpoint'],
    
        // component namespace to interface to
        'Nginx\Manager',
    
        // keys
        $config['plinker']['public_key'],
        $config['plinker']['private_key'],
    
        // construct values which you pass to the component, which the component
        //  will use, for RedbeanPHP component you would send the database connection
        //  dont worry its AES encrypted. see: encryption-proof.txt
        $config
    );
    
    #
    debug('Setup', $nginx->setup([
        'build_sleep' => 5,   
        'reconcile_sleep' => 5,   
    ]));
    
    # a test route label
    $test_route_label = 'Example';
    
    #
    $form = [
        // form model
        'values' => [
            'label' => $test_route_label,
            'ownDomain' => [
                'example.com',
                'www.example.com'
            ],
            'ownUpstream' => [
                ['ip' => '10.158.250.5', 'port' => '80']
            ],
            'letsencrypt' => 0,
            'enabled' => 1
        ]
    ];
    debug('Add Route', $nginx->add($form['values']));
    
    #
    $form = [
        // form model
        'values' => [
            'label' => $test_route_label,
            'ownDomain' => [
                'example.com',
                'www.example.com'
            ],
            'ownUpstream' => [
                ['ip' => '10.0.0.2', 'port' => '80']
            ],
            'letsencrypt' => 0,
            'enabled' => 1
        ]
    ];
    debug('Update Route', $nginx->update('label = ?', [$test_route_label], $form['values']));
    
    #
    debug('All Routes', $nginx->fetch('route'));
    
    #
    debug('Status', $nginx->status());
    
    #
    debug('Count Routes', $nginx->count('route'));
    
    #
    debug('Count Domain', $nginx->count('domain'));
    
    #
    debug('Rebuild Route', $nginx->rebuild('label = ?', [$test_route_label]));
    
    #
    debug('Remove Route', $nginx->remove('label = ?', [$test_route_label]));

    # add lots of routes
    foreach (range('A', 'Z') as $i => $char) {
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
        debug('Add: '.$char, $nginx->add($form['values']));
    }

    # delete all routes
    foreach ($nginx->fetch('route') as $route) {
         debug('Remove Route: '.$route['name'], $nginx->remove('name = ?', [$route['name']]));
    }
    
    #
    //debug('Reset NGINX Package', $nginx->reset());
    
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}