<?php
if (!isset($package)) {
    die('Dont call directly, use php component-generator.php instead.');
}

/**
 * Define directory constants
 */
define('SOURCE_DIR', __DIR__.'/setup');
define('TARGET_DIR', __DIR__.'/../vendor/'.$package['name']);

/**
 * Create src directory
 */
if (!file_exists(TARGET_DIR.'/src')) {
    mkdir(TARGET_DIR.'/src', 0755, true);
}

/**
 * Create docs directory
 */
if (!file_exists(TARGET_DIR.'/src')) {
    mkdir(TARGET_DIR.'/docs', 0755, true);
}

/**
 * Create [tests|fixtures] directory
 */
if (!file_exists(TARGET_DIR.'/tests/fixtures')) {
    mkdir(TARGET_DIR.'/tests/fixtures', 0755, true);
}

/**
 * Replace placeholders in files
 */
function process_file($filename, $replace) {
    file_put_contents(
        TARGET_DIR.'/'.$filename,
        preg_replace_callback("/{{([\w_]{1,})}}/", function ($match) use ($replace) {
            return array_key_exists($match[1], $replace) ? $replace[$match[1]] : '';
        }, file_get_contents(SOURCE_DIR.'/'.$filename))
    );
}

/**
 * Move unchanged files
 */
foreach ([
    '.gitignore',
    '.scrutinizer.yml',
    '.styleci.yml',
    '.travis.yml',
    'LICENSE',
    'CONTRIBUTING.md',
    'phpunit.xml',
    'tests/bootstrap.php',
] as $file) {
    if (file_exists(SOURCE_DIR.'/'.$file)) {
        copy(SOURCE_DIR.'/'.$file, TARGET_DIR.'/'.$file);
    }
}

/**
 * Process/Create files which change
 */

// README.md
$authors = [];
foreach ($package['authors'] as $author) {
    $authors[] = ' - '.sprintf('[%s](%s)', $author['name'], $author['homepage']);
}
process_file('README.md', [
    'name' => $package['name'],
    'title' => $package['title'],
    'description' => $package['description'],
    'authors' => implode(PHP_EOL, $authors)
]);

// copy readme.md to docs
copy(SOURCE_DIR.'/README.md', TARGET_DIR.'/docs/index.md');

//
$namespace = rtrim(array_search('src', $package['autoload']['psr-4']), '\\');
$className = ucfirst(basename($package['name']));

// create class
file_put_contents(TARGET_DIR.'/src/'.$className.'.php', '<?php
/*
 +-----------------------------------------------------------------------------+
 | '.$package['name'].' - '.$package['title'].'
 +-----------------------------------------------------------------------------+
 | Copyright (c)'.date('Y').' ('.$package['homepage'].')
 +-----------------------------------------------------------------------------+
 | This source file is subject to MIT License
 | that is bundled with this package in the file LICENSE.
 |
 | If you did not receive a copy of the license and are unable to
 | obtain it through the world-wide-web, please send an email
 | to '.$package['authors'][0]['email'].' so we can send you a copy immediately.
 +-----------------------------------------------------------------------------+
 | Authors:
 |'.implode(PHP_EOL.' |', $authors).'
 +-----------------------------------------------------------------------------+
 */

namespace '.$namespace.';

class '.$className.'
{
    /**
     *
     */
    public function __construct()
    {

    }

    /**
     *
     */
    public function exampleMethod()
    {
        return \'foobar\';
    }

}'.PHP_EOL);

// composer.json
file_put_contents(
    TARGET_DIR.'/composer.json',
    json_encode([
        'name' => $package['name'],
        'type' => 'library',
        'description' => $package['description'],
        'license' => 'MIT',
        'keywords' => $package['keywords'],
        'homepage' => $package['homepage'],
        'authors' => $package['authors'],
        'require' => [
            'php' => '~5.6|~7.0'
        ],
        'require-dev' => [
            'phpunit/phpunit' => '4.*',
        ],
        'autoload' => $package['autoload'],
        'autoload-dev' => $package['autoload-dev'],
        'scripts' => [
            'test' => 'phpunit --configuration phpunit.xml --coverage-text',
        ],
        'minimum-stability' => 'stable'
    ], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT)
);

// add unit test
file_put_contents(TARGET_DIR.'/tests/'.$testName.'Test.php', '<?php

namespace '.$namespace.';

use PHPUnit\Framework\TestCase;

class '.$testName.'Test extends TestCase
{
    /**
     *
     */
    public function setUp()
    {

    }

    /**
     * @coversNothing
     */
    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }

}'.PHP_EOL);

echo 'Your package files have been successfully generated!'.PHP_EOL;

/**
 * Ask question, do callback.
 */
function ask($options, $callback) {
    $response = null;
    do {
        $response = readline($options['question']);
    } while (!in_array($response, $options['expected']));
    readline_add_history($response);
    
    return $callback($response);
}

$yesno = ['y', 'yes', 'n', 'no'];

ask([
    'question' => 'Would you like to run composer install and run tests? [yes|no]:',
    'expected' => $yesno
], function ($response) {
    if (in_array($response, ['y', 'yes'])) {
        chdir(TARGET_DIR);
        `composer install`;
        echo `composer test`;
    }
});

echo 'Happy coding! - If you liked this, star it!'.PHP_EOL;

