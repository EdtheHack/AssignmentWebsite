<?php
	$product_id = $_SERVER[ 'QUERY_STRING' ];


	$orders = checkOrders($product_id); //force check

	if (empty($orders)){
		deleteProductDB($product_id);
		echo "<script type=\"text/javascript\">document.location.href=\"view-products.php\";</script>";

	}else{
		echo "<script type=\"text/javascript\">document.location.href=\"view-products.php\";</script>";
	}



function deleteProductDB($product_id){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con; //just for names sake

	$stmt = $mysqli->prepare ("DELETE FROM `product_categories` WHERE product_id=?");

	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}

	$stmt->bind_param ("i", $product_id);

	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
	}

	$stmt->close ();

	$stmt = $mysqli->prepare ("DELETE FROM `product` WHERE product_id=?");

	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}

	$stmt->bind_param ("i", $product_id);

	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
	}

	$stmt->close ();


	$mysqli->close();

}


function checkOrders($product_id){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con;

	$orders = array();

	if ($stmt = $mysqli->prepare ("SELECT product_id FROM order_contents WHERE product_id=?" )) {

		if ($stmt === false) {
			trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
		}
			
		$stmt->bind_param ("i", $product_id);
		$stmt->bind_result($order_id);

		if(!($stmt->execute ())){
			die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
			
		while($stmt->fetch()){
			array_push($orders, $order_id);
		}
			
		$stmt->close ();
		$mysqli->close ();
			
		return $orders;
	}
}


?>