<?php

include ("../includes/sanitisation.php");

$error_array = array();

function listOrders(){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con;

	$rows = array();

	$stmt = $mysqli->prepare ("SELECT * FROM `order` ORDER BY order_id ASC");

	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}

	$stmt->bind_result($col0,  $col1, $col2, $col3);

	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
		
	while($stmt->fetch()){
		$rows[] = array( $col0, $col1, $col2, $col3);
			
	}
		
	$stmt->close ();
	$mysqli->close ();
		
	return $rows;
}

?>