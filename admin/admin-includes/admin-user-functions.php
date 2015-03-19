<?php

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

include ("../includes/sanitisation.php");

$error_array = array();

if (isset($_POST['editUser'])){
	
	echo "edit";

	$email = $_POST['email'];
	$fn = $_POST['firstName'];
	$ln = $_POST['lastName'];
	$addr1 = $_POST['addressLine1'];
	$addr2 = $_POST['addressLine2'];
	$postcode = $_POST['postcode'];
	$homeNo = $_POST['mobileNumber'];
	$mobileNo = $_POST['homeNumber'];
	$admin = $_POST['isAdmin'];
	
	if($email != null){
		if(sanitiseString(3, $email, 0, 0) != 1){  //not cleared
			$error_array[] = "The Email field has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Email cannot be empty";
	}
	
	
	if($fn != null){
		if(sanitiseString(1, $fn, 1, 50) != 1){  //not cleared
			$error_array[] = "First Name field has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "First Name field cannot be empty";
	}
	
	if($ln != null){
		if(sanitiseString(1, $ln, 1, 50) != 1){  //not cleared
			$error_array[] = "Last Name field has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Last Name field cannot be empty";
	}
	
	if($addr1 != null){
		if(sanitiseString(2, $addr1, 1, 100) != 1){  //not cleared
			$error_array[] = "Address Line 1 has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Last Name field cannot be empty";
	}
	
	if($addr2 != null){
		if(sanitiseString(2, $addr2, 1, 100) != 1){  //not cleared
			$error_array[] = "Address Line 1 has illegial chars or is too short/long";
		}
	}else{
		$addr2 = ""; //address 2 can be null
	}
	
	if($postcode != null){
		if(sanitiseString(5, $postcode, 0, 0) != 1){  //not cleared
			$error_array[] = "Postcode has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Last Name field cannot be empty";
	}
	
	if($homeNo != null){
		if(sanitisePhone($homeNo) != 1){  //not cleared
			$error_array[] = "Home Number has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Home Number field cannot be empty";
	}
	
	if($mobileNo != null){
		if(sanitisePhone($mobileNo) != 1){  //not cleared
			$error_array[] = "Mobile Number has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Mobile Number field cannot be empty";
	}
	
	if($admin == 0 || $admin == 1){
		
	}else{
		$error_array[] = "You cnanot input that into the admin field";
	}
	
	echo "chekcing for errors";
	
	if(!(empty($error_array))){  //check for an none emprty error array (meaning the array has errors and something bad has happened)
		$error = implode("<br>", $error_array);
		echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in nice BS
		die; //wrong input, do not proceed
	}else{
		echo "all good here";
	}
	
	echo "done";
}