<?php
include('config.php');
//get doc-selector
if(isset($_GET['t'])){
	$type = $_GET['t'];  
} else {
	$type = false;
}
//select which doc should be served
if($type=="js"){
	$cachefile = 'cache.js';
} else {
	$cachefile = 'cache.html';
}
//if cache is present and up-to-date serve it and quit
if (file_exists($cachefile) && (time() - $config['cache_timeout'] < filemtime($cachefile))) {
	include($cachefile);
	exit;
}
//if cache is expired or missing start output-buffer
ob_start();
?>
<?php
include('realmstatus.class.php');
include('functions.include.php');
//load all realms defined in the config-file
foreach($config['realms'] as $realmconfig){
	$realms[] = new realm($realmconfig['name'],$realmconfig['ip'],$realmconfig['port'],$config['socket_timeout']);
}
//generate js if js is selected
if($type=='js'){ ?>
<?php 
echo("document.write('");
echo(str_replace(array("\r", "\r\n", "\n", "\t"), '', include_template("template.php",$realms))); 
echo("');");
?>
<?php } else { //generate html if something else is selected ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo(currurl('rgs.php')); ?>rgs.css">  
</head>
<body>
<?php include("template.php"); ?>  
</body>
</html>  
<?php } ?>
<?php
//write output to cache-file
$fp = fopen($cachefile, 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
//and send it to the client
ob_end_flush();
?>