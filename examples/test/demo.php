<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-5px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

require '../../vendor/autoload.php';

//
$client = plinker_client('http://10.158.250.158/examples/core/server.php', 'a secret password', [
    'array' => [
        'key' => 'value'
    ]
]);

try {
    debug('closure', $client->test->run_closure(function ($value = []) {
        return implode(',', $value);
    }), '');
    
    /*
    debug('', $client->test->this(), '');
    debug('', $client->test->config(), '');
    debug('', $client->test->an_array(), '');
    debug('', $client->test->closure()('foo'), '');
    debug('', $client->test->date(), '');
    debug('', $client->test->my_ip(), '');
    debug('', $client->test->your_ip(), '');
    */
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}
