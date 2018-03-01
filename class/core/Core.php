<?php

abstract class Core {

	public function __construct($data = array()) {
		foreach($data as $key => $value) {
			$setter = $this->_setter($key); // setId, setName,...etc
			if (method_exists($this, $setter)) {
				$this->$setter($value);
			}
		}
	}

	public function __set($key, $value) {
		$setter = $this->_setter($key); // setId, setName,...etc
		if (method_exists($this, $setter)) {
			$this->$setter($value);
		}
	}

	public function __get($key) {
		$getter = $this->_getter($key); // getId, getName,...etc
		if (method_exists($this, $getter)) {
			return $this->$getter();
		}
	}

	public function __isset($key) {
		return property_exists($this, $key);
	}

	public static function getClass() {
		return get_called_class();
	}

	public function getProperties() {
		$class = new ReflectionClass($this);
		$vars = array();
		foreach($class->getProperties() as $key => $property) {
			$vars[] = $property->name;
		}
		return $vars;
	}

	public function __toString() {
 		return '<pre>'.var_export($this, true).'</pre>';
    }

    private function _getter($key) {
    	return Utils::getCamelCase('get'.ucfirst($key));
    }

    private function _setter($key) {
    	return Utils::getCamelCase('set'.ucfirst($key));
    }
}