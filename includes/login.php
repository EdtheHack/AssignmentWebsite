<?php

include ("includes/databaseValidation.php");

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);



if(isset($_POST['attemptLogin'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$stayLoggedIn = $_POST['stayLoggedIn'];
	if ($password == null || $email == null){
		echo "Login details cannot be empty";
	} else {
		if (validateUser($email, $password) == 1){
			
			echo"i'm doing something i'm meant to";
			
			if(isset($_POST['stayLoggedIn'])){
				$_SESSION["stayLoggedIn"] = true;
				
				echo"now i've done something else";
			}
			$_SESSION["loggedIn"] = true;
			if ($_SESSION['suggestReset'] == true){
				echo "this is not how you page redirect";
				
				//echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/suggestResetPassword.php\")</script>";
			} else {
				header("/index.php");
			}
		}
		
		echo "does not exist";
	}
}


?>