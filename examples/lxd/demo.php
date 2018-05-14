<?php
require '../../vendor/autoload.php';

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-10px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

use Opis\Closure\SerializableClosure;

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

    debug('List', $client->lxd->containers->list('local', function ($result) {
        return str_replace('/1.0/containers/', '', $result);    
    }));
    
    debug('Query', $client->lxd->local('lxc list --format="json"'));
    
    debug('List', $client->lxd->containers->snapshots->list('local', 'proxy'));
    
   // debug('List', $client->lxd->query('local:/1.0', 'GET', []));


    /*
    #
    debug('Setup', $client->nginx->setup([
        'build_sleep' => 5,
        'reconcile_sleep' => 30
    ]));
    
    debug('Status', $client->nginx->status());
    
    $client->nginx->reset();
    
     debug('All Routes', $client->nginx->fetch());
    */
    
    /*
    debug('Update Route', $client->nginx->update('name = ?', ['b2f78de7-5994-4c21-9c55-76cefe327a67'], [
        'label' => $test_route_label,
        'ownDomain' => [
            'example.comx',
            'www.example.comxssssssss'
        ],
        'ownUpstream' => [
            ['ip' => '10.158.250.5', 'port' => '80']
        ],
        'letsencrypt' => 1,
        'enabled' => 1
    ]));
    
    debug('All Routes', $client->nginx->fetch());
    
    */
    # a test route label
    $test_route_label = 'Example';
    
    #
    /*
    debug('Add Route', $client->nginx->add([
        'label' => $test_route_label,
        'ownDomain' => [
            'example.comx',
            'www.example.comx'
        ],
        'ownUpstream' => [
            ['ip' => '10.158.250.5', 'port' => '80']
        ],
        'letsencrypt' => 1,
        'enabled' => 1
    ]));
    */
    
    //debug('Remove', $client->nginx->remove('id = ?', [1]));
    /*
    debug('All Routes', $client->nginx->fetch());
    

    
    
    debug('All Routes', $client->nginx->fetch());
    */
    
   // debug('Count Routes', $client->nginx->rebuild());
    
    /*
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
    debug('Update Route', $client->nginx->update('label = ?', [$test_route_label], $form['values']));
    
    #
    debug('All Routes', $client->nginx->fetch('route'));
    
    #
    debug('Status', $client->nginx->status());
    
    #
    debug('Count Routes', $client->nginx->count('route'));
    
    #
    debug('Count Domain', $client->nginx->count('domain'));
    
    #
    debug('Rebuild Route', $client->nginx->rebuild('label = ?', [$test_route_label]));
    
    #
    debug('Remove Route', $client->nginx->remove('label = ?', [$test_route_label]));

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
        debug('Add: '.$char, $client->nginx->add($form['values']));
    }

    # delete all routes
    foreach ($client->nginx->fetch('route') as $route) {
         debug('Remove Route: '.$route['name'], $client->nginx->remove('name = ?', [$route['name']]));
    }
    
    #
    //debug('Reset NGINX Package', $client->nginx->reset());
    */
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}