<?php

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
				echo "<script type=\"text/javascript\">document.location.href=\"userDetails.php\";</script>";
			}
		}
	}
}
?>