<?php
	include 'includes/databaseValidation.php';	
	if (($_SESSION["loggedIn"] == true) && ($_SESSION["suggestReset"] == true)){
	} else {
		echo "<script>window.location.replace(index.php)</script>";
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<title> Set New Password </title>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
		
		<style>
			p#p1 {
				margin-top: 5px;
				margin-left: 5px;
			}
			
			div#d1 {
				background-color: #BBBBBB;
				margin-left: auto;
				margin-right: auto;
				width: 500px;
			}
			
			div#d2 {
				margin-top: 7px;
			}
		</style>
	</head>

	<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="nav navbar-text">
				<b> i7212753 Web Assignment </b>
			</div>
			<ul class="nav navbar-text">
				<li class="active">Set New Password</li>
			</ul>
		</div>
	</nav>
	
	<h1 class ="text-center"> Set New Password? </h1>
	
	<br>
	
	<div id="d1" class="panel panel-default">
		<div style="padding-top: 24px" class="panel-body">
			<form method="POST" action="">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-4 col-sm-4">
							<p id = "p1" class="text-left"><span class="label label-default">New Password</span></p>
						</div>
						<div class="col-xs-8 col-sm-8">
							<div class="center">
								<span class="input-group"></span>
								<input type="password" name="password" class="form-control" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
							</div>
						</div>
					</div>
					
					<br>
					
					<div class="row">
						<div class="col-xs-4 col-sm-4">
							<p id = "p1" class="text-left"><span class="label label-default">Retype New Password</span></p>
						</div>
						<div class="col-xs-8 col-sm-8">
							<div class="center">
								<span class="input-group"></span>
								<input type="password" name="passwordCheck" class="form-control" <?php if(!empty($_POST["passwordCheck"])){ echo " value='".$_POST["passwordCheck"]."'"; }?>>
							</div>
						</div>
					</div>
				</div>
				
				<br>
				
				<p style="text-align: center"> <input type="submit" name="back" class="btn btn-default" value="No Thanks"> <input type="submit" name="saveDetails" class="btn btn-default" value="Save"></p>
			</form>	
			<?php
				if (isset ($_POST['saveDetails'])) {
					$password = $_POST['password'];
					$passwordCheck = $_POST['passwordCheck'];
					if ($password != null || $passwordCheck != null){
						if ($password == $passwordCheck){
							if (validatePassword($password) == 1){
								$email = $_SESSION['email'];
								forgottenPassword($email, $password);
								echo "<script>window.location.replace(userDetails.php)</script>";	
							}
						} else {
							echo "passwords do not match!";
						}
					} else {
						echo "Password can not be null";
					}
				}
				
				if (isset ($_POST['back'])) {
						echo "<script>window.location.replace(userDetails.php)</script>";		
				}
			?>
		</div>
	</div>
	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
