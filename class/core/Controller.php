<?php

class Controller {

	public $target;
	public $action;
	public $param;

	public function __construct() {

		$this->target = 'default';
	    $this->action = 'index';
	    $this->param = null;

	    if (!empty($_GET['do'])) {

	        $do = $_GET['do'];

	        if (strpos($do, '/') === false) {
	            $this->target = $do;
	        } else {
	            $do = explode('/', $_GET['do']);

	            $this->target = !empty($do[0]) && $do[0] !== '.' ? $do[0] : $this->target;
	            $this->action = !empty($do[1]) ? $do[1] : $this->action;
	            $this->param = !empty($do[2]) ? $do[2] : $this->param;
	        }
	    }
	}

	public function handler() {

	    $class_name = ucfirst(Utils::getCamelCase($this->target)).'Controller';

	    if (class_exists($class_name)) {
	        $class = new $class_name();

	        if (!empty($this->action)) {
		        $method = Utils::getCamelCase($this->action).'Action';
		        if (method_exists($class, $method)) {
		            $class->{$method}($this->param);
		            return true;
		        }
	        }
	    }
	    return false;
	}
}