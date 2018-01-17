<?php
require '../../vendor/autoload.php';

try {
    
    /**
     * Plinker Config
     */
    $config = [
        // plinker connection | using tasks as to write in the correct .sqlite file
        'plinker' => [
            'endpoint' => 'http://plinker.free.lxd.systems:88',
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
    $iptables = new \Plinker\Core\Client(
        // where is the plinker server
        $config['plinker']['endpoint'],
    
        // component namespace to interface to
        'Iptables\Manager',
    
        // keys
        $config['plinker']['public_key'],
        $config['plinker']['private_key'],
    
        // construct values which you pass to the component, which the component
        //  will use, for RedbeanPHP component you would send the database connection
        //  dont worry its AES encrypted. see: encryption-proof.txt
        $config
    );
    
    echo '<pre>'.print_r($iptables->status(), true).'</pre>';
    
    //echo '<h2>Reset</h2>';
    //$iptables->reset(true);

    // setup and add nginx tasks
    echo '<h2>Setup</h2>';
    echo '<pre>'.print_r(
        
        $iptables->setup([
            'build_sleep' => 1,
            'nat_postrouting' => '10.0.0.0/8'
        ])
        
    , true).'</pre>';
    
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