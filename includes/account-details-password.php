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

?>