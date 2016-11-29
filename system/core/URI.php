<?php

defined('ROOT') or exit('Forbidden.');

class PC_URI {

	function __construct(){
		$this->set_uri();
	}

	private function set_uri(){
		$uri = str_replace($_SERVER['REQUEST_URI'],'', $_SERVER['SCRIPT_NAME']);
	    if($uri == 'index.php') {
    	  	$uri = '';
    	} else {
   	   		$uri = str_replace( $_SERVER['SCRIPT_NAME'],'', $_SERVER['REQUEST_URI']);
      		$uri = preg_replace("|/*(.+?)/*$|", "\\1",str_replace("\\", "/", $uri));
      		$uri = trim($uri, '/');
    	}
    	$this->uri = preg_split('[\\/]', $uri, 0, PREG_SPLIT_NO_EMPTY);
	}

	function segment($segment = 0, $all){
		if(isset($this->uri[$segment])){
			if($all === false){
				$this->segment[$segment] = $this->uri[$segment];	
			} else {
				$this->segment = $this->uri;
			}
			return $this->segment;
		}
	}
}