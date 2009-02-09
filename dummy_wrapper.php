<?php
/**
 * Wrapper class for integrating the Faker vendor and the 'DummyData' CakePHP plugin 
 * 
 *
 * @author Ronny 'rvv' Vindenes
 * @author Alexander 'alkemann' Morland
 * @modified 9. feb. 2009
 * 
 */
include_once 'faker.php';
class DummyWrapper {
	
	private static $Faker = null;
	
	private static $generator_classes = array(
		'Address' => array(		
			'Uk',
			'Usa'
		),
		'Company' => array(),
		'English' => array(),
		'Lorem' => array(),
		'Name' => array(),
		'Number' => array(),
		'Time' => array(),
		'Web' => array()
	);
	
	public static function listTimeGenerators() {
		return array('Time' => self::listMethods('Time') );
	}
	public static function listNumberGenerators() {
		return array(
			'Number' => self::listMethods('Number')
		);
	}
	public static function listStringGenerators() {
		$ret = array(
			'Name' => self::listMethods('Name'),
			'English' => self::listMethods('English'),
			'Web' => self::listMethods('Web'),
			'Company' => self::listMethods('Company'),
			'Address' => self::listMethods('Address'),
			'Uk' => self::listMethods('Uk'),
			'Usa' => self::listMethods('Usa'),
			'Lorem' => self::listMethods('Lorem')
		);
		return $ret;
	}
	
	
	public static function listClasses($recursive = true) {
		$ret = array();
		if ($recursive) {
			$ret =& self::$generator_classes;
		} else {
			$ret = array_keys(self::$generator_classes);
		}		
		return $ret;
	}

	public static function listSubClasses($class) {
		return self::$generator_classes[$class];
	}
	
	public static function listMethods($class) {
		if (is_null(self::$Faker) ) {
			self::$Faker = new Faker; 
		}
		$methods = get_class_methods(self::$Faker->$class);
		/*	$ret = Set::extract('[/city/i]',$methods );	*/
		$ret = array();
		foreach ($methods as $one) {
			if (substr($one,0,2) != '__' && substr($one,0,8) != 'generate') {
				$ret[$class.'->'.$one] = $one;
			}
		}
		return $ret;
	}
	
	public static function generate($class, $method, $options = array()) {	
		if (is_null(self::$Faker) ) {
			self::$Faker = new Faker; 
		}
		return self::$Faker->$class->$method($options);
	}
}
?>