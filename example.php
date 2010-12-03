<?php

require_once 'Trampoline.php';

use \Trampoline\Trampoline; 


function even($n) { 
	return $n == 0 ? true : Trampoline::Bounce(function() use($n) { return odd($n - 1);});
}

function odd($n) { 
	return $n == 0 ? false : Trampoline::Bounce(function() use($n) { return even($n - 1);});
}


echo Trampoline::even(1500) ? 'Yep' : 'Nope';
echo "\n";

function fact($n) {
	$product = function($min, $max) use($n, &$product) { 
		return $min == $n ? 
			$max : 
			Trampoline::Bounce(function() use(&$product, $min, $max) {
				return $product(bcadd($min, 1), bcmul($min, $max));
			});
	};

	return $product(1, $n);
}


echo Trampoline::fact(150); 
echo "\n"; 
