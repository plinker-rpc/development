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
    #
    //debug('$cron->user()', $client->cron->user(), 'Get user');
    
    //debug('$cron->crontab()', $client->cron->crontab(), 'Get crontab as-is');
    
    //debug('$cron->create(\'My Cron Task\', \'* * * * * cd ~\')', $client->cron->create('My Cron Task', '* * * * * cd ~'), 'Create a crontask');
    
    //debug('$cron->create(\'My Cron Task\', \'* * * * * cd ~\')', $client->cron->create('My Cron Task', '* * * * * cd ~'), 'Create a crontask');
    
    debug('$cron->get(\'My Cron Task\')', $client->cron->get('My Cron Task'), 'Get cron task');
    
    debug('$cron->update(\'My Cron Task\', \'0 * * * * cd ~\')', $client->cron->update('My Cron Task', '0 * * * * cd ~'), 'Update cron task');
    
    debug('$cron->read(\'My Cron Task\')', $client->cron->read('My Cron Task'), 'Read cron task');
    
    debug('$cron->delete(\'My Cron Task\')', $client->cron->delete('My Cron Task'), 'Delete cron task');

    //debug('$cron->drop()', $client->cron->drop(), 'Drop/Clear crontab journal');
    
    debug('$cron->dump()', $client->cron->dump(), 'Return current crontab as plain text');
    
    debug('$cron->apply()', $client->cron->apply(), 'Apply crontab');

} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}
