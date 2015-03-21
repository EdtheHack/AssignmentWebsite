<?php

include ("../includes/sanitisation.php");

if(isset($_POST['newCategory'])){
	
	$error_array = array();
	
	$name = $_POST['newCategoryName'];

	if($name != null){
		if(sanitiseString(1, $name, 1, 40) != 1){  //not cleared
			$error_array[] = "Name field has illegial chars or is too short/long";
		}else{
			checkCateName($name);//){
				
			//}else{
				//$error_array[] = "Category Name already exits.";
		//	}
		}
	}else{
		$error_array[] = "Category name field cannot be empty";
	}
	
	if(!(empty($error_array))){  //check for an none emprty error array (meaning the array has errors and something bad has happened)
		$error = implode("<br>", $error_array);
		echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in nice BS
		die; //wrong input, do not proceed
	}

}

function checkCateName($name){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con;
	
	$stmt = $mysqli->prepare ( "SELECT name FROM categories WHERE name=?" );
	
		
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("s", $name);
	$stmt->bind_result ($returned_name);
		
	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}

	$stmt->close ();

	$mysqli->close ();
	echo $returned_name;
	
	if($returned_name == $name){
		echo "already in the db";
	}else{
		addCategory($name);
	}
}

function addCategory($name){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con;
	
	$stmt = $mysqli->prepare ( "INSERT INTO categories (name) VALUES (?)" );
	
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("s", $name);
	
	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->close ();
	
	$mysqli->close ();

}

?>