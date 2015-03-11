<?php

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

function connect() { // code reuse for cdatabase connection
	include ($_SERVER ['DOCUMENT_ROOT'] . '/dbconn.php');
	$db_con;
	return $db_con;
}

function checkAdmin() {
	$mysqli = connect ();
	
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
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6 );
	   	while($stmt->fetch()){
     		$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6 );
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
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6 );
		
		while($stmt->fetch()){
			$row = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6  );
		}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return $row;
}

function getSearchItems($searchItem){
	$mysqli = connect ();
	
		$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6);
	   	while($stmt->fetch()) {
			if (strpos($col1, '$searchItem') !== false) {
				$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6);
			}
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return $rows;
}

?>