# System

A system component which gives you access to server information.

## Install

Require this package with composer using the following command:

``` bash
$ composer require plinker/system
```

## Client

Creating a client instance is done as follows:


    <?php
    require 'vendor/autoload.php';

    /**
     * Initialize plinker client.
     *
     * @param string $server - URL to server listener.
     * @param string $config - server secret, and/or a additional component data
     */
    $client = new \Plinker\Core\Client(
        'http://example.com/server.php',
        [
            'secret' => 'a secret password'
        ]
    );
    
    // or using global function
    $client = plinker_client('http://example.com/server.php', 'a secret password');
    

## Methods

Once setup, you call the class though its namespace to its method.

### Enumerate

The enumerate method is used to call multiple methods in a single call to reduce RPC requests.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| methods     | string|array   | A string or an array of methods | `[]`     |
| params      | array          | An array of params  | `[]`     |

The method could be used to call a single method, or multiple with parameters.

**Call**
``` php
$client->system->enumerate([
    'arch',
    'hostname',
    'disks' => ['/'],
    'ping' => ['https://google.com'],
]);

// or single method
$client->system->enumerate('disks', ['/']);
```

**Response**
``` text
Array
(
    [arch] => x86_64
    [hostname] => plinker
    [disks] => Array
        (
            [0] => Array
                (
                    [Filesystem] => /dev/sdb1
                    [Type] => ext4
                    [Size] => 95G
                    [Used] => 85G
                    [Avail] => 5.2G
                    [Used (%)] => 95%
                    [Mounted] => /
                )

        )

    [ping] => -1
)
```

### Arch

Returns the system architecture.

**Call**
``` php
$client->system->arch();
```

**Response**
``` text
x86_64
```

### Clear Swap

Clear swap space, **requires root, so should be used with task**.

**Call**
``` php
$client->system->clear_swap();
```

**Response**
``` text

```

### CPU Info

Returns information about the CPU.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| parse       | bool           | Parse output into an array | `true` |

**Call**
``` php
$client->system->cpu_info();
```

**Response**
``` text
Array
(
    [Architecture] => x86_64
    [CPU op-mode(s)] => 32-bit, 64-bit
    [Byte Order] => Little Endian
    [CPU(s)] => 2
    [On-line CPU(s) list] => 0,1
    [Thread(s) per core] => 1
    [Core(s) per socket] => 2
    [Socket(s)] => 1
    [NUMA node(s)] => 1
    [Vendor ID] => AuthenticAMD
    [CPU family] => 16
    [Model] => 4
    [Model name] => AMD Phenom(tm) II X2 555 Processor
    [Stepping] => 3
    [CPU MHz] => 3200.000
    [CPU max MHz] => 3200.0000
    [CPU min MHz] => 800.0000
    [BogoMIPS] => 6429.27
    [Virtualization] => AMD-V
    [L1d cache] => 64K
    [L1i cache] => 64K
    [L2 cache] => 512K
    [L3 cache] => 6144K
    [NUMA node0 CPU(s)] => 0,1
    [Flags] => fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush mmx fxsr sse sse2 ht syscall nx mmxext fxsr_opt pdpe1gb rdtscp lm 3dnowext 3dnow constant_tsc rep_good nopl nonstop_tsc cpuid extd_apicid pni monitor cx16 popcnt lahf_lm cmp_legacy svm extapic cr8_legacy abm sse4a misalignsse 3dnowprefetch osvw ibs skinit wdt hw_pstate retpoline retpoline_amd rsb_ctxsw vmmcall npt lbrv svm_lock nrip_save
)
```

### Disk Space

Returns disk space left in percentage.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| path        | string         | A directory of the filesystem or disk partition. | `/` |


**Call**
``` php
$client->system->disk_space();
```

**Response**
``` text
71
```

### Disks

Return mounted disks.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| parse       | bool           | Parse output into an array | `true` |


**Call**
``` php
$client->system->disks();

// dont parse
$client->system->disks(false);
```

