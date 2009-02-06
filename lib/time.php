<?php
class Time extends Faker {

	public function __construct()
	{
	}
	
	public function __get( $var )
	{
		return $this->$var();		
	}
	
	public static function date($options = array()) {
		$options = am(array('variable'=>null,'min'=>'','max'=>''),$options);
		switch ($options['variable']) {
			case 'now' :
				return date('Y-m-d');
			break;
			case 'future' :
				$min_timestamp = time() + (60*60*24);
				if ($options['max'] != '') {
					$max_timestamp = strtotime($options['max']);
				} else {
					$max_timestamp = time() + (60*60*24*7*52);
				}	
			break;
			case 'past' :
				$max_timestamp = time() - (60*60*24);
				if ($options['min'] != '') {
					$min_timestamp = strtotime($options['min']);
				} else {
					$min_timestamp = time() - (60*60*24*7*52);
				}	
			break;
			default:
				if ($options['max'] != '') {
					$max_timestamp = strtotime($options['max']);
				} else {
					$max_timestamp = time() + (60*60*24*7*52);
				}			
				if ($options['min'] != '') {
					$min_timestamp = strtotime($options['min']);
				} else {
					$min_timestamp = time() - (60*60*24*7*52);
				}					
		}
		$timestamp = rand($min_timestamp,$max_timestamp);
		return date('Y-m-d',$timestamp);
	}
	
	public static function time($options = array()) {	
		if (isset($options['max']) && $options['max'] != '') {
			$arr = explode(' ',$options['max']);
			if (sizeof($arr) > 1) {
				$max = '1970-01-01 '.$arr[1];
			} else {
				$max = $options['max'];
			}
			$max_timestamp = strtotime($max);
		} else {
			$max_timestamp = strtotime('23:59:59');
		}			
		if (isset($options['min']) && $options['min'] != '') {
			$arr = explode(' ',$options['min']);
			if (sizeof($arr) > 1) {
				$min = '1970-01-01 '.$arr[1];
			} else {
				$min = $options['min'];
			}
			$min_timestamp = strtotime($min);
		} else {
			$min_timestamp = strtotime('00:00:00');
		}	
		$timestamp = rand($min_timestamp, $max_timestamp);
		return date('H:i:s',$timestamp);
	}
	
	public static function datetime($options = array()) {
		return self::date($options) . ' ' . self::time($options);
	}
	
	public static function timestamp($options = array()) {
		return time();
	}

	public static function year($options = array()) {
		$now = date('Y');
		$min = (isset($options['min'])) ? $options['min'] : $now - 75;
		$max = (isset($options['max'])) ? $options['min'] : $now;
		return rand($min,$max);
	}
	public static function month($options = array()) {
		return rand(1,12);
	}
	public static function day($options = array()) {
		$max = (isset($options['max'])) ? $options['max'] : 28;
		return rand(1,$max);
	}
	
	
	
}

?>