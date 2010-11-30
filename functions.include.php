<?php    
function currurl($file) {
	if($_SERVER['SERVER_PORT']!=80){
		return str_replace($file, '','http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['PHP_SELF']);
	} else {
		return str_replace($file, '','http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
	}
}
?>