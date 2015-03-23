<?php
if(isset($_POST['attemptLogin'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	if ($password == null || $email == null){
		echo "Login details cannot be empty";
	} else {
		if (validateUser($email, $password) == 1){
			if(isset($_POST['stayLoggedIn'])){
				$_SESSION["stayLoggedIn"] = true;
			}else{
				$_SESSION["stayLoggedIn"] = false;
			}
			
			if (getCurrentUserOrderId($_SESSION["userID"]) == false){
				addNewUserOrder($_SESSION["userID"]);
			}
			
			$user = new user($_SESSION["userID"], $_SESSION["firstName"], $_SESSION['email'], getCurrentUserOrderId($_SESSION["userID"]), $_SESSION["admin"]);
			$_SESSION['user'] = serialize($user);
			$_SESSION["loggedIn"] = true;
			
			if (isset($_SESSION['suggestReset']) && $_SESSION['suggestReset'] == true){
				echo "<script type=\"text/javascript\">document.location.href=\"suggest-reset-password.php\";</script>";
			} else {
				echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
			}
		}
	}
}
?>