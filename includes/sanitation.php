<?php

function sanitiseString ($string, $field, $min, $max){
	
	echo "not reaching ";
	
	if (preg_match( '/^[A-Z 0-9 \'!@#$%&*_]{2,100}$/i', $string)) {
		//return $string;
		echo "SUCEEESSSSSSS";
	} else {
		echo "<div class=\"alert alert-danger\">
				<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
				<strong>Error!</strong> ".$field. " must not contain illegal characters and be longer than 2 characters.
			</div>"; //ad chars in the message 
		
		echo "nothing";
		return 0;
	}
	
	echo "testing";
}




?>