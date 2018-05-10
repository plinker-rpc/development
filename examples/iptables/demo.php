<?php
require '../../vendor/autoload.php';

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-10px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

try {
    
    //
    $client = plinker_client('http://10.158.250.1:88', 'a secret password', [
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
    ]);

    /*
    #
    debug('Setup', $iptables->setup([
        'build_sleep' => 5,
        'lxd' => [
            'bridge' => 'lxcbr0',
            'ip' => '10.158.250.0/8'
        ],
        'docker' => [
            'bridge' => 'docker0',
            'ip' => '172.17.0.0/16'
        ]
    ]));
    */
    #
    //debug('Update Package', $iptables->update_package());
    
    debug('addForward', $client->iptables->reset(true));
    
    debug('fetch', $client->iptables->fetch());
    
    /*
    debug('Raw', $iptables->raw());
    
    #
    debug('Available Ports', $iptables->availablePorts('ssh'));
    
    #
    debug('Check Port In Use (2251)', $iptables->checkPortInUse(2251));
    
    #
    debug('Check Allowed Port (2251)', $iptables->checkAllowedPort(2251));    
    
    #
    debug('Check Allowed Port (5764)', $iptables->checkAllowedPort(5764));
    
    # a test label
    $test_label = 'Example';

    #
    $form = [
        // form model
        'values' => [
            'label' => $test_label,
            'ip' => '10.158.250.5',
            'port' => 2251,
            'srv_type' => 'SSH',
            'srv_port' => 22,
            'enabled' => 1
        ]
    ];
    debug('Add Port Forward', $iptables->addForward($form['values']));
    
    #
    debug('Update Port Forward', $iptables->updateForward('label=?', [$test_label], ['ip' => '10.158.250.6']));
    
    #
    debug('All Forwards', $iptables->fetch('iptable', 'type = ?', ['forward']));
    
    #
    debug('All Blocked', $iptables->fetch('iptable', 'type = ?', ['block']));
    
    #
    $form = [
        'values' => [
            'ip'    => '212.123.123.123',
            'range' => 32, // 8, 16. 24. 32
            'note'  => 'Port scanned server',
            'enabled' => 1
        ]
    ];
    debug('Add Block', $iptables->addBlock($form['values']));
    
    #
    $form = [
        'values' => [
            'ip'    => '212.123.123.123',
            'range' => 32, // 8, 16. 24. 32
            'note'  => 'Just because!'
        ]
    ];
    debug('Update Block', $iptables->updateBlock('ip=?', ['212.123.123.123'], $form['values']));
    
*/
    
    #
    
    #
    
    #
    //$iptables->reset(true);
    
    #
    exit;
    
    //echo '<h2>Reset</h2>';
    //$iptables->reset(true);


    
    ###################################################
    
    //echo '<pre>'.print_r($iptables->fetch('route'), true).'</pre>';
    
    // remove all
    /*foreach ($iptables->fetch('iptable', 'type = ?', ['forward']) as $row) {
        echo '<h2>Remove</h2>';
        echo '<pre>'.print_r(
        $iptables->remove('id = ?', [$row['id']])
        , true).'</pre>';
        //$iptables->rebuild('name = ?', [$row['name']]);
        //sleep(1);
    }*/
    
    
/*
    die;
    */
    
    // remove all
    /*foreach ($iptables->fetch('route') as $route) {
        $iptables->remove('name = ?', [$route['name']]);
    }
    sleep(2);*/
    /*
    
    // add lots of routs
    # load test
    foreach (range('A', 'Z') as $i => $char) {
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
        echo '<pre>'.print_r($iptables->add($form['values']), true).'</pre>';
    }
    
    die;
    
    // remove all
    foreach ($iptables->fetch('route') as $route) {
        $iptables->remove('name = ?', [$route['name']]);
    }
    
    //$iptables->reset(true);
    
    die;
    
    //echo '<pre>'.print_r($iptables->fetch('route'), true).'</pre>';
    
    */
    
    //echo '<h2>Available Ports</h2>';
    //echo '<pre>'.print_r($iptables->availablePorts('ssh'), true).'</pre>';
    
    /**
     * Add web forward
     */
    // set base form structure
    $form = [
        // form model
        'values' => [
            'label' => 'Example',
            'ip' => '10.158.250.5',
            'port' => 2251,
            'srv_type' => 'SSH',
            'srv_port' => 22,
            'enabled' => 1
        ]
    ];
    
    echo '<h2>Add forward</h2>';
    echo '<pre>'.print_r($iptables->addForward($form['values']), true).'</pre>';

    echo '<h2>Fetch forwards</h2>';
    $forwards = $iptables->fetch('iptable', 'type = ?', ['forward']);
    echo '<pre>'.print_r($forwards, true).'</pre>';
    
    echo '<h2>Update forward</h2>';
    $forwards[0]['label'] = 'FooBar';
    echo '<pre>'.print_r($iptables->updateForward('id=?', [$forwards[0]['id']], $forwards[0]), true).'</pre>';

    /**
     * Add ip block
     */
    $form = [
        // form model
        'values' => [
            'ip'    => '212.123.123.123',
            'range' => 32, // 8, 16. 24. 32
            'note'  => 'Port scanned server',
            'enabled' => 1
        ]
    ];
    echo '<h2>Add block</h2>';
    echo '<pre>'.print_r($iptables->addBlock($form['values']), true).'</pre>';

    echo '<h2>Fetch blocks</h2>';
    $blocks = $iptables->fetch('iptable', 'type = ?', ['block']);
    echo '<pre>'.print_r($blocks, true).'</pre>';
    
    echo '<h2>Update block</h2>';
    $blocks[0]['note'] = 'FooBar';
    echo '<pre>'.print_r($iptables->updateBlock('id=?', [$blocks[0]['id']], $blocks[0]), true).'</pre>';

    
    // keep flexibility for ipblock
    /*echo '<pre>'.print_r($iptables->add('block', [
        'ip' => '123.123.123.123'    
    ]), true).'</pre>';
    */
    die;
    
    /**
     * Allow task to be completed
     */
    //sleep(3);
    
    /**
     * Update Web forward
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
    echo '<pre>'.print_r($iptables->update('id = ?', [2], $form['values']), true).'</pre>';
    
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
    echo '<pre>'.print_r($iptables->update($form['values']), true).'</pre>';
    */
    
    //echo '<pre>'.print_r($iptables->add([]), true).'</pre>';
    
    /**
     * Allow task to be completed
     */
    //sleep(6);
    
    echo '<h2>Fetch</h2>';
    echo '<pre>'.print_r($iptables->fetch('route'), true).'</pre>';
    
    echo '<h2>Remove</h2>';
    echo '<pre>'.print_r($iptables->remove('id = ?', [2]), true).'</pre>';
    
    //$iptables->reset();
    
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
        echo '<pre>'.print_r($iptables->add($form['values']), true).'</pre>';
    }
    
    #delete all routes
    die;
    foreach ($iptables->fetch('route') as $route) {
        $iptables->remove('name = ?', [$route['name']]);
    }
    
    echo '<h2>Fetch</h2>';
    echo '<pre>'.print_r($iptables->fetch('route'), true).'</pre>';
    
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}