<?php
//returns template as string
function include_template($filename,$realms) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}     

function currurl($file) {
	if($_SERVER['SERVER_PORT']!=80){
		return str_replace($file, '','http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['PHP_SELF']);
	} else {
		return str_replace($file, '','http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
	}
}
?>