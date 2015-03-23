<?php
	include 'includes/databaseValidation.php';	
	if (($_SESSION["loggedIn"] == true) && ($_SESSION["suggestReset"] == true)){
	} else {
		echo "<script>window.location.replace(index.php)</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Please Change Your Password - Web Programming Assignment 2</title>
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
<br>	
	<h3>For security reasons, please change your password.</h3>
	<br>
		<form method="POST" action="">
			<div class="form-group">
				<label for="password">New Password</label>
				<input type="password" name="password" class="form-control" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
			</div>
			<br>
			<div class="form-group">
				<label for="password">Confirm Password</label>
				<input type="password" name="passwordCheck" class="form-control" <?php if(!empty($_POST["passwordCheck"])){ echo " value='".$_POST["passwordCheck"]."'"; }?>>
			</div>
			<br>
			<p style="text-align: center"> <input type="submit" name="back" class="btn btn-default" value="No Thanks"> <input type="submit" name="saveDetails" class="btn btn-default" value="Save"></p>
		</form>	
			<?php 
			include ("includes/optional-password-change.php");?>
		</div>

	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
