**Plinker-RPC - Files**
=========


Plinker PHP RPC client/server makes it really easy to link and execute PHP component classes on remote systems, while maintaining the feel of a local method call.

A files component which allows you to read and write files.

**Composer**

    {
    	"require": {
    		"plinker/files": ">=v0.1"
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
            'Files\Manager',
        
            // keys
            $config['plinker']['public_key'],
            $config['plinker']['private_key'],
        
            // construct array which you pass to the component
            $config['config']
        );
    
        // todo! 
        
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