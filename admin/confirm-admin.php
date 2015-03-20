<?php
include '../includes/databaseValidation.php';
include ("../includes/common-functions.php");

 if (($_SESSION["loggedIn"] == true) && checkAdmin() == 1){
	if (($_SESSION["loggedIn"] == true) && ($_SESSION["adminChecked"] == true)){
		echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
	} else {
		$twostep = false; //initilise 
		$_SESSION["adminChecked"] = $twostep;
	}
 }else{
 	echo "<script type=\"text/javascript\">document.location.href=\"../index.php\";</script>";
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
	<?php include ("nav.php");?>
	
<div class="container">
<br>	
	<h3>For security before accessing the admin pages we need to check your pasword</h3>
	<br>
		<form method="POST" action="">
			<br>
			<div class="form-group">
				<label for="password">Confirm password</label>
				<input type="password" name="passwordCheck" class="form-control" <?php if(!empty($_POST["passwordCheck"])){ echo " value='".$_POST["passwordCheck"]."'"; }?>>
			</div>
			<br>
			<p style="text-align: center"> <input type="submit" name="back" class="btn btn-default" value="No Thanks"> <input type="submit" name="checkAdmin" class="btn btn-default" value="Save"></p>
		</form>	
		<?php 
				if(isset($_POST["checkAdmin"])){  //checks if user submit a password
						if (validateUser($user->getEmail(), $_POST["passwordCheck"]) == 1){
							
							$_SESSION["adminChecked"] = true;
							
							echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
							
						} else {
								echo "<div class=\"alert alert-danger\">
					        		<a href=\"index.php\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					        		<strong>Error!</strong> Pasword invalid!
					    		</div>";
						}						
					}?>
		</div>

	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
