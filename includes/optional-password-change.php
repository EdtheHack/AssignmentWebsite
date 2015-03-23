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
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					  		<strong>Error!</strong> Sorry. Passwords do not match.
						</div>";
		}
	} else {
		echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					  		<strong>Error!</strong> Sorry. Password cannot be empty.
						</div>";
	}
}

if (isset ( $_POST ['back'] )) {
	echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
}
?>