**Response**
``` text
// Parsed
Array
(
    [0] => Array
        (
            [Filesystem] => /dev/sdb1
            [Type] => ext4
            [Size] => 95G
            [Used] => 85G
            [Avail] => 5.2G
            [Used (%)] => 95%
            [Mounted] => /
        )

)

// Unparsed
Filesystem     Type  Size  Used Avail Use% Mounted on
/dev/sdb1      ext4   95G   85G  5.2G  95% /
```

### Distro

Get system distro name.

**Call**
``` php
$client->system->distro();
```

**Response**
``` text
UBUNTU
```

### Drop Cache

Drop memory caches, **requires root, so should be used with task**.

**Call**
``` php
$client->system->drop_cache();
```

**Response**
``` text
true
```

### Hostname

Get the systems hostname.

**Call**
``` php
$client->system->hostname();
```

**Response**
``` text
plinker
```

### Load

Get the systems load averages.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| parse       | bool           | Parse output into an array | `true` |

**Call**
``` php
$client->system->load();
```

**Response**
``` text
Array
(
    [1m] => 1.71
    [5m] => 1.21
    [15m] => 1.14
    [curr_proc] => 3
    [totl_proc] => 1437
    [last_pid] => 3272
)
```

### Logins

Returns an array of system logins.

**Call**
``` php
$client->system->logins();
```

**Response**
``` text
Array
(
    [0] => Array
        (
            [User] => root
            [Terminal] => pts/1tmux(2972).%0
            [Date] => Fri May 11 08:25
            [Disconnected] => 11:01
            [Duration] => 02:35
        )

    [1] => Array
        (
            [User] => root
            [Terminal] => pts/1tmux(542).%0
            [Date] => Thu May 10 15:01
            [Disconnected] => 08:11
            [Duration] => 17:09
        )

    [2] => Array
        (
            [User] => Reboot
            [Terminal] => 
            [Date] => 
            [Disconnected] => 
            [Duration] => 
        )

    [3] => Array
        (
            [User] => root
            [Terminal] => pts/1tmux(5310).%0
            [Date] => Thu May 10 07:42
            [Disconnected] => crash
            [Duration] => 07:19
        )
    )
    ... snip
)
```

### Machine ID

