<?php

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
			if (createUser($password) == 1){
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
?>