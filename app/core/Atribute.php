<?php

/**
 * 
 */
class Atribute 
{
	public $name;
	public $alias;
	public $type;
	public $len;
	function __construct($name, $type,$len){
		$this->name = $name;
		$this->type = $type;
		$this->len = $len;
	}

	public function set_alias($alias){
		$this->alias = $alias;
	}
}