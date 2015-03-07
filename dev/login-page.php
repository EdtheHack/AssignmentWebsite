<?php
	include 'includes/databaseValidation.php';	
	
	if(isset($_SESSION['loggedIn']) && $_SESSION["stayLoggedIn"] == true){
			echo "<script type=\"text/javascript\">document.location.href=\"userDetails.php\";</script>";
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
		<div class="well">
						
		<h3>Sign in</h3>
			<br>
			<form method="POST" action="">
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email"
									<?php if(!empty($_POST["email"])){ echo " value='".$_POST["email"]."'"; }?>>
									
					<br> <input type="password" name="password" class="form-control" placeholder="Password"
									<?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
							
					<br>
						<p id="p1" style="float: left" ><input type="checkbox" name="stayLoggedIn"> Remember Me</p>		
						<p style="float: right"> <input type="submit" name="attemptLogin" class="btn btn-default" value="Login"> <a href ="resetPassword.php"><input class="btn btn-default" value="Forgotten Password"></a></p>
		
				</div>
	            <br>
			
			</form>
			<?php include ("includes/login.php")?>
		</div>
	</div
	>	
</div>
			
			<!-- End user login, begin user registration-

			<div class="panel panel-default" style="background-color: #AAAAAA; margin-top: 10px; margin-bottom: 10px;">
				<div class="panel-heading" role="tab">
					
					<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						<p style="text-align: center; margin-bottom: 0px; color: #333333; text-decoration: none">Register</p>
					</a>
					
				</div>
				<form method="POST" action="">
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-3">
										<p id="p1" class="text-left"><span class="label label-default">Email</span></p> 
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="email" name="emailRegister" class="form-control" <?php if(!empty($_POST["emailRegister"])){ echo " value='".$_POST["emailRegister"]."'"; }?>>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-3">
										<p id = "p1" class="text-left"><span class="label label-default">Password</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="password" name="passwordRegister" class="form-control" <?php if(!empty($_POST["passwordRegister"])){ echo " value='".$_POST["passwordRegister"]."'"; }?>>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-3">
										<p id = "p1" class="text-left"><span class="label label-default">Retype Password</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="password" name="passwordRegisterCheck" class="form-control" <?php if(!empty($_POST["passwordRegisterCheck"])){ echo " value='".$_POST["passwordRegisterCheck"]."'"; }?>>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-3">
										<p id="p1" class="text-left"><span class="label label-default">First Name</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="text" name="firstName" class="form-control" <?php if(!empty($_POST["firstName"])){ echo " value='".$_POST["firstName"]."'"; }?>>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-3">
										<p id="p1" class="text-left"><span class="label label-default">Last Name</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="text" name="lastName" class="form-control" <?php if(!empty($_POST["lastName"])){ echo " value='".$_POST["lastName"]."'"; }?>>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-3">
										<p id="p1" class="text-left"><span class="label label-default">Address Line 1</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="text" name="addressLine1" class="form-control" <?php if(!empty($_POST["addressLine1"])){ echo " value='".$_POST["addressLine1"]."'"; }?>>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-3">
										<p id="p1" class="text-left"><span class="label label-default">Address Line 2</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="text" name="addressLine2" class="form-control" <?php if(!empty($_POST["addressLine2"])){ echo " value='".$_POST["addressLine2"]."'"; }?>>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-3">
										<p id="p1" class="text-left"><span class="label label-default">Mobile Number</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="text" name="mobileNumber" class="form-control" <?php if(!empty($_POST["mobileNumber"])){ echo " value='".$_POST["mobileNumber"]."'"; }?>>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-3">
										<p id="p1" class="text-left"><span class="label label-default">Home Number</span></p>
									</div>
									<div class="col-sm-9">
										<div class="center">
											<span class="input-group"></span>
											<input type="text" name="homeNumber" class="form-control" <?php if(!empty($_POST["homeNumber"])){ echo " value='".$_POST["homeNumber"]."'"; }?>>
										</div>
									</div>
								</div>
								
								<br>

								<p style="text-align: center"> <input type="submit" name="attemptRegister" class="btn btn-default" value="Register"></p>
								
							</div>
						</div>
					</div>
				</form>
					
				<?php 
					if(isset($_POST['attemptRegister'])){
						$email = $_POST['emailRegister'];
						$password = $_POST['passwordRegister'];
						$passwordCheck = $_POST['passwordRegisterCheck'];
						$firstName = $_POST['firstName'];
						$lastName = $_POST['lastName'];
						$addressLine1 = $_POST['addressLine1'];
						$addressLine2 = $_POST['addressLine2'];
						$mobileNumber = $_POST['mobileNumber'];
						$homeNumber = $_POST['homeNumber'];
						
						if ($password == $passwordCheck){
							if (validateDetails($email, $password, $firstName, $lastName, $addressLine1, $addressLine2, $mobileNumber, $homeNumber) == 1){
								if (createUser() == 1){
									if (validateUser($email, $password) == 1){
										$_SESSION["loggedIn"] = true;
										echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/userDetails.php\")</script>";
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
			</div>
		</div>
	</div>
	
	 Bootstrap -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
