<?php
require '../../vendor/autoload.php';

// load config file - (for testing)
$config = parse_ini_file('../config.ini', true);

function debug($title, $out) {
    echo '<h3 style="margin-bottom:-10px">'.$title.'</h3>';
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
}
    
/**
 * Plinker Config
 */
$config = [
    // plinker connection
    'plinker' => $config['plinker'],
    
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
];

// init plinker client
$tasks = new \Plinker\Core\Client(
    // where is the plinker server
    $config['plinker']['endpoint'],

    // component namespace to interface to
    'Tasks\Manager',

    // keys
    $config['plinker']['public_key'],
    $config['plinker']['private_key'],

    // construct values which you pass to the component, which the component
    //  will use, for RedbeanPHP component you would send the database connection
    //  dont worry its AES encrypted. see: encryption-proof.txt
    $config
);

/**
 * Example
 */

// create the task
try {

    #
    debug('Create: Hello World Task', $tasks->create(
        // name
        'Hello World',
        // source
        '<?php echo "Hello World";',
        // type
        'php',
        // description
        '...',
        // default params
        []
    ));
    
    #
    debug('Run Task: Queued', $tasks->run('Hello World', [1], 10)); 
    
    #
    debug('Run Task: Now', $tasks->runNow('Hello World')); 
    
    #
    debug('Status', $tasks->status('Hello World')); 
    
    #
    debug('Run Count', $tasks->runCount('Hello World'));
    
    #
    debug('Get Task', $tasks->get('Hello World'));
    
    #
    debug('Get Task By Id', $tasks->getById(10));
    
    #
    //debug('Remove Task By Name', $tasks->remove('Hello World'));
    
    #
    debug('Get Task Sources', $tasks->getTaskSources());
    
    #
    debug('Get Tasks', $tasks->getTasks());
    
    #
    #debug('Get Files', $tasks->files('./'));
    
    #
    #debug('Get File (base64 encoded)', $tasks->getFile('./index.php')); 
    
    #
    #debug('Get File (base64 decoded)', base64_decode($tasks->getFile('./index.php')));
    
    
    debug('Save File', $tasks->saveFile('test.txt', base64_encode('This is a test file contents')));
    
    
    
    
    
    
} catch (\Exception $e) {
    if ($e->getMessage() == 'Unauthorised') {
        echo 'Error: Connected successfully but could not authenticate! Check public and private keys.';
    } else {
        echo 'Error:'.str_replace('Could not unserialize response:', '', trim(htmlentities($e->getMessage())));
    }
}

// clear all tasks
//$tasks->clear();
