<?php

defined('ROOT') or exit('Forbidden.');

class PC_Router {
	private $segment = array();
    private $controller;
    private $method;
    private $var = array();

    function __construct(){
    	/*
        * Load URI
        */
        $this->model = class_loader('Model', 'core');
        $this->URI = class_loader('URI', 'core');
    	$this->segment = $this->URI->segment(false, true);
        /*
        *  
        */
        $this->set_controller();
        $this->set_method();
        $this->set_vars();
        $this->run();
    }

    private function set_controller(){
    	if(!isset($this->segment[0])){
    		$this->route = file_loader('route', 'config', true);
            if(empty($this->route['controller'])){
                error('Unable to determine what should be displayed. A default route has not been specified in the routing file. Please configure this file '.APP.'config/route.php');
            } 
			$this->segment[0] = $this->route['controller'];
    	}
        if(isset($this->segment[0])){
            class_loader('Controller', 'core');
            $this->controller = class_loader($this->segment[0], 'controllers');
        }
    }

    private function set_method(){
        if(!isset($this->segment[1])){
            $this->segment[1] = 'index';
        }
        if(isset($this->segment[1])){
            $this->method = $this->segment[1];
            if(!method_exists($this->controller, $this->method)){
                error('<code>Method '.$this->method.' is not exist in '.APP.'applications/'.ucfirst($this->segment[0].'.php</code>'));
            } 
        }
    }

    private function set_vars() {
        if(isset($this->segment[2])) {
            $this->var = array_slice($this->segment, 2); 
        }
    }

	function run(){
        call_user_func_array(array(&$this->controller, $this->method), $this->var);
	}
}