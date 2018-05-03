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
        'secret' => 'a secret password'
    ]
);
debug('$client', $client->info());
debug('arch', $client->system->arch());
debug('clear_swap', $client->system->clear_swap());
debug('cpuinfo', $client->system->cpuinfo());
debug('disk_space', $client->system->disk_space());
debug('disks', $client->system->disks());
debug('distro', $client->system->distro());
debug('drop_cache', $client->system->drop_cache());
debug('enumerate', $client->system->enumerate());
debug('hostname', $client->system->hostname());
debug('load', $client->system->load());
debug('logins', $client->system->logins());
debug('machine_id', $client->system->machine_id());
debug('memory_stats', $client->system->memory_stats());
debug('memory_total', $client->system->memory_total());
debug('netstat', $client->system->netstat());
debug('ping', $client->system->ping());
debug('pstree', $client->system->pstree());
debug('reboot', $client->system->reboot());
debug('server_cpu_usage', $client->system->server_cpu_usage());
debug('system_updates', $client->system->system_updates());
debug('top', $client->system->top());
debug('total_disk_space', $client->system->total_disk_space());
debug('uname', $client->system->uname());
debug('uptime', $client->system->uptime());
