<?php

function sanitiseString ($string, $min, $max){

	if (preg_match( '/^[A-Z 0-9 \'!@#$%&*_]{'.$min.','.$max.'}$/i', $string)) {
		return 1;
	} else {	
		return 0;
	}
}


function sanitiseCurrency ($input){

	if (preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $input)) {    //format should be 1,100.12
		return 1;
	} else {
		return 0;
	}
}







?>