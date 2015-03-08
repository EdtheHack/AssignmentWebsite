<?php

include 'includes/databaseValidation.php';
require 'PHPMailer/PHPMailerAutoload.php';

if(isset($_POST['sendMail'])){
	$email = $_POST['email'];
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
				echo " Message sent!";
			}
		} else {
			echo "Email does not exist";
		}
	} else {
		echo "Email can not be null";
	}
}

?>