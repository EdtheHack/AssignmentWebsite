<?php
if (isset ($_POST['changeDetails'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$addressLine1 = $_POST['addressLine1'];
	$addressLine2 = $_POST['addressLine2'];
	$postcode = $_POST['postcode'];
	$mobileNumber = $_POST['mobileNumber'];
	$homeNumber = $_POST['homeNumber'];
	if (updateUser($firstName, $lastName, $addressLine1, $addressLine2, $postcode, $mobileNumber, $homeNumber) == 1) {
		echo "<div class=\"alert alert-success\">
		   		<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
		   		<strong>Success!</strong> Your details has been changed!
			</div>";
	} else {
		echo "<div class=\"alert alert-danger\">
					        		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					        		<strong>Error!</strong> Oh no, something bad has happened, contact admin asap!
					    		</div>";
	}
}




?>