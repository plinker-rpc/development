<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-5px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

require '../../vendor/autoload.php';

// working
$client = new \Plinker\Core\Client(
    'http://10.158.250.158/examples/core/server.php',
    [
        // client/server secret (optional)
        'secret' => 'a secret password',
        
        // addtional parameters to pass to the component class (optional)
        'my_addtional_params' => ['value'],
        'database' => [
            'username' => 'perhaps a database array'
        ],
        'some_key' => 'some_value'
        // ...
    ]
);

debug('$client', $client);

debug('$client->info()', $client->info());
//debug('$client->info()', $client->info());


debug('$client->test->this()', $client->core->endpoint->test->this());

debug('$client->Base91->Base91->encode(\'foo\')', $client->Base91->Base91->encode('foo'));
debug('$client->Base91->Base91->encode(\'foo\')', $client->System->System->total_disk_space(['/']));

//debug('$client->test->this()', $client->test->this());

debug('$client->demo->config()', $client->foo->demo->config());
/*
debug('$client->demo->test()', $client->demo->test('x', 'y'));

debug('$client->demo->test()', $client->demo->this());
*/



//debug('$client->test->this()', $client->test->this());
//debug('$client->demo->test()', $client->demo->test());
