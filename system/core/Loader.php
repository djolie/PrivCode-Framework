<?php

class PC_Loader {
	function __construct(){
		$this->PC = &get_instance();
	}

	function helper($helper){
		file_loader($helper, 'helpers');
	}

	function library($lib, $name = FALSE){
		if($name !== FALSE){
			$name = strtolower($name);
		} else {
			$name = strtolower($lib);
		}
		return $this->PC->{$name} = class_loader(ucfirst(strtolower($lib)), 'libraries');
	}

	function model($model, $name = FALSE){
		if($name !== FALSE){
			$name = strtolower($name);
		} else {
			$name = strtolower($model);
		}
		return $this->PC->{$name} = class_loader(ucfirst(strtolower($model)), 'models');
	}

	function view($view, $data = NULL){
		if(!file_exists(VIEWS.$view.'.php')){
			error(VIEWS.$view.'.php'.' file is not exist, please make sure create view before.');
		}
		if(!is_null($data)){
			foreach ($data as $key => $value) {
				${$key} = $value;
			}	
		}
		require_once VIEWS.$view.'.php';
	}
}