<?php

include ("../includes/sanitisation.php");

$error_array = array();

if(isset($_POST['newCategory'])){
	
	
	$name = $_POST['newCategoryName'];

	if($name != null){
		if(sanitiseString(1, $name, 1, 40) != 1){  //not cleared
			$error_array[] = "Name field has illegal characters or is an incorrect length.";
		}else{
			if(checkCateName($name) == 1){
				addCategory($name);
			}else{
				$error_array[] = "Category name already exits. Please select another.";
			}
		}
	}else{
		$error_array[] = "Category name cannot be empty.";
	}
	
	if(!(empty($error_array))){  //check for an none empty error array (meaning the array has errors and something bad has happened)
		$error = implode("<br>", $error_array);
		echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in BS
		//die; //wrong input, do not proceed
	}

}

if(isset($_GET['delCat'])){ //if there is a deletion id
	$category_id = $_GET[ 'delCat' ]; //get the deletion id

	deleteCategories($category_id);
}

function deleteCategories($category_id){
	
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con; //just for names sake
	
	$stmt = $mysqli->prepare ("DELETE FROM `product_categories` WHERE category_id=?");  //delete the categories associated with the product first
	
	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("i", $category_id);
	
	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occurred : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->close ();
	
	$stmt = $mysqli->prepare ("DELETE FROM `categories` WHERE category_id=?"); //then delete the category
	
	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("i", $category_id);
	
	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occurred : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->close ();
	
	
	$mysqli->close();
	
	echo "<script type=\"text/javascript\">document.location.href=\"../edit-categories.php\";</script>";
	
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

	$stmt = $mysqli->prepare ("SELECT category_id, name FROM categories ORDER BY category_id ASC");

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