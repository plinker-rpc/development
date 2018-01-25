<?php
require '../../vendor/autoload.php';

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-10px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

try {
    
    // load config file - (for testing)
    $config = parse_ini_file('../config.ini', true);
    
    /**
     * Plinker Config
     */
    $config = [
        // plinker connection
        'plinker' => $config['plinker']
    ];
    
    // init plinker endpoint client
    $system = new \Plinker\Core\Client(
        // where is the plinker server
        $config['plinker']['endpoint'],
    
        // component namespace to interface to
        'System\System',
    
        // keys
        $config['plinker']['public_key'],
        $config['plinker']['private_key'],
    
        // construct values which you pass to the component, which the component
        //  will use, for RedbeanPHP component you would send the database connection
        //  dont worry its AES encrypted. see: encryption-proof.txt
        $config
    );

    debug('Disk Space', $system->disk_space('/'));
    
    debug('Total Disk Space', $system->total_disk_space('/'));
    
    debug('Memory Stats', $system->memory_stats());
    
    debug('Memory Total', $system->memory_total());
    
    debug('Server CPU Usage', $system->server_cpu_usage());
    
    debug('MachineID', $system->machine_id());
    
    debug('Netstat', $system->netstat('-pant', true));
    
    debug('Arch', $system->arch());
    
    debug('Hostname', $system->hostname());
    
    debug('Logins', $system->logins(true));
    
    debug('Process Tree', $system->pstree());
    
    debug('Top', $system->top(true));
    
    debug('Uname', $system->uname());
    
    debug('CPU Info', $system->cpuinfo());
    
    debug('Load', $system->load());
    
    debug('Disks', $system->disks(true));
    
    debug('Uptime', $system->uptime());
    
    debug('Ping', $system->ping('google.com'));
    
    debug('Distro', $system->distro());
    
    //debug('System Updates', $system->system_updates());
    
    //debug('drop_cache', $system->drop_cache());
    
    //debug('clear_swap', $system->clear_swap());
    
    //debug('reboot', $system->reboot());
    
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}