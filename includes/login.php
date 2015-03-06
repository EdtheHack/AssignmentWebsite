<?php

include ("databaseValidation.php");


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
			}
			$_SESSION["loggedIn"] = true;
			if ($_SESSION['suggestReset'] == true){
				echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/suggestResetPassword.php\")</script>";
			} else {
				echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/userDetails.php\")</script>";
			}
		}
	}
}


?>