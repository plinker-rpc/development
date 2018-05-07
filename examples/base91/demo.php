<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-5px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

require '../../vendor/autoload.php';

$client = plinker_client('http://10.158.250.158/examples/core/server.php', 'a secret password');

debug('$client', $client);

debug('$client->base91->encode(\'foo\')', $client->base91->encode('encode this string'));
debug('$client->base91->decode(\'toX<5+UCmUW6GFso^zZ2(.A\')', $client->base91->decode('toX<5+UCmUW6GFso^zZ2(.A'));
