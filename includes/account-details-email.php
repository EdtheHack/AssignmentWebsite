<?php
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
?>