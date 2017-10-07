<?php
require '../../vendor/autoload.php';

try {
    
    /**
     * Plinker Config
     */
    $config = [
        // plinker connection | using tasks as to write in the correct .sqlite file
        'plinker' => [
            'endpoint' => 'http://127.0.0.1/examples/cron/server.php',
            'public_key'  => 'makeSomethingUp',
            'private_key' => 'againMakeSomethingUp'
        ],
    
        // optional config
        'config' => [
            'journal' => './crontab.journal',
            'apply'   => false
        ]
    ];
    
    // init plinker endpoint client
    $cron = new \Plinker\Core\Client(
        // where is the plinker server
        $config['plinker']['endpoint'],
    
        // component namespace to interface to
        'Cron\Cron',
    
        // keys
        $config['plinker']['public_key'],
        $config['plinker']['private_key'],
    
        // construct array which you pass to the component
        $config['config']
    );

    // get crontab as-is
    echo '<h2>$cron->crontab()</h2>';
    echo '<pre>'.$cron->crontab().'</pre>';
    
    // create a crontask
    echo '<h2>$cron->create(\'My Cron Task\', \'* * * * * cd ~\')</h2>';
    echo '<pre>'.$cron->create('My Cron Task', '* * * * * cd ~').'</pre>';
    
    // get cron task
    echo '<h2>$cron->get(\'My Cron Task\')</h2>';
    echo '<pre>'.$cron->get('My Cron Task').'</pre>';
    
    // update cron task
    echo '<h2>$cron->update(\'My Cron Task\', \'0 * * * * cd ~\')</h2>';
    echo '<pre>'.$cron->update('My Cron Task', '0 * * * * cd ~').'</pre>';

    // get cron task
    echo '<h2>$cron->get(\'My Cron Task\')</h2>';
    echo '<pre>'.$cron->get('My Cron Task').'</pre>';
    
    // delete cron task
    echo '<h2>$cron->delete(\'My Cron Task\')</h2>';
    echo '<pre>'.$cron->delete('My Cron Task').'</pre>';
    
    // get cron task
    echo '<h2>$cron->get(\'My Cron Task\')</h2>';
    echo '<pre>'.$cron->get('My Cron Task').'</pre>';
    
    // drop cron task
    echo '<h2>$cron->drop()</h2>';
    echo '<pre>'.$cron->drop().'</pre>';
    
    // get crontab as-is
    echo '<h2>$cron->crontab()</h2>';
    echo '<pre>'.$cron->crontab().'</pre>';

    // apply crontab
    echo '<h2>$cron->apply()</h2>';
    echo '<pre>'.$cron->apply().'</pre>';
    
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}
