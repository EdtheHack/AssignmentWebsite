<?php

function connect() { // code reuse for cdatabase connection
	include ($_SERVER ['DOCUMENT_ROOT'] . '/dbconn.php');
	$db_con;
	return $db_con;
}

function checkAdmin() {
	$mysqli = DBconnect ();
	
	if ($stmt = $mysqli->prepare ( "SELECT admin FROM user WHERE user_id=?" )) {
		$user = $_SESSION ["userID"];
		$stmt->bind_param ( "s", $user );
		$stmt->execute ();
		$stmt->bind_result ( $result );
		$stmt->fetch ();
		$stmt->close ();
	}
	return $result;
	$mysqli->close ();
}


function getNewestItem($itemNumber){
	$mysqli = connect ();

	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product ORDER BY price DESC" )) {
		$stmt->execute ();
		$stmt->bind_result ( $result );
		$stmt->fetch ();
		while($row = mysqli_fetch_array($result)) {
			$rows[] = $row;
		}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return $rows[$itemNumber];
}

function getItem($productId){
	$mysqli = connect ();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE product_id=?")){
		$stmt->bind_param ( "s", $productId );
		$stmt->execute ();
		$stmt->bind_result ( $result );
		
		$row = mysqli_fetch_row($result); //get the row 
		
		$stmt->fetch ();
		$stmt->close ();
	}
	
	$mysqli->close ();
	return $row;

}




?>