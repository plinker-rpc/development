**Plinker-RPC - CRON**
=========

PlinkerRPC PHP client/server makes it really easy to link and execute PHP component classes on remote systems, while maintaining the feel of a local method call.

A cron component which allows you to read and control cron tasks.

**Composer**

    {
    	"require": {
    		"plinker/cron": ">=v0.1"
    	}
    }



Making remote calls.
--------------------

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
            'Cron\Manager',
        
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

**then the server part...**

    <?php
    require '../../vendor/autoload.php';
    
    /**
     * Its POST..
     */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        /**
         * Its Plinker!
         */
        if (isset($_SERVER['HTTP_PLINKER'])) {
            // test its encrypted
            file_put_contents('./.plinker/encryption-proof.txt', print_r($_POST, true));
    
            /**
             * Define Plinker Config
             */
            $plinker = [
                'public_key'  => 'makeSomethingUp',
                'private_key' => 'againMakeSomethingUp',
                // optional config
                /*'config' => [
                    // allowed ips, restrict access by ip
                    'allowed_ips' => [
                        '127.0.0.1'
                    ]
                ]*/
            ];
    
            // init plinker server
            $server = new \Plinker\Core\Server(
                $_POST,
                $plinker['public_key'],
                $plinker['private_key'],
                (array) @$plinker['config']
            );
    
            exit($server->execute());
        }
    }


See the [organisations page](https://github.com/plinker-rpc) for additional components.