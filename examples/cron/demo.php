<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Lawrence Cherone">
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<style>
        body{background:#f8f8f8;color:#333;font:14px/20px HelveticaNeue-Light, "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;margin:0}
        pre{margin:0;padding:0}
        h1{margin:0;background:#99c;border-bottom:4px solid #669;box-shadow:0 1px 4px #bbb;color:#222;font:bold 28px Verdana,Arial;padding:12px 15px}
        h1 small{margin-top:7px;margin-right:7px;}
        h1 small a span{color:#e7e7e7;}
        h2{border-bottom:1px solid #ddd;font:normal 18px/20px serif;margin:20px 10px 0;padding:5px 0 8px}
        h2 .btn{font:12px HelveticaNeue-Light, "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;margin-top:-10px}
        p{color:#555}
        .api-info{margin-left:20px;padding:10px 0}
        .tab-content{border-left: 1px solid #ddd;border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 10px;background:#fff}
        .nav-tabs{margin-bottom:0}
		</style>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<h1>Yar Client <small class="pull-right"><a href="#"><span>...</span></a></small></h1>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2>Page Title <small class="text-muted">(instances of this script)</small></h2>
					<p class="api-info">
						A sub title.
					</p>
					<div class="col-md-12">
					    <ul class="nav nav-tabs">
							<li class="active"><a data-target="#tab-1" data-toggle="tab" style="cursor:pointer">Tab A</a></li>
							<li><a data-target="#tab-2" data-toggle="tab" style="cursor:pointer">Tab B</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab-1">
							    ...Tab A content
							</div>
							<div class="tab-pane" id="tab-2">
							    ...Tab B content
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require '../../vendor/autoload.php';


class Docs {
    
    public static $sections = [];
    
    static function addItem()
    {
        Docs::$sections[] = 'foo';
    }
    
    static function render()
    {
        print_r(Docs::$sections);
    }
}


Docs::addItem();
Docs::render();

$component = [
    'title'     => ucfirst(basename(__DIR__)),
    'composer'  => '',
    'namespace' => 'Foobar\Baz',
    'sections'  => [
        'header'  => 'PlinkerRPC PHP client/server makes it really easy to link and execute PHP component classes on remote systems, while maintaining the feel of a local method call.',
        'install' => '',
        'client'  => '',
        'server'  => '',
        'methods' => [
            'xxx'    => 'This is the xxxx section which should not fart out...',
            'xsssxx' => 'asdadasdt...'
        ], 
        'footer' => 'See the [organisations page](https://github.com/plinker-rpc) for additional components and examples.',
    ],
];

$dom = new DOMDocument();

$html = $dom->createElement('html');
$html = $dom->appendChild($html);

$head = $dom->createElement('head');
$head = $html->appendChild($head);

$title = $dom->createElement('title');
$title = $head->appendChild($title);

$text = $dom->createTextNode('Plinker-RPC - '.$component['title']);
$text = $title->appendChild($text);

$body = $dom->createElement('body');
$body = $html->appendChild($body);

foreach ($component['sections'] as $type => $section) {
    $div  = $dom->createElement('div');
    
    if (is_array($section)) {
        $section = implode(PHP_EOL, $section);
    }
    
    $text = $dom->createTextNode($section);
    $text = $div->appendChild($text);
    
    $div = $body->appendChild($div);
}

echo $dom->saveHTML();

$markdown = '**Plinker-RPC - '.$component['title'].'**
=============================

'.$component['sections']['header'].PHP_EOL;

file_put_contents(
    'api.md',
    $markdown.PHP_EOL.PHP_EOL.'## ::Methods::'.PHP_EOL
);
function debug($title, $out, $description = null) {
    // output HTML
    echo '<h3 style="margin-bottom:-10px">'.$title.'</h3>';
    echo !empty($description) ? '<p>'.$description.'</p>' : null;
    echo '<pre style="tab-width: 4;font-size:11px;white-space: pre-wrap;">'.print_r($out, true).'</pre>';
    echo '<hr>';
    //
    file_put_contents(
        'api.md', 
        PHP_EOL.'**'.$title.'**'.PHP_EOL.PHP_EOL.$description.PHP_EOL.PHP_EOL.'`'.$out.'`'.PHP_EOL, 
        FILE_APPEND
    );
}


try {
    // load config file - (for testing)
    $config = parse_ini_file('../config.ini', true);
    
    /**
     * Plinker Config
     */
    $config = [
        // plinker connection | using tasks as to write in the correct .sqlite file
        'plinker' => $config['plinker'],
    
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

    #
    debug('$cron->crontab()', $cron->crontab(), 'Get crontab as-is');
    
    debug('$cron->create(\'My Cron Task\', \'* * * * * cd ~\')', $cron->create('My Cron Task', '* * * * * cd ~'), 'Create a crontask');
    
    debug('$cron->get(\'My Cron Task\')', $cron->get('My Cron Task'), 'Get cron task');
    
    debug('$cron->update(\'My Cron Task\', \'0 * * * * cd ~\')', $cron->update('My Cron Task', '0 * * * * cd ~'), 'Update cron task');
    
    debug('$cron->read(\'My Cron Task\')', $cron->read('My Cron Task'), 'Read cron task');
    
    debug('$cron->delete(\'My Cron Task\')', $cron->delete('My Cron Task'), 'Delete cron task');

    debug('$cron->drop()', $cron->drop(), 'Drop/Clear crontab journal');
    
    debug('$cron->dump()', $cron->dump(), 'Return current crontab as plain text');
    
    debug('$cron->apply()', $cron->apply(), 'Apply crontab');

    
} catch (\Exception $e) {
    exit(get_class($e).': '.$e->getMessage());
}
