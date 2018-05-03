**Plinker-RPC - System**
=========

Plinker PHP RPC client/server makes it really easy to link and execute PHP component classes on remote systems, while maintaining the feel of a local method call.

A system component which gives you access to server information.

**Composer**

    {
    	"require": {
    		"plinker/system": ">=v0.1"
    	}
    }


Making a remote call.
--------------------

    <?php
    require 'vendor/autoload.php';

    /**
     * Initialize plinker client.
     *
     * @param string $server
     * @param string $config
     */
    $client = new \Plinker\Core\Client(
        'http://example.com/server.php',
        [
            'secret' => 'a secret password'
        ]
    );
    echo '<pre>'.print_r($client->system->memory_stats(), true).'</pre>';


**then the server part...**

    <?php
    require 'vendor/autoload.php';

    /**
     * POST Server Part
     */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $server = new Plinker\Core\Server(
            $_POST,
            'username',
            'password'
        );
        exit($server->execute());
    }

See the [organisations page](https://github.com/plinker-rpc) for additional components.