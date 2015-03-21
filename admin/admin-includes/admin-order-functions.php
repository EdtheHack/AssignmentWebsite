<?php

include ("../includes/sanitisation.php");

$error_array = array();

function deleteOrder($order_id){
	
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con; //just for names sake
	
	$stmt = $mysqli->prepare ("DELETE FROM `order_contents` WHERE order_id=?");  //delete the order contents associated with the order first
	
	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("i", $order_id);
	
	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->close ();
	
	$stmt = $mysqli->prepare ("DELETE FROM `order` WHERE order_id=?"); //then delete the order
	
	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("i", $order_id);
	
	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->close ();
	$mysqli->close();
}

function listOrders(){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con;

	$rows = array();

	$stmt = $mysqli->prepare ("SELECT * FROM `order` ORDER BY order_id DESC");

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