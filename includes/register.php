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
			if (createUser() == 1){
				if (validateUser($email, $password) == 1){
					$_SESSION["loggedIn"] = true;
					echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
				} else {
					echo "problem registering";
				}
			} else {
				echo "There was a problem registering";
			}
		}
	} else {
		echo "passwords do not match";
	}
}
?>