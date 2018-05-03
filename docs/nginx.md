PlinkerRPC PHP client/server makes it really easy to link and execute PHP 
component classes on remote systems, while maintaining the feel of a local 
method call.

The aim of this component is to build web forwards/reverse proxy to LXD/LXC 
containers on the host (or external upstreams), not as a `server{}` block configurator.

The component uses nginx as a reverse proxy, it relies on php7-fpm being 
installed and will overwrite `/etc/nginx/nginx.conf`! So if you already have
nginx installed then dont use this component as it will most likely break your stuff.

## ::Installing::

Bring in the project with composer:

    {
    	"require": {
    		"plinker/nginx": ">=v0.1"
    	}
    }
    
    
Then navigate to `./vendor/plinker/nginx/scripts` and run `bash install.sh`


The webroot for plinker will be `/var/www/html` so plinker should be in there.
The difference being that nginx will listen on port 88 for plinker calls, 
and 80, 443 for the reverse proxy.

::Client::
---------

    /**
     * Plinker Config
     */
    $config = [
        // plinker connection
        'plinker' => [
            'endpoint' => 'http://127.0.0.1:88',
            'public_key'  => 'makeSomethingUp',
            'private_key' => 'againMakeSomethingUp'
        ],
    
        // database connection
        'database' => [
            'dsn'      => 'sqlite:./.plinker/database.db',
            'host'     => '',
            'name'     => '',
            'username' => '',
            'password' => '',
            'freeze'   => false,
            'debug'    => false,
        ]
    ];
    
    // init plinker endpoint client
    $nginx = new \Plinker\Core\Client(
        // where is the plinker server
        $config['plinker']['endpoint'],
    
        // component namespace to interface to
        'Nginx\Manager',
    
        // keys
        $config['plinker']['public_key'],
        $config['plinker']['private_key'],
    
        // construct values which you pass to the component, which the component
        //  will use, for RedbeanPHP component you would send the database connection
        //  dont worry its AES encrypted. see: encryption-proof.txt
        $config
    );
    
::Calls::
---------

**Setup**

Applies build tasks to plinker/tasks queue.

    $nginx->setup([
        'build_sleep' => 1    
    ])

**Create**

    $route = [
        'label' => 'Example',
        'ownDomain' => [
            ['name' => 'example.com'],
            ['name' => 'www.example.com']
        ],
        'ownUpstream' => [
            ['ip' => '127.0.0.1', 'port' => '80']
        ],
        'letsencrypt' => 0,
        'enabled' => 1
    ];
    $nginx->add($route);

**Update**

    $route = [
        'label' => 'Example Changed',
        'ownDomain' => [
            ['name' => 'example.com'],
            ['name' => 'www.example.com'],
            ['name' => 'new.example.com']
        ],
        'ownUpstream' => [
            ['ip' => 10.0.0.1', 'port' => '8080']
        ],
        'letsencrypt' => 0,
        'enabled' => 1
    ];
    // column, value, $data
    $nginx->update('id = ?', [1], $data);

**Fetch**
    
    $nginx->fetch('route');
    $nginx->fetch('route', 'id = ?', [1]);
    $nginx->fetch('route', 'name = ?', ['some-guidV4-value'])

**Remove**

    $nginx->remove('name = ?', [$route['name']]);

**Rebuild**

    $nginx->rebuild('name = ?', [$route['name']]);

**Reset**

    // dont remove tasks
    $nginx->reset();
    
    // remove tasks
    $nginx->reset(true);
    

See the [organisations page](https://github.com/plinker-rpc) for additional 
components and examples.
