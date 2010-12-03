<?php

namespace Trampoline;

class Bounce {
	private $func; 
	public function __construct($func) {
		$this->func = $func;
	}

	function __invoke() {
		return call_user_func_array($this->func, array());
	}
}

class Trampoline { 
	public static function Bounce($func) { 
		return new Bounce($func);
	}
	
	public static function __callStatic($func, $args) {
		$return = call_user_func_array($func, $args);
		while($return instanceof Bounce) {
			$return = $return();
		}

		return $return;
	}
}
