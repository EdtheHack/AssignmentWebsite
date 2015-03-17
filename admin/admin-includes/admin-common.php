<?php

function getPage($pageId){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		
	$mysqli = $db_con;
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE product_id=?" )) {
		$stmt->bind_param ( "i", $pageId );
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6, $col7, $col8 );
		$stmt->fetch();
     	$rows = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		$stmt->close ();
	}
		
	$mysqli->close ();
	return $rows;
	
}

?>