<?php

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

include ("../includes/sanitisation.php");

$error_array = array();

if (isset($_POST['editUser'])){
	
	echo "edit";

	$email = $_POST['email'];
	$fn = $_POST['firstName'];
	$ln = $_POST['lastName'];
	$addr1 = $_POST['addressLine1'];
	$addr2 = $_POST['addressLine2'];
	$postcode = $_POST['postcode'];
	$homeNo = $_POST['mobileNumber'];
	$mobileNo = $_POST['homeNumber'];
	$admin = $_POST['isAdmin'];
	
	if($email != null){
		if(sanitiseString(3, $email, 0, 0) != 1){  //not cleared
			
			$error_array[] = "The Email field has illegial chars or is too short/long";
		}else{
			if(checkNewEmail($email) !=1 ){
				$error_array[] = "The Email is already in use";
			}
		}
	}else{
		$error_array[] = "Email cannot be empty";
	}
	
	
	if($fn != null){
		if(sanitiseString(1, $fn, 1, 50) != 1){  //not cleared
			$error_array[] = "First Name field has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "First Name field cannot be empty";
	}
	
	if($ln != null){
		if(sanitiseString(1, $ln, 1, 50) != 1){  //not cleared
			$error_array[] = "Last Name field has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Last Name field cannot be empty";
	}
	
	if($addr1 != null){
		if(sanitiseString(2, $addr1, 1, 100) != 1){  //not cleared
			$error_array[] = "Address Line 1 has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Last Name field cannot be empty";
	}
	
	if($addr2 != null){
		if(sanitiseString(2, $addr2, 1, 100) != 1){  //not cleared
			$error_array[] = "Address Line 1 has illegial chars or is too short/long";
		}
	}else{
		$addr2 = ""; //address 2 can be null
	}
	
	if($postcode != null){
		if(sanitiseString(5, $postcode, 0, 0) != 1){  //not cleared
			$error_array[] = "Postcode has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Last Name field cannot be empty";
	}
	
	if($homeNo != null){
		if(sanitisePhone($homeNo) != 1){  //not cleared
			$error_array[] = "Home Number has illegial chars or is too short/long";
		}	
	}else{
		$error_array[] = "Home Number field cannot be empty";
	}
	
	if($mobileNo != null){
		if(sanitisePhone($mobileNo) != 1){  //not cleared
			$error_array[] = "Mobile Number has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Mobile Number field cannot be empty";
	}
	
	if($admin == 0 || $admin == 1){
	}else{
		$error_array[] = "You cnanot input that into the admin field";
	}

	if(!(empty($error_array))){  //check for an none emprty error array (meaning the array has errors and something bad has happened)
		echo $error = implode("<br>", $error_array);
		echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in nice BS
		die; //wrong input, do not proceed
	}else{
		adminUpdateUser($email,	$fn, $ln, $addr1, $addr2, $postcode, $homeNo, $mobileNo, $admin, $user_id);
	}	
}


function checkNewEmail($email){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con;
	
	$stmt = $mysqli->prepare ( "SELECT email FROM user WHERE email=?" );
	
	
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("s", $email);
	$stmt->bind_result ($returned_email);
	
	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->fetch();
	
	$stmt->close ();
	
	$mysqli->close ();
	
	
	if($returned_email == $email){
		return 0;
	}else{
		return 1;
	}
	
}

function adminUpdateUser($email,	$fn, $ln, $addr1, $addr2, $postcode, $homeNo, $mobileNo, $admin, $user_id){
	include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
	$mysqli = $db_con;
	
	$stmt = $mysqli->prepare ( "UPDATE user SET email=?, firstName=?, lastName=?, addressLine1=?, addressLine2=?, 
			postcode=?, mobileNo=?, homeNo=?, admin=? WHERE user_id=?" );
		
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("ssssssssii", $email, $fn, $ln, $addr1, $addr2, $postcode, $homeNo, $mobileNo, $admin, $user_id);
		
	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
	
	$stmt->close ();
	$mysqli->close ();
	
	sendEmail($email,	$fn, $ln, $addr1, $addr2, $postcode, $homeNo, $mobileNo, $admin);
	
}


function sendEmail($email,	$fn, $ln, $addr1, $addr2, $postcode, $homeNo, $mobileNo, $admin){
	require '../PHPMailer/PHPMailerAutoload.php';
	
		if ($admin == 1){
			$admin = "Your account is an admin account";
		}else{
			$admin = "";
		}
	
		$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
		$password = substr(str_shuffle($characters), 0, 8);  //generate new password
		
		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->Host = "localhost";
	
		$mail->setFrom('AdmindoNotReply@password.com', 'Accounts Administrator');
		$mail->addAddress($email, '');
		$mail->Subject = "Your Account Details Have been Changed";
		$mail->isHTML(true);
		$mail->Body = ('Hi '.$fn.',<br>Your account details have been changed after a Site Adinistrator changed them for you. Please see
				below the amended account details<br>First Name: '.
				$fn.'<br>Last Name: '.
				$ln.'<br>Address Line 1: '.
				$addr1.'<br>Address Line 2: '.
				$addr2.'<br>Postcode: '.
				$postcode.'<br> Home Number: '.
				$homeNo.'<br>Mobile Number: '.
				$mobileNo.'<br><br>'.$admin);
	
		if(!$mail->Send()) {
			echo " Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "<div class=\"alert alert-success\">
				<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
				<strong>Success!</strong> Your Password has now been reset, check your emails!
				</div>";
		}
}



if(isset($_POST['forceReset'])){
	$email = $row[0][1];
	passwordResetbyAdmin($email);
}

function passwordResetbyAdmin($email){
	require '../PHPMailer/PHPMailerAutoload.php';
	include ("../includes/databaseValidation.php");
	
	$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	$password = substr(str_shuffle($characters), 0, 8);  //generate new password
	if ($email != null){
		if (checkEmail($email) == 1){
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = "localhost";
	
			$mail->setFrom('doNotReply@password.com', 'Admin Password Reset');
			$mail->addAddress($email, '');
			$mail->Subject = "Admin Has Reset Your Password";
			$mail->isHTML(true);
			$mail->Body = ('An admin has reset your password, your new password is: '.$password.'.');
	
			if(!$mail->Send()) {
				echo " Mailer Error: " . $mail->ErrorInfo;
			} else {
				forgottenPassword($email, $password);
			}
		} else {
			echo "Email does not exist";
		}
	} else {
		echo "Email can not be null";
	}
}
	

