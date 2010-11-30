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
		$this->getdowntime();
	}                          
	
	function getonlinestatus($timeout) {
		try {
			$fp = @fsockopen($this->ip, $this->port, $errno, $errstr, $timeout);
			if(!$fp) {
				$this->online = false;
			}
			else {
				$this->online = true; 
				fclose($fp);
			}
		} catch(Exception $e) {
			$this->online = false;
		}
	}
	
	function getdowntime(){
		if($this->online){
			$this->downtime = false;
			if(file_exists($this->name)){
				unlink($this->name);
			}
		} else {
			if(file_exists($this->name)){
				$this->downtime = filemtime($this->name);
			} else {
				touch($this->name);
			}
		}
	}
}

?>