<?php
/**
 * Define the package settings
 */
$package = [
    'name' => 'plinker/package',
    'title' => 'My Package',
    'description' => 'This is my package, description.',
    'type' => 'library',
    'keywords' => [
        'example', 'project', 'boilerplate', 'package'
    ],
    'homepage' => 'http://github.com/vendor/package',
    'authors' => [
        [
            'name' => 'Your Name',
            'email' => 'your-email@example.com',
            'homepage' => 'http://github.com/vendor',
            'role' => 'Owner'
        ]
    ],
    'autoload' => [
        'psr-4' => [
            'Plinker\\Package\\' => 'src',
        ]
    ],
    'autoload-dev' => [
        'psr-4' => [
            'Plinker\\Package\\Tests\\' => 'tests',
        ]
    ]
];

require './component-generator/setup.php';