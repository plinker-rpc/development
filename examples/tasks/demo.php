<?php
require '../../vendor/autoload.php';

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-10px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}

try {
    
    //
    $client = plinker_client('http://10.158.250.1:88', 'a secret password', [
        // database connection
        'database' => [
            'dsn'      => 'sqlite:./.plinker/database.db',
            'host'     => '',
            'name'     => '',
            'username' => '',
            'password' => '',
            'freeze'   => false,
            'debug'    => false,
        ],
        // displays output to task runner console
        'debug' => true,
    
        // daemon sleep time
        'sleep_time' => 1,
        'tmp_path'   => './.plinker'
    ]);
    
        
    #
    debug('Get Task Sources', $client->tasks->getTaskSources());
    
    #
    debug('Get Tasks', $client->tasks->getTasks());
    
    

    /*
        debug('Create: Hello World Task', $client->tasks->create(
        // name
        'Hello World - x',
        // source
        '<?php echo "Hello World";',
        // type
        'php',
        // description
        '...',
        // default params
        []
    ));
    */
    //debug('Run Task: Queued', $client->tasks->run('Hello World - x', [], 1)); 
    
    #
    /*

    */
    
    //debug('Get Task Log', $client->tasks->getTasksLog());
    //debug('Get Task', $client->tasks->get('Hello World'));
    
    //debug('Status', $client->tasks->status('Hello World'));
    //debug('Get Task By Id', $client->tasks->getTaskSources());
    
    /*
    #
    debug('Run Task: Queued', $client->tasks->run('Hello World', [1], 0)); 
    
    #
    debug('Run Task: Now', $client->tasks->runNow('Hello World')); 
    
    #
    debug('Status', $client->tasks->status('Hello World')); 
    */
    
    
    #
    //debug('Run Count', $client->tasks->runCount('Hello World'));
    
    #
    //debug('Get Task', $client->tasks->get('Hello World'));
    
    #
    //debug('Get Task By Id', $client->tasks->getById(10));
    
    #
    //debug('Remove Task By Name', $tasks->remove('Hello World'));

    
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}
