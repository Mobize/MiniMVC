<?php

class Search {

	public $entity = null;
	public $input = array();
	public $filters = array();
	public $results = array();
	public $count = 0;

	public function __construct($entity, $input = array(), $filters = array(), $separator = 'OR') {

		if (empty($entity) || empty($input)) {
			//throw new Exception('Empty search input');
			return $this;
		}

		$this->entity = $entity;
		$this->input = self::_cleanInput($input);
		$this->filters = self::_cleanInput($filters);

		return $this->getResults($separator);
	}

	private static function _cleanInput($input) {
		if (empty($input)) {
			return $input;
		}
		if (!is_array($input)) {
			$input = array($input);
		}

		array_walk($input, 'self::_filterVar', array(FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
		return $input;
	}

	private static function _filterVar($value, $key, $args) {
		return filter_var($value, $args[0], array('flags' => $args[1]));
	}

	private function getResults($separator = 'OR') {

		$where = array();
		$bindings = array();
		foreach($this->filters as $key => $value) {
			$operator = strpos($value, '%') !== false ? 'LIKE' : '=';
			$where[] = $key.' '.$operator.' :'.$key;
			$bindings[$key] = $value;
		}

		if (!empty($where)) {
			$table = $this->entity;
			$class = ucfirst(Utils::getCamelCase($this->entity));

			$sql = 'SELECT * FROM '.$table.' WHERE 1 AND ('.implode(' '.$separator.' ', $where).')';
			$this->results = $class::getList($sql, $bindings);
			$this->count = count($this->results);
		}
		return $this;
	}



}