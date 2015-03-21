<?php

include ("../includes/sanitisation.php");

$error_array = array();

if(isset($_POST['newCategory'])){
	
	
	$name = $_POST['newCategoryName'];

	if($name != null){
		if(sanitiseString(1, $name, 1, 40) != 1){  //not cleared
			$error_array[] = "Name field has illegial chars or is too short/long";
		}else{
			if(checkCateName($name) == 1){
				addCategory($name);
			}else{
				$error_array[] = "Category Name already exits.";
			}
		}
	}else{
		$error_array[] = "Category name field cannot be empty";
	}
	
	if(!(empty($error_array))){  //check for an none emprty error array (meaning the array has errors and something bad has happened)
		$error = implode("<br>", $error_array);
		echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in nice BS
		//die; //wrong input, do not proceed
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

	$stmt->fetch();
	
	$stmt->close ();

	$mysqli->close ();
	

	if($returned_name == $name){
		return 0;
	}else{
		return 1;
	}

}

function listCategories(){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con;

	$rows = array();

	$stmt = $mysqli->prepare ("SELECT category_id, name FROM categories");

	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}

	$stmt->bind_result( $col0,  $col1);

	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
		
	while($stmt->fetch()){
		$rows[] = array( $col0,  $col1);
			
	}
		
	$stmt->close ();
	$mysqli->close ();
		
	return $rows;

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