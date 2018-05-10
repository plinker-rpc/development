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
    'config' => [
        'journal' => './.plinker/crontab.journal',
        'apply'   => false
    ]
]);

try {

    debug('$client->files->list()', $client->files->list('./', false, 10), 'Get/List files');
    
    debug('$client->files->put()', $client->files->put('./foobar.php', 'this is the file', FILE_APPEND), 'Put file');
    
    debug('$client->files->get()', $client->files->get('./foobar.php'), 'Get file');
    
    debug('$client->files->delete()', $client->files->delete('./foobar.php'), 'Delete file');
    
} catch (\Plinker\Core\Exception\Server $e) {
    exit('Server Exception: '.$e->getMessage());
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}
