<?php

include ("../includes/sanitisation.php");

$error_array = array();

function listOrders(){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con;

	$rows = array();

	$stmt = $mysqli->prepare ("SELECT * FROM `order`");

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

?>