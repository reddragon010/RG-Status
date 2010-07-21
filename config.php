<?php          
$config['cache_timeout'] = 20;
$config['socket_timeout'] = 8;  

//REALM 1: LOGIN
$config['realms'][1]['name'] = 'Login';
$config['realms'][1]['ip']	 = '94.23.195.96';
$config['realms'][1]['port'] = 3724;

//REALM 2: PVP
$config['realms'][2]['name'] = 'PvP';
$config['realms'][2]['ip']	 = '94.23.33.162';
$config['realms'][2]['port'] = 8085;

//REALM 3: PVE
$config['realms'][3]['name'] = 'PvE';
$config['realms'][3]['ip']	 = '94.23.6.9';
$config['realms'][3]['port'] = 8090;

?>