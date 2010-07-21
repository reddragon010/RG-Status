<?php

class realm {
	public $name;
	public $ip;
	public $port;
	public $players;
	public $online;
	
	function __construct($name, $ip, $port, $socket_timeout=3, $players=false) {
		$this->name = $name;
		$this->ip = $ip;
		$this->port = $port;
		$this->players = $players;
		$this->getonlinestatus($socket_timeout);
	}                          
	
	function getonlinestatus($timeout) {
		try {
			$fp = @fsockopen($this->ip, $this->port, $errno, $errstr, $timeout);
			if(!$fp) {
					$this->online = 0;
			}
			else {
					$this->online = 1;
			}
		} catch(Exception $e) {
			$this->online = 0;
		}
	}
}

?>