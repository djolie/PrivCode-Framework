<?php

defined('ROOT') or exit('Forbidden.');

/*
* Define version
*/
define('VERSION', '0.1');

require SYS.'core/Common.php';
/*
* Now we were launched the fucking app :)
*/
$init = class_loader('Router', 'core');
$init->run();
