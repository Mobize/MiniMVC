<?php
require_once __DIR__.'/../vendor/autoload.php';

function autoLoader($class_name) {
	if (strpos($class_name, 'Smarty') !== false) {
		return false;
	}
	$class_folders = array('core', 'model', 'controller');
    foreach($class_folders as $class_folder) {
		$class_path = __DIR__.'/../class/'.$class_folder.'/'.$class_name.'.php';
		if (file_exists($class_path)) {
			include $class_path;
			return true;
		}
    }
	throw new Exception('[AutoloadError] Class '.$class_name.' in '.$class_path.' not found');
}
spl_autoload_register('autoLoader');