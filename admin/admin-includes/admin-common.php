<?php

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );


if(isset($_GET['del'])){ //if there is a deletion id
	$product_id = $_GET[ 'del' ]; //get the deletion id

	$orders = checkOrders($product_id); //force check for existing orders

	if (empty($orders)){
		deleteProductDB($product_id); //if there are no associated orders to that product then delete 
		echo "<script type=\"text/javascript\">document.location.href=\"../view-products.php\";</script>";

	}else{
		echo "<script type=\"text/javascript\">document.location.href=\"../view-products.php\";</script>";
	}
}


if(isset($_GET['delUser'])){ //if there is a deletion id
	$user_id = $_GET[ 'delUser' ]; //get the deletion id

	removeOrders($user_id); 
	removeUser($user_id);
}


function deleteProductDB($product_id){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con; //just for names sake

	$stmt = $mysqli->prepare ("DELETE FROM `product_categories` WHERE product_id=?");  //delete the categories associated with the product first 

	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}

	$stmt->bind_param ("i", $product_id);

	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
	}

	$stmt->close ();

	$stmt = $mysqli->prepare ("DELETE FROM `product` WHERE product_id=?"); //then delete the product 

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

function removeUser($user_id){

	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con;
	
	$stmt = $mysqli->prepare ("DELETE FROM user WHERE user_id=?" );
	
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("i", $user_id);
	
	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
			
	$stmt->close ();
	
	$mysqli->close();
}

function removeOrders($user_id){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con;
	
	$stmt = $mysqli->prepare ("SELECT `order_id` FROM `order` WHERE user_id=?" );
	
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
		
	$stmt->bind_param ("i", $user_id);
	$stmt->bind_result ($order_id);
	
	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	while($stmt->fetch()){
		removeEachOrder($order_id);
	}
		
	$stmt->close ();
	
	// ------

	$stmt = $mysqli->prepare ("DELETE FROM `order` WERE `user_id`=?" );

	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
		
	$stmt->bind_param ("i", $user_id);

	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
			
	$stmt->close ();
	
	$mysqli->close ();

}

function removeEachOrder($order_id){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con;
	
	$stmt = $mysqli->prepare ("DELETE FROM `order_contents` WHERE order_id=?"); //then delete the product
	
	if ($stmt === false) {
		trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("i", $order_id);
	
	if(!($stmt->execute ())){
		die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->close ();
	
	$mysqli->close ();
	
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

function listNames($letter){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con;
	
	$rows = array();
	
	$stmt = $mysqli->prepare ("SELECT user_id, email, firstName, lastName, addressLine1, addressLine2, postcode, mobileNo, homeNo, 
			blocked, admin FROM user WHERE firstName LIKE ?" );
	
		if ($stmt === false) {
			trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
		}
		
		$letter = $letter."%";
			
		$stmt->bind_param ("s",$letter );
		$stmt->bind_result( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8,  $col9,  $col10);
	
		if(!($stmt->execute ())){
			die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
			
		while($stmt->fetch()){
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8,  $col9,  $col10);
			
		}
			
		$stmt->close ();
		$mysqli->close ();
			
		return $rows;
	
}

function getUser($id){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');

	$mysqli = $db_con;

	$stmt = $mysqli->prepare ("SELECT user_id, email, firstName, lastName, addressLine1, addressLine2, postcode, mobileNo, homeNo,
			blocked, admin FROM user WHERE user_id=?" );

	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}

		
	$stmt->bind_param ("i", $id );
	$stmt->bind_result( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8,  $col9,  $col10);

	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	while($stmt->fetch()){
	$rows[] = array ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8,  $col9,  $col10);
	}	
	$stmt->close ();
	$mysqli->close ();
		
	return $rows;

}

function deletionEmail($user_id){
	
	
	require '../PHPMailer/PHPMailerAutoload.php';
	
	$rows = getUser($user_id);

	
	$mail = new PHPMailer;
	$mail->IsSMTP();
	$mail->Host = "localhost";
	
	$mail->setFrom('AdmindoNotReply@password.com', 'Accounts Administrator');
	$mail->addAddress($rows[0][1], '');
	$mail->Subject = "Your Account Details Have been Changed";
	$mail->isHTML(true);
	$mail->Body = ('Hi '.$rows[0][2].',<br>Your account with us has been removed by an admin, if you wish to continue to use our service again please register');
	
	if(!$mail->Send()) {
		echo " Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "<div class=\"alert alert-success\">
				<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
				<strong>Success!</strong> Your Password has now been reset, check your emails!
				</div>";
	}
	
	
}

?>