<?php
	include 'includes/databaseValidation.php';	
	if ($_SESSION["loggedIn"] == true){
	} else {
		echo "<script>window.location.replace(index.php)</script>";
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
	
	<div class="col-md-9">
		<form method="POST" action="">
			<div class="form-group">
		     	<label for="email">Confirm Password:</label>
				<input type="password" name="password" class="form-control" placeholder="Password" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
			</div>		
			<br>	
			<div class="form-group">
		     	<label for="email">Old Email:</label>
				<input type="email" name="oldEmail" class="form-control" placeholder="Old Email" <?php if(!empty($_POST["oldEmail"])){ echo " value='".$_POST["oldEmail"]."'"; }?>>
			</div>
			<div class="form-group">
		     	<label for="email">New Email:</label>
				<input type="email" name="newEmail" class="form-control" placeholder="New Email" <?php if(!empty($_POST["newEmail"])){ echo " value='".$_POST["newEmail"]."'"; }?>>
			</div>
				<br>
				<input type="submit" name="back" class="btn btn-default" value="Back"> <input type="submit" name="saveDetails" class="btn btn-default" value="Save">
			</form>	
			<?php
				if (isset ($_POST['saveDetails'])) {
					$password = $_POST['password'];
					$oldEmail = $_POST['oldEmail'];
					$newEmail = $_POST['newEmail'];
					
					if ($password != null){
						if (updateEmail($password, $oldEmail, $newEmail) == 1) {
							echo "<script>window.location.replace(userDetails.php)</script>";
						} 	
					} else {
						echo "Password can not be null";
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
