<?php
require_once '../config/config.conf.php';

try {

    $controller = new Controller();

    if ($controller->handler() === false) {
    	if (!empty($controller->target) && file_exists($controller->target.'.php')) {
            include_once $controller->target.'.php';
        }
    }

} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}