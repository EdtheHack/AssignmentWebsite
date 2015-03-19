<?php

function sanitiseString ($func_select, $string, $min, $max){

	if($func_select == 1){
		if(sanitiseBasicString ($string, $min, $max) == 1){
			return 1;
		}else{
			return 0;
		}
	}else if ($func_select == 2){
		if(sanitiseStringPunctuation ($string, $min, $max) == 1){
			return 1;
		}else{
			return 0;
		}
	}else if ($func_select == 3){
		if(sanitiseEmailString ($string, $min, $max)== 1){
			return 1;
		}else{
			return 0;
		}
	}else if ($func_select == 4){
		if(sanitiseLettersNumbers ($string, $min, $max) == 1){
			return 1;
		}else{
			return 0;
		}
	}else if ($func_select == 5){
		if(sanitisePostcode ($string) == 1){
			return 1;
		}else{
			return 0;
		}
	}
}

function sanitiseBasicString ($string, $min, $max){ //only allows for A - Z

	echo $string = trim ($string);

	if (preg_match('/^[A-Z \'.-]{'.$min.','.$max.'}$/i', $string)) {
		return 1;
	} else {
		return 0;
	}
}

function sanitiseStringPunctuation ($string, $min, $max){ //allows for numbers and

	 $string = trim ($string);

	if (preg_match('/^[A-Z 0-9\'\,.?%-]{'.$min.','.$max.'}\s+', $string)) {
		return 1;
	} else {
		return 0;
	}
}

function sanitiseLettersNumbers ($string, $min, $max){

	 $string = trim ($string);

	if(preg_match('/^[a-zA-Z0-9]{'.$min.','.$max.'}+$/', $string)){
		return 1;
	}else{
		return 0;
	}
}

function sanitisePostcode($input){
	
	 $input = trim ($input);
	//http://webarchive.nationalarchives.gov.uk/+/http://www.cabinetoffice.gov.uk/media/254290/GDS%20Catalogue%20Vol%202.pdf page 11
	
	if (preg_match('/^[A-Z 0-9\'\,.-]{7,8}$/i', $input)) {
		return 1;
	}else{
		return 0;
	}
}


function sanitiseEmailString ($string, $min, $max){ //allows for numbers and

	$string = trim ($string);
	
	if (preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $string)) {
		return 1;
	} else {
		return 0;
	}
}

function sanitiseInteger($int){
	if (preg_match( '/^[0-9]+$/', $int)) {
		return 1;
	}else{
		return 0;
	}
}

function sanitiseCurrency ($input){

	if (preg_match('/^[0-9]+(?:\.[0-9]{0,2})?$/', $input)) {    //format should be 1100.12
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

function sanitisePhone($number){
	echo "phone";
	if (preg_match( '/^[0-9 \'.-]{11}$/i', $number)) {
		return 1;
	} else {
		return 0;
	}
}






?>