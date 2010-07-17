<?php
	$cache_time='cache/pve_time.txt';
	$cache_file='cache/pve_stat.txt';	
	$server_ip="94.23.6.9";	
	$server_port=8090;

	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title>Realm-Status </title>
      <meta http-equiv="refresh" content="10; '.$_SERVER['PHP_SELF'].'">
    </head>
    <body style="margin:0px; padding:0px;">
      <div style="display:none;">';

			$fh = fopen( $cache_time, 'r');
			$last_time = fread($fh, filesize($cache_time));
			fclose($fh);
			$last_time=$last_time+9;

			if ( time()>$last_time ) {
					$fp = fsockopen($server_ip, $server_port, $errno, $errstr, 3);
					if(!$fp) {
							$status='0';
					}
					else {
							socket_set_timeout($fp, 4);
							$res = fread($fp, 4);
							fclose($fp);
							if ( strlen($res)>0 ) {
									$status='2';
							}
							else {
									$status='1';
							}
					}
					$fh = fopen($cache_time, 'w+');
					fwrite($fh, time());
					fclose($fh);
					$fh = fopen($cache_file, 'w+');
					fwrite($fh, $status);
					fclose($fh);
			}
			else {
					$fh = fopen($cache_file, 'r');
					$status = fread($fh, filesize($cache_file));
					fclose($fh);
			}
			echo  '      </div>
      <center>
        ';

			if ( $status==0 ) {
					echo '<img src="images/down.png" alt="Down" title="Down">';
			}
			if ( $status==1 ) {
					echo '<img src="images/hanging.png" alt="Hanging" title="Hanging">';
			}
			if ( $status==2 ) {
					echo '<img src="images/up.png" alt="Up" title="Up">';
			}
			echo '
      </center>
    </body>
  </html>';
?>