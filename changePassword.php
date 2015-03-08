<?php
	include 'includes/databaseValidation.php';	
	if ($_SESSION["loggedIn"] == true){
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home - Web Programming Assignment 2</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>
<body>
	<?php include ("includes/nav.php");?>
	
<div class="container">
	<?php include ("includes/just-added.php")?>
	
	<h3>Change your email address</h3>
	<br>
	<div class="col-md-9">
		<form method="POST" action="">
			<div class="form-group">
		     	<label for="email">Old Password :</label>
				<input type="password" name="oldPassword" class="form-control" placeholder="Enter old password" <?php if(!empty($_POST["oldPassword"])){ echo " value='".$_POST["oldPassword"]."'"; }?>>
			</div>			
			<br>
			<div class="form-group">
		     	<label for="email">New Password :</label>
				<input type="password" name="password" class="form-control" placeholder="Enter new password" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
			</div>
			<div class="form-group">
		     	<label for="email">New Password :</label>
				<input type="password" name="passwordCheck" class="form-control" placeholder="Confirm new password"  <?php if(!empty($_POST["passwordCheck"])){ echo " value='".$_POST["passwordCheck"]."'"; }?>>
			</div>
				
				<br>
				
				<p style="text-align: center"> <input type="submit" name="back" class="btn btn-default" value="Back"> <input type="submit" name="saveDetails" class="btn btn-default" value="Save"></p>
		</form>	
			<?php
				if (isset ($_POST['saveDetails'])) {
					$oldPassword = $_POST['oldPassword'];
					$password = $_POST['password'];
					$passwordCheck = $_POST['passwordCheck'];
					
					if ($password != null || $passwordCheck != null){
						if (updatePassword($oldPassword, $password, $passwordCheck) == 1) {
							echo "<script>window.location.replace(userDetails.php)</script>";
						} 	
					} else {
						echo "Passwords can not be null";
					}
				}
				
				if (isset ($_POST['back'])) {
						echo "<script>window.location.replace(editDetails.php)</script>";		
				}
			?>
		</div>
	</div>
	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
