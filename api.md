## Table of contents

- [\Plinker\Asterisk\Asterisk](#class-plinkerasteriskasterisk)
- [\Plinker\Base91\Base91](#class-plinkerbase91base91)
- [\Plinker\Core\Signer](#class-plinkercoresigner)
- [\Plinker\Core\Server](#class-plinkercoreserver)
- [\Plinker\Core\Client](#class-plinkercoreclient)
- [\Plinker\Cron\lib\CronFileWriter](#class-plinkercronlibcronfilewriter)
- [\Plinker\LXC\Manager](#class-plinkerlxcmanager)
- [\Plinker\LXC\Models\Model](#class-plinkerlxcmodelsmodel)
- [\Plinker\System\System](#class-plinkersystemsystem)
- [\Plinker\Tasks\Runner](#class-plinkertasksrunner)
- [\Plinker\Tasks\Model](#class-plinkertasksmodel)
- [\Plinker\Tasks\Lib\PID](#class-plinkertaskslibpid)
- [\Plinker\Test\Demo](#class-plinkertestdemo)

<hr />

### Class: \Plinker\Asterisk\Asterisk

| Visibility | Function |
|:-----------|:---------|
| public | <strong>ExtensionState(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>Construct</em> |
| public | <strong>agiShowCommands(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>callContact(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>command(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Local getter for the asm command method</em> |
| public | <strong>coreShowChannels(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Connect into AMI and issue asterisk command [core show channels]</em> |
| public | <strong>create(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em><br /><em>Create json $asterisk->create(string, array);</em> |
| public | <strong>deleteContact(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>deleteWhere(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Delete bean by where query json $plink->delete(string, string);</em> |
| public | <strong>dial(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Connect into AMI and issue asterisk command [originate]</em> |
| public | <strong>exec(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>int</em><br /><em>Raw query json $plink->exec(string);</em> |
| public | <strong>findAll(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em><br /><em>Find all json $plink->findAll(string, string, array);</em> |
| public | <strong>getActiveCalls(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>getContact(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>getContacts(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>getLatestCalls(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>getQueue(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em><br /><em>Connect into AMI and issue asterisk command [queue show ?]</em> |
| public | <strong>getSysinfo(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>newContact(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>reload(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>showChannels(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>sipPeers(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>sipShowPeers(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Connect into AMI and retrieve asterisk command [sip show peers] and regex parse the response into an array</em> |
| public | <strong>updateContact(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>updateWhere(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Update bean by where query json $plink->updateWhere(string, string, array);</em> |

<hr />

### Class: \Plinker\Base91\Base91

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>decode(</strong><em>string</em> <strong>$input</strong>)</strong> : <em>string</em><br /><em>base91 encode input string</em> |
| public static | <strong>encode(</strong><em>string</em> <strong>$input</strong>)</strong> : <em>string</em><br /><em>base91 decode input string</em> |

<hr />

### Class: \Plinker\Core\Signer

> Payload signing class

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$publicKey=null</strong>, <em>string</em> <strong>$privateKey=null</strong>, <em>bool</em> <strong>$encrypt=true</strong>)</strong> : <em>void</em><br /><em>Construct</em> |
| public | <strong>authenticatePacket(</strong><em>array</em> <strong>$packet=array()</strong>)</strong> : <em>bool</em><br /><em>Authenticate payload packet</em> |
| public | <strong>decode(</strong><em>array</em> <strong>$packet=array()</strong>)</strong> : <em>object</em><br /><em>Payload decode/decrypt Validates and decodes payload packet</em> |
| public | <strong>encode(</strong><em>array</em> <strong>$packet=array()</strong>)</strong> : <em>array</em><br /><em>Payload encode/encrypt Encodes and signs the payload packet</em> |

<hr />

### Class: \Plinker\Core\Server

> Server endpoint class

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array/string</em> <strong>$post=array()</strong>, <em>string</em> <strong>$publicKey=`''`</strong>, <em>string</em> <strong>$privateKey=`''`</strong>, <em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>execute()</strong> : <em>void</em> |

<hr />

### Class: \Plinker\Core\Client

> Client class

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>string</em> <strong>$action</strong>, <em>array</em> <strong>$params</strong>)</strong> : <em>void</em><br /><em>Magic caller</em> |
| public | <strong>__construct(</strong><em>string</em> <strong>$endpoint</strong>, <em>string</em> <strong>$component</strong>, <em>string</em> <strong>$publicKey=`''`</strong>, <em>string</em> <strong>$privateKey=`''`</strong>, <em>array</em> <strong>$config=array()</strong>, <em>bool</em> <strong>$encrypt=true</strong>)</strong> : <em>void</em> |
| public | <strong>useComponent(</strong><em>string</em> <strong>$component=`''`</strong>, <em>array</em> <strong>$config=array()</strong>, <em>bool</em> <strong>$encrypt=true</strong>)</strong> : <em>void</em><br /><em>Helper which changes the server component on the fly without changing the connection</em> |

<hr />

### Class: \Plinker\Cron\lib\CronFileWriter

> Flatfile CRUD class

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$file</strong>)</strong> : <em>void</em><br /><em>construct loads [or creates] the file</em> |
| public | <strong>create(</strong><em>string</em> <strong>$delim=`'#'`</strong>, <em>string</em> <strong>$data=`'
'`</strong>)</strong> : <em>mixed</em><br /><em>Create or update an entry in the .htaccess file</em> |
| public | <strong>delete(</strong><em>string</em> <strong>$delim=`'#'`</strong>)</strong> : <em>bool</em><br /><em>Delete entry from .htaccess file</em> |
| public | <strong>drop()</strong> : <em>void</em> |
| public | <strong>dump()</strong> : <em>void</em> |
| public | <strong>read(</strong><em>string</em> <strong>$delim=`'#'`</strong>)</strong> : <em>mixed (bool/\Plinker\Cron\lib\string)</em><br /><em>Read entry from .htaccess file</em> |
| public | <strong>update(</strong><em>string</em> <strong>$delim=`'#'`</strong>, <em>string</em> <strong>$data=`'
'`</strong>)</strong> : <em>void</em><br /><em>Update entry in .htaccess file</em> |

<hr />

### Class: \Plinker\LXC\Manager

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>autostart(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>backup(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>clearLog(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>clearTask(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>copy(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>create(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>destroy(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>exec(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>freeze(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>getLog(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>getTask(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>mixed</em> |
| public | <strong>info(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>isCreatingContainer(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>bool</em> |
| public | <strong>isCreatingOrDestroyingContainer(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>bool</em> |
| public | <strong>isDestroyingContainer(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>bool</em> |
| public | <strong>ls()</strong> : <em>void</em> |
| public | <strong>rename(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>restore(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>start(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>stop(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |
| public | <strong>unfreeze(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em> |

<hr />

### Class: \Plinker\LXC\Models\Model

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$config</strong>)</strong> : <em>void</em> |
| public | <strong>count(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Count</em> |
| public | <strong>create(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create</em> |
| public | <strong>exec(</strong><em>mixed</em> <strong>$sql</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>void</em><br /><em>Exec</em> |
| public | <strong>export(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Export Exports bean into an array</em> |
| public | <strong>find(</strong><em>mixed</em> <strong>$table=null</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Find</em> |
| public | <strong>findAll(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Get</em> |
| public | <strong>findOne(</strong><em>mixed</em> <strong>$table=null</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Find One</em> |
| public | <strong>findOrCreate(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>findOrCreate</em> |
| public | <strong>load(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$id</strong>)</strong> : <em>mixed</em><br /><em>Load (id)</em> |
| public | <strong>nuke()</strong> : <em>void</em><br /><em>Nuke Destroys database</em> |
| public | <strong>store(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Store</em> |
| public | <strong>trash(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Trash Row</em> |
| public | <strong>update(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>, <em>array</em> <strong>$data=array()</strong>)</strong> : <em>void</em><br /><em>Update</em> |

<hr />

### Class: \Plinker\System\System

> System information Some methods require root and not all work with windows.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>arch()</strong> : <em>string</em><br /><em>Get system architecture</em> |
| public | <strong>clear_swap()</strong> : <em>void</em><br /><em>Clear swapspace</em> |
| public | <strong>cpuinfo()</strong> : <em>void</em><br /><em>Get system CPU info output</em> |
| public | <strong>disk_space(</strong><em>string</em> <strong>$path=`'/'`</strong>)</strong> : <em>int</em><br /><em>Get diskspace</em> |
| public | <strong>disks(</strong><em>bool</em> <strong>$parse=true</strong>)</strong> : <em>string</em><br /><em>Get disk file system table</em> |
| public | <strong>distro()</strong> : <em>string</em><br /><em>Get system distro</em> |
| public | <strong>drop_cache()</strong> : <em>void</em><br /><em>Drop memory caches</em> |
| public | <strong>enumerate(</strong><em>array</em> <strong>$methods=array()</strong>)</strong> : <em>void</em><br /><em>Enumerate multiple methods, saves on HTTP calls</em> |
| public | <strong>hostname()</strong> : <em>string</em><br /><em>Get system hostname</em> |
| public | <strong>load()</strong> : <em>string</em><br /><em>Get system load</em> |
| public | <strong>logins(</strong><em>bool</em> <strong>$parse=true</strong>)</strong> : <em>string</em><br /><em>Get system last logins</em> |
| public | <strong>machine_id()</strong> : <em>string</em><br /><em>Get system machine-id - Generates one if does not have one (windows).</em> |
| public | <strong>memory_stats()</strong> : <em>array</em><br /><em>Get memory usage</em> |
| public | <strong>memory_total()</strong> : <em>int</em><br /><em>Get memory total bytes</em> |
| public | <strong>netstat(</strong><em>string</em> <strong>$option=`'-ant'`</strong>, <em>bool</em> <strong>$parse=true</strong>)</strong> : <em>string</em><br /><em>Get netstat output</em> |
| public | <strong>ping(</strong><em>string</em> <strong>$host=`''`</strong>)</strong> : <em>float</em><br /><em>Ping a server and return timing</em> |
| public | <strong>pstree()</strong> : <em>string</em><br /><em>Get system process tree</em> |
| public | <strong>reboot()</strong> : <em>void</em><br /><em>Reboot the system</em> |
| public | <strong>server_cpu_usage()</strong> : <em>int</em><br /><em>Get CPU usage in percentage</em> |
| public | <strong>system_updates()</strong> : <em>int 1=has updates, 0=no updates, -1=dunno</em><br /><em>Check system for updates</em> |
| public | <strong>top(</strong><em>bool</em> <strong>$parse=true</strong>)</strong> : <em>void</em><br /><em>Get system top output</em> |
| public | <strong>total_disk_space(</strong><em>string</em> <strong>$path=`'/'`</strong>)</strong> : <em>int</em><br /><em>Get total diskspace</em> |
| public | <strong>uname()</strong> : <em>string</em><br /><em>Get system name/kernel version</em> |
| public | <strong>uptime(</strong><em>string</em> <strong>$option=`'-p'`</strong>)</strong> : <em>void</em><br /><em>Get system uptime</em> |

<hr />

### Class: \Plinker\Tasks\Runner

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$index</strong>)</strong> : <em>void</em><br /><em>Getter</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$index</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>Setter</em> |
| public | <strong>daemon(</strong><em>string</em> <strong>$class</strong>, <em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>Daemon - run continuously for 1 minute.</em> |
| public | <strong>run(</strong><em>string</em> <strong>$class</strong>, <em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>Run once</em> |

<hr />

### Class: \Plinker\Tasks\Model

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$database</strong>)</strong> : <em>void</em> |
| public | <strong>count(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Count</em> |
| public | <strong>create(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>Create</em> |
| public | <strong>exec(</strong><em>mixed</em> <strong>$sql</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>void</em><br /><em>Exec</em> |
| public | <strong>export(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Export Exports bean into an array</em> |
| public | <strong>find(</strong><em>mixed</em> <strong>$table=null</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Find</em> |
| public | <strong>findAll(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Get</em> |
| public | <strong>findOne(</strong><em>mixed</em> <strong>$table=null</strong>, <em>mixed</em> <strong>$where=null</strong>, <em>mixed</em> <strong>$params=null</strong>)</strong> : <em>mixed</em><br /><em>Find One</em> |
| public | <strong>findOrCreate(</strong><em>array</em> <strong>$data=array()</strong>)</strong> : <em>mixed</em><br /><em>findOrCreate</em> |
| public | <strong>load(</strong><em>mixed</em> <strong>$table</strong>, <em>mixed</em> <strong>$id</strong>)</strong> : <em>mixed</em><br /><em>Load (id)</em> |
| public | <strong>nuke()</strong> : <em>void</em><br /><em>Nuke Destroys database</em> |
| public | <strong>store(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Store</em> |
| public | <strong>trash(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>)</strong> : <em>void</em><br /><em>Trash Row</em> |
| public | <strong>update(</strong><em>\RedBeanPHP\OODBBean</em> <strong>$row</strong>, <em>array</em> <strong>$data=array()</strong>)</strong> : <em>void</em><br /><em>Update</em> |

<hr />

### Class: \Plinker\Tasks\Lib\PID

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$directory=`''`</strong>, <em>string</em> <strong>$task=`'default'`</strong>)</strong> : <em>void</em> |
| public | <strong>__destruct()</strong> : <em>void</em> |
| public | <strong>script_memory_usage()</strong> : <em>void</em> |

<hr />

### Class: \Plinker\Test\Demo

> A few basic methods which demostrate how easy it is to define a class to interface to, a range of data types can be sent back from strings, arrays, objects, closures or even self/this.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$config=array()</strong>)</strong> : <em>void</em><br /><em>Array ( [foo] => bar [time] => 1505829919.8237 [self] => http://127.0.0.1/example/server.php [component] => Test\Demo [config] => Array ( [foo] => bar ) [action] => config [params] => Array ( ) [data] => ...snip / encrypted payload [public_key] => 01418673ae1efc38699b408567231f8311a3fe561483268be5bade7d0bf24fd8 [request_time] => 1505829919 [encrypt] => 1 [token] => 48d4b40332d09035ea0a623bbc5bb17e9159c36e8078190688bae4e6c888e9a8 )</em> |
| public | <strong>an_array(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Returns an array, see no need to encode it for return, just how it should be.</em> |
| public | <strong>closure(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>By using Opis Closure, we can serilise a closure and return for local execution.</em> |
| public | <strong>config(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>Returns the config array which is set above</em> |
| public | <strong>my_ip(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>The servers IP address.</em> |
| public | <strong>my_time(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>The servers version of time, an example of a string.</em> |
| public | <strong>this(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>By calling this you can retrun the entire class to call locally.</em> |
| public | <strong>your_ip(</strong><em>array</em> <strong>$params=array()</strong>)</strong> : <em>void</em><br /><em>The callers IP address, well unless your being forwarded.</em> |

