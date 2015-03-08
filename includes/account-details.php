<?php
if (isset ($_POST['changePassword'])) {
	$oldPassword = $_POST['oldPassword'];
	$password = $_POST['newPassword'];
	$passwordCheck = $_POST['newPasswordCheck'];
		
	if ($password != null || $passwordCheck != null){
		if (updatePassword($oldPassword, $password, $passwordCheck) == 1) {
			echo "<div class=\"alert alert-success\">
					        		<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					        		<strong>Success!</strong> Your password has been changed!
					    		</div>";
		}
	} else {
		echo "<div class=\"alert alert-danger\">
					        		<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					        		<strong>Error!</strong> You must enter your password!
					    		</div>";
	}
}


if (isset ($_POST['changeEmail'])) {
	$password = $_POST['password'];
	$oldEmail = $_POST['oldEmail'];
	$newEmail = $_POST['newEmail'];
		
	if ($password != null){
		if (updateEmail($password, $oldEmail, $newEmail) == 1) {
			echo "<div class=\"alert alert-success\">
					        		<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					        		<strong>Success!</strong> Your Email has been changed!
					    		</div>";
		}
	} else {
		echo "<div class=\"alert alert-danger\">
					        		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					        		<strong>Error!</strong> You must enter your password!
					    		</div>";
	}
}

if (isset ($_POST['saveDetails'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$addressLine1 = $_POST['addressLine1'];
	$addressLine2 = $_POST['addressLine2'];
	$postcode = $_POST['postcode'];
	$mobileNumber = $_POST['mobileNumber'];
	$homeNumber = $_POST['homeNumber'];
	if (updateUser($firstName, $lastName, $addressLine1, $addressLine2, $postcode, $mobileNumber, $homeNumber) == 1) {
		echo "<script>window.location.replace(userDetails.php)</script>";
	} else {
		echo "There was a problem updating information";
	}
}



if (isset ($_POST['back'])) {
	echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
}
?>