<?php

defined('ROOT') or exit('Forbidden.');


if(!function_exists('get_instance')){
	function &get_instance(){
		return PC_Controller::get_instance();
	}
}

if(!function_exists('file_loader')){
	function file_loader($file, $dir, $return = false){

		$found = FALSE;
		$dir = strtolower($dir);
		foreach (array(APP, VIEWS, SYS) as $baseDir) {
			$pathFile = $baseDir.$dir.DIRECTORY_SEPARATOR.$file.'.php';
			if(file_exists($pathFile)){
				$found = TRUE;
				require_once $pathFile;
				break;
			}
		}
		if($found){
			if($return){
				$var = strtolower($file);
				return ${$dir}[$var];
			}
		} else {
			error($pathFile.' not exist.');
		}
	}
}

if(!function_exists('class_loader')){
	function class_loader($class, $dir, $param = FALSE){
		
		$found = FALSE;
		$className = ucfirst(strtolower($class));
		$dir = strtolower($dir);
		foreach (array(APP, SYS) as $baseDir) {
			$pathFile = $baseDir.$dir.DIRECTORY_SEPARATOR.$className.'.php';
			if(file_exists($pathFile)){
				$found = TRUE;
				require_once $pathFile;
				break;
			}
		}
		
		if($found){
			$sysDir = array('core');
			/*Add prefix for system class.*/
			if(in_array($dir, $sysDir)){
				$className = 'PC_'.$className;
			}
			/*Check class*/
			if(class_exists($className)){
				$exec[$className] = isset($param) ? new $className($param) : new $className();
				return $exec[$className];
			} else {
				error('<code>Class not exists in '.$pathFile.'</code>');
			}
		} else {
			error('<code>'.$pathFile.' not exist.</code>');
		}
	}
}

if(!function_exists('error')){
	function error($message, $heading = 'An Error Was Encountered', $type = 'general'){
		require_once SYS.'template/errors/'.$type.'.php';
		exit();
	}
}