<?php

$system = 'system';

$application = 'applications';

$views  = '';


define('ROOT', realpath(false).DIRECTORY_SEPARATOR);

if(($sys = realpath(ROOT.$system)) !== FALSE){
	define('SYS', $sys.DIRECTORY_SEPARATOR);
} else {
	//config_error($system);
}
if(($app = realpath(ROOT.$application)) !== FALSE){
	define('APP', $app.DIRECTORY_SEPARATOR);
} else {
	//config_error($application);
}
if($views == '' && is_dir(APP.'views'.DIRECTORY_SEPARATOR)){
	$view_dir = APP.'views'.DIRECTORY_SEPARATOR;
} else if(isset($views)){
	if((realpath(ROOT.$views)) !== FALSE){
		$view_dir = ROOT.$views.DIRECTORY_SEPARATOR;
	} else {
		//config_error($views);
	}
}

define('VIEWS', $view_dir);

require SYS.'core/PrivCode.php';