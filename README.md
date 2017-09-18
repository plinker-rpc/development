**Plinker-RPC**
=========

Plinker PHP RPC client/server makes it really easy to link and execute PHP component classes on remote systems, while maintaining the feel of a local method call.

Development repository
----------------------

This repository is used to develop the entire project, it contains a couple of bash scripts which will commit and do semantic versioning for each sub component.


Features:
=========

 * Client <=> Server AES Encryption.
 * Signed and authenticated payload packets.
 * Call a components method or return an object or closure for local execution.

For Example (Making a remote call)
---------------------------

    <?php
    require 'vendor/autoload.php';

    /**
     * Initialize plinker client.
     *
     * @param string $url to host
     * @param string $component namespace of class to interface to
     * @param string $public_key to authenticate on host
     * @param string $private_key to authenticate on host
     * @param string $config component construct config
     */
    $plink = new Plinker\Core\Client(
        'http://example.com',
        'Test\Demo',
        'username',
        'password',
        array(
            'time' => time()
        )
    );
    echo '<pre>'.print_r($plink->test(), true).'</pre>';


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

##Current Components:##
* [Core](https://github.com/plinker-rpc/core) - Required base component which contains the **client** and **server**. (Its all you need if you only want the client)
* [Redbean](https://bitbucket.org/plinker/redbean) - RedBeanPHP component which will enable you to directly manage databases on remote sites.
* [Asterisk](https://bitbucket.org/plinker/asterisk) - An Asterisk component which hooks into the Asterisk Management Interface on remote systems.
* [System](https://bitbucket.org/plinker/system) - A System component which gives you access to server information, execute commands and reboot.
* [Test](https://bitbucket.org/plinker/test) - A Test component which simply returns back what you sent, for testing/example purposes.
* ...

By taking a glance any of the components code, your see their really easy to create, there just objects.. you can return from the component any type of value likes an array from a SQL query, an object or closure you can even return its self `return $this` then execute the object locally. 

##Components##
	{
		"require": {
			"plinker/core": ">=v0.1",
			"plinker/redbean": ">=v0.1",
			"plinker/asterisk": ">=v0.1",
			"plinker/system": ">=v0.1",
			"plinker/test": ">=v0.1"
		}
	}

Add `"minimum-stability": "dev"` to include the .git files for development.