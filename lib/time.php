<?php
class Time extends Faker {

	public function __construct()
	{
	}
	
	public function __get( $var )
	{
		return $this->$var();		
	}
	
	public function date($options = array()) {
		 return '';
	}
	
	public function datetime($options = array()) {
		 return '';
	}
	
	public function time($options = array()) {
		 return '';
	}
	
	
}

?>