<?php

function sanitiseString ($string, $min, $max){

	if (preg_match( '/^[A-Z 0-9\'\,.-]{'.$min.','.$max.'}$/i', $string)) {
		return 1;
	} else {	
		return 0;
	}
}


function sanitiseCurrency ($input){

	if (preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $input)) {    //format should be 1100.12
		
		echo $input;
		return 1;
	} else {
		return 0;
	}
}

function sanitiseSelection ($s){ //this is really needed but it's just to make sure 
	
	if($s==0 || $s==5 || $s==10 || $s==15|| $s==20|| $s==25|| $s==40|| $s==50|| $s==75){
		return 1;
	}else{
		return 0;
	}
		
}

function sanitiseListProduct($listProduct){
	if($listProduct == 0 || $listProduct == 1 || $listProduct == 2){
		return 1;
	}else{
		return 0;
	}
}







?>