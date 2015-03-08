<?php
if (isset ( $_POST ['saveDetails'] )) {
	$password = $_POST ['password'];
	$passwordCheck = $_POST ['passwordCheck'];
	if ($password != null || $passwordCheck != null) {
		if ($password == $passwordCheck) {
			if (validatePassword ( $password ) == 1) {
				$email = $_SESSION ['email'];
				forgottenPassword ( $email, $password );
				echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
			}
		} else {
			echo "passwords do not match!";
		}
	} else {
		echo "Password can not be null";
	}
}

if (isset ( $_POST ['back'] )) {
	echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
}
?>