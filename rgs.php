<?php
include('config.php');
//get doc-selector
if(isset($_GET['t'])){
	$type = $_GET['t'];  
} else {
	$type = false;
}
//select which doc should be served
$cachefile = 'cache.js';
//if cache is present and up-to-date serve it and quit
if ($config['cache'] && file_exists($cachefile) && (time() - $config['cache_timeout'] < filemtime($cachefile))) {
	include($cachefile);
	exit;
}

//if cache is expired or missing start output-buffer
ob_start();

include('realmstatus.class.php');
include('functions.include.php');
//getting & setting callback
if(isset($_GET['callback'])){
	$callback = $_GET['callback'];
} else {
	$callback = 'rgs';
}
//load all realms defined in the config-file
foreach($config['realms'] as $realmconfig){
	$realms[] = new realm($realmconfig['name'],$realmconfig['ip'],$realmconfig['port'],$config['socket_timeout']);
}
//generate js
echo($callback);
echo("(");
echo(json_encode($realms));
echo(");");
//write output to cache-file
$fp = fopen($cachefile, 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
//and send it to the client
ob_end_flush();
?>