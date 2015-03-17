<?php

//require_once "includes/common-functions.php";
//require_once "includes/order.php";
//require_once "includes/user.php";

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

			
			$user = new user($_SESSION["userID"], $_SESSION["firstName"], getCurrentUserOrderId($_SESSION["userID"]), $_SESSION["admin"]);
			$_SESSION['user'] = serialize($user);
			$_SESSION["loggedIn"] = true;
						
			if (getCurrentUserOrderId($user->getId()) == false){
				addNewUserOrder($user->getId());
			}
			//$order = new order(getCurrentUserOrderId($user->getId()), getCurrentOrderProducts(getCurrentUserOrderId($user->getId())), 0);
			//$_SESSION['order'] = serialize($order);
			
			if ($_SESSION['suggestReset'] == true){
				echo "<script type=\"text/javascript\">document.location.href=\"suggestResetPassword.php\";</script>";
			} else {
				//echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
			}
		}
	}
}
?>