Returns the [machine-id](http://man7.org/linux/man-pages/man5/machine-id.5.html) for the system, generates one if does not have one.

**Call**
``` php
$client->system->machine_id();
```

**Response**
``` text
82c887bcf6da43e5952fad9fd6ed15b6
```

### Memory Stats

Returns an array of memory stats for, used, cached and free in percentage values.


**Call**
``` php
$client->system->memory_stats();
```

**Response**
``` text
Array
(
    [used] => 15
    [cache] => 0
    [free] => 85
)
```

### Memory Total

Get the total amount of memory in kB

**Call**
``` php
$client->system->memory_total();
```

**Response**
``` text
16167888
```

### Netstat

Get network connections.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| parse       | bool           | Parse output into an array | `true` |


**Call**
``` php
$client->system->netstat();
```

**Response**
``` text
Array
(
    [0] => Array
        (
            [Proto] => tcp
            [Recv-Q] => 0
            [Send-Q] => 0
            [Local Address] => 0.0.0.0:80
            [Foreign Address] => 0.0.0.0:*
            [State] => LISTEN
            [PID/Program] => 1169/nginx:
            [Process Name] => worker
        )
    ... snip
)
```

### Ping

Ping a hostname and return connection timing in milliseconds.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| host        | string         | Server hostname |  |
| port        | int            | Service port, defaults to web | `80` |


**Call**
``` php
$client->system->ping('google.com');
```

**Response**
``` text
31.18
```

### PStree

Return system process tree

**Call**
``` php
$client->system->pstree();
```

**Response**
``` text
systemd-+-Brackets-+-Brackets---Brackets---Brackets-+-{Chrome_ChildIOT}
        |          |                                |-2*[{CompositorTileW}]
        |          |                                |-{Compositor}
        |          |                                |-{HTMLParserThrea}
        |          |                                |-{Renderer::FILE}
        |          |                                |-{WorkerPool/203}
        |          |                                |-{WorkerPool/210}
        |          |                                |-{WorkerPool/212}
        |          |                                `-{WorkerPool/213}
        |          |-Brackets-node-+-5*[{Brackets-node}]
        |          |               `-4*[{V8 WorkerThread}]
        |          |-{AudioThread}
        |          |-2*[{Brackets}]
        |          |-3*[{BrowserBlocking}]
        |          |-{CachePoolWorker}
        |          |-{Chrome_CacheThr}
        |          |-{Chrome_DBThread}
        |          |-{Chrome_DevTools}
        |          |-{Chrome_FileThre}
        |          |-{Chrome_FileUser}
        |          |-{Chrome_IOThread}
        |          |-{Chrome_ProcessL}
        |          |-{CompositorTileW}
        |          |-{IndexedDB}
        |          |-{NetworkChangeNo}
        |          |-{WorkerPool/1747}
        |          |-{gdbus}
        |          |-{gmain}
        |          |-{inotify_reader}
        |          |-{sandbox_ipc_thr}
        |          `-{threaded-ml}
        |-LXDui-0.0.9-x86---{LXDui-0.0.9-x86}
... snip
```

### Reboot

Reboot the server, **requires root, so should be used with task**.

**Call**
``` php
$client->system->reboot();
```

**Response**
``` text
true
```

### CPU Usage

Returns the current CPU usage in percentage value.

**Call**
``` php
$client->system->cpu_usage();
```

**Response**
``` text
23
```

### System Updates

Check whether the system has updates.

**Call**
``` php
$client->system->system_updates();
```

**Response**
``` text
1=has updates, 0=no updates, -1=unknown
```

### Top

Get top output as an array.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| parse       | bool           | Parse output into an array | `true` |

**Call**
``` php
$client->system->top();
```

**Response**
``` text
Array
(
    [0] => Array
        (
            [PID] => 27475
            [USER] => user
            [PR] => 20
            [NI] => 0
            [VIRT] => 1785692
            [RES] => 671316
            [SHR] => 140004
            [S] => S
            [%CPU] => 43.8
            [%MEM] => 4.2
            [TIME+] => 29:44.62
            [COMMAND] => chrome
        )
    ... snip
)
```

### Total Disk Space

Get total disk space in bytes.

| Parameter   | Type           | Description   | Default        |
| ----------  | -------------  | ------------- |  ------------- | 
| path        | string         | A directory of the filesystem or disk partition. | `/` |


**Call**
``` php
$client->system->total_disk_space();
```

**Response**
``` text
101369536512
```

### Uname

Get system name/kernel version.

**Call**
``` php
$client->system->uname();
```

**Response**
``` text
Linux 4.13.0-41-generic
```

### Uptime

Get system uptime string.

**Call**
``` php
$client->system->uptime();
```

**Response**
``` text
up 1 day, 17 hours, 31 minutes
```

## Testing

There are no tests setup for this component.

## Contributing

Please see [CONTRIBUTING](https://github.com/plinker-rpc/system/blob/master/CONTRIBUTING) for details.

## Security

If you discover any security related issues, please contact me via [https://cherone.co.uk](https://cherone.co.uk) instead of using the issue tracker.

## Credits

- [Lawrence Cherone](https://github.com/lcherone)
- [All Contributors](https://github.com/plinker-rpc/system/graphs/contributors)


## Development Encouragement

If you use this project and make money from it or want to show your appreciation,
please feel free to make a donation [https://www.paypal.me/lcherone](https://www.paypal.me/lcherone), thanks.

## Sponsors

Get your company or name listed throughout the documentation and on each github repository, contact me at [https://cherone.co.uk](https://cherone.co.uk) for further details.

## License

The MIT License (MIT). Please see [License File](https://github.com/plinker-rpc/system/blob/master/LICENSE) for more information.

See the [organisations page](https://github.com/plinker-rpc) for additional components.
