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

function getSimilarItems($itemId){  //NEEDS WORK
	$mysqli = connect ();
	
		$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6);
	   	while($stmt->fetch()) {
			if (strpos(strtolower($col1), strtolower($searchItem)) !== false) {
				$rowsTitle[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6);
			} else if (strpos(strtolower($col3), strtolower($searchItem)) !== false) {
				$rowsDescription[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6);
			}
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	
	$rows = array_merge($rowsTitle, $rowsDescription);
	return $rows;
}

function getSearchItems($searchItem){  //NEEDS WORK
	$mysqli = connect ();
	
		$rowsTitle = array();
		$rowsDescription = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6);
	   	while($stmt->fetch()) {
			if (strpos(strtolower($col1), strtolower($searchItem)) !== false) {
				$rowsTitle[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6);
			} else if (strpos(strtolower($col3), strtolower($searchItem)) !== false) {
				$rowsDescription[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6);
			}
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	
	$rows = array_merge($rowsTitle, $rowsDescription);
	return $rows;
}

function getMostDiscounted(){
	$mysqli = connect ();
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product ORDER BY percentage_off DESC WHERE status=1")){ //get the most discounted
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2, $col3, $col4,  $col5, $col6 );
		while($stmt->fetch()) {
			$rows[] = array( $col0,  $col1,  $col2, $col3 , $col4,  $col5, $col6 );
		}
		$stmt->close ();
	}
		
	return $rows;
}

/*

function getAllProducts(){
	
	$mysqli = connect ();

	$products = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6 );
	   	while($stmt->fetch()){
     		$products[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6 );
    	}
		$stmt->close ();
	}
	$mysqli->close ();
	
	return $products[];
}

/*
 * GET HIGHEST DICOUNTED SQL IN ORDER
 * 1 SELECT * FROM product WHERE price - reduced_price = (select MAX(price - reduced_price) from product)
 * 2 SELECT * FROM product WHERE price - reduced_price = (select MAX(price - reduced_price) from product WHERE price - reduced_price < (select MAX(price - reduced_price) from product))
 * 3 SELECT * FROM product WHERE price - reduced_price = (select MAX(price - reduced_price) from product WHERE price - reduced_price < (select MAX(price - reduced_price) from product WHERE price - reduced_price < (select MAX(price - reduced_price) from product)))
 * 
 */


?>