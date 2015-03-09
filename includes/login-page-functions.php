<?php

function register(){
if(isset($_POST['attemptRegister'])){
	$email = $_POST['emailRegister'];
	$password = $_POST['passwordRegister'];
	$passwordCheck = $_POST['passwordRegisterCheck'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$addressLine1 = $_POST['addressLine1'];
	$addressLine2 = $_POST['addressLine2'];
	$postcode = $_POST['postcode'];
	$mobileNumber = $_POST['mobileNumber'];
	$homeNumber = $_POST['homeNumber'];

	if ($password == $passwordCheck){
		if (validateDetails($email, $password, $firstName, $lastName, $addressLine1, $addressLine2, $postcode, $mobileNumber, $homeNumber) == 1){
			if (createUser() == 1){
				if (validateUser($email, $password) == 1){
					$_SESSION["loggedIn"] = true;
					echo "<div class=\"alert alert-success\">
					        		<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					        		<strong>Success!</strong> You have been registered, you can now sign in!
					    		</div>";
				} else {
					echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					  		<strong>Error!</strong> There was a problem registering !
						</div>";
				}
			} else {
				echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					  		<strong>Error!</strong> There was a problem registering !
						</div>";
			}
		}
	} else {
		echo "<div class=\"alert alert-danger\">
			  		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
			 		<strong>Error!</strong> Passwords do not maatch !
			</div>";
	}
}
}

require 'PHPMailer/PHPMailerAutoload.php';

if(isset($_POST['sendMail'])){
	$email = $_POST['resetEmail'];
	$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	$password = substr(str_shuffle($characters), 0, 8);  //generate new password
	if ($email != null){
		if (checkEmail($email) == 1){
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = "localhost";

			$mail->setFrom('doNotReply@password.com', 'i7212753 Password Reset');
			$mail->addAddress($email, '');
			$mail->Subject = "i7212753 - New Password";
			$mail->isHTML(true);
			$mail->Body = ('Your new password: '.$password.'.');

			if(!$mail->Send()) {
				echo " Mailer Error: " . $mail->ErrorInfo;
			} else {
				forgottenPassword($email, $password);
					echo "<div class=\"alert alert-success\">
				     		<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
				      		<strong>Success!</strong> Your Password has now been reset, check your emails!
				   		</div>";
			}
		} else {
			echo "Email does not exist";
		}
	} else {
		echo "Email can not be null";
	}
}



if(isset($_POST['attemptLogin'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$stayLoggedIn = $_POST['stayLoggedIn'];
	if ($password == null || $email == null){
		echo "Login details cannot be empty";
	} else {
		if (validateUser($email, $password) == 1){
			if(isset($_POST['stayLoggedIn'])){
				$_SESSION["stayLoggedIn"] = true;
			}else{
				$_SESSION["stayLoggedIn"] = false;
			}
			$_SESSION["loggedIn"] = true;
			if ($_SESSION['suggestReset'] == true){
				echo "<script type=\"text/javascript\">document.location.href=\"suggestResetPassword.php\";</script>";
			} else {
				echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
			}
		}
	}
}
?>