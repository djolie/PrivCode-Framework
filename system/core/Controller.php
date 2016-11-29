<?php

defined('ROOT') or exit('Forbidden.');

class PC_Controller {

	public $load;
  	private static $instance;

	function __construct(){
		self::$instance =& $this;
		$this->load = class_loader('Loader', 'core');
	}
	
	public static function &get_instance() {
    	return self::$instance;
	}
}