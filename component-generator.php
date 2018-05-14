<?php
/**
 * Define the package settings
 */
$package = [
    'name' => 'plinker/lxd',
    'title' => 'PlinkerRPC - LXD',
    'description' => 'Control LXD through RPC',
    'type' => 'library',
    'keywords' => [
        'lxd', 'plinker', 'rpc', 'containers'
    ],
    'homepage' => 'http://github.com/plinker-rpc/lxd',
    'authors' => [
        [
            'name' => 'Lawrence Cherone',
            'email' => 'lawrence@cherone.co.uk',
            'homepage' => 'http://github.com/plinker-rpc',
            'role' => 'Owner'
        ]
    ],
    'autoload' => [
        'psr-4' => [
            'Plinker\\Lxd\\' => 'src',
        ]
    ],
    'autoload-dev' => [
        'psr-4' => [
            'Plinker\\Lxd\\Tests\\' => 'tests',
        ]
    ]
];

require './.component-generator/setup.php';