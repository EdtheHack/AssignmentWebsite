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
		<div class="bs-example">
		    <ul class="nav nav-tabs">
		        <li class="active"><a data-toggle="tab" href="#sectionA">Sign In</a></li>
		        <li><a data-toggle="tab" href="#sectionB">Register With us</a></li>
		        <li><a data-toggle="tab" href="#sectionC">Reset Password</a></li>
		    </ul>
		    <div class="tab-content">
		        <div id="sectionA" class="tab-pane fade in active">
		           <div>		
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
										<p style="float: right"> <input type="submit" name="attemptLogin" class="btn btn-default" value="Login"> <a data-toggle="tab" href="#sectionC" id="btn-next" ><input class="btn btn-default" value="Forgotten Password"></a></p>
						
								</div>
					            <br>
							
							</form>
							<?php include ("includes/login.php")?>
					</div>             
		        </div>
		        <div id="sectionB" class="tab-pane fade">
		            <h3>Register With Us</h3>
							<br>
						<form method="POST" action="">
							<div class="form-group">
		    			        <label for="email">Email:</label>
								<input type="email" class="form-control" id="email" placeholder="Enter email" name="emailRegister"  <?php if(!empty($_POST["emailRegister"])){ echo " value='".$_POST["emailRegister"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">Password:</label>		
								<input type="password" name="passwordRegister" placeholder="Enter Password" class="form-control" <?php if(!empty($_POST["passwordRegister"])){ echo " value='".$_POST["passwordRegister"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">Retype Password:</label>			
		    			        <input type="password" name="passwordRegisterCheck" placeholder="Re-Enter Password" class="form-control" <?php if(!empty($_POST["passwordRegisterCheck"])){ echo " value='".$_POST["passwordRegisterCheck"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">First Name:</label>			
								<input type="text" name="firstName" class="form-control" placeholder="Enter First Name" <?php if(!empty($_POST["firstName"])){ echo " value='".$_POST["firstName"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">Last Name:</label>			
								<input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" <?php if(!empty($_POST["lastName"])){ echo " value='".$_POST["lastName"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">Address Line 1:</label>	
								<input type="text" name="addressLine1" class="form-control" placeholder="Enter Address Line 1" <?php if(!empty($_POST["addressLine1"])){ echo " value='".$_POST["addressLine1"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">Address Line 2:</label>	
								<input type="text" name="addressLine2" class="form-control" placeholder="Enter Address Line 2" <?php if(!empty($_POST["addressLine2"])){ echo " value='".$_POST["addressLine2"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">Mobile Number:</label>	
								<input type="text" name="mobileNumber" class="form-control" placeholder="Enter Mobile Number " <?php if(!empty($_POST["mobileNumber"])){ echo " value='".$_POST["mobileNumber"]."'"; }?>>
							</div>
							<div class="form-group">
		    			        <label for="email">Home Number:</label>	
								<input type="text" name="homeNumber" class="form-control" placeholder="Enter Home Number "  <?php if(!empty($_POST["homeNumber"])){ echo " value='".$_POST["homeNumber"]."'"; }?>>
							</div>
										
							<br>
							<p style="text-align: center"> <input type="submit" name="attemptRegister" class="btn btn-default" value="Register"></p>
						</form>     
						<?php 
							include ("includes/register.php");
						?>
			   
				</div>
				<div id="sectionC" class="tab-pane fade">
					<h3>Password Reset</h3>
					
						<form method="POST" action="">
							<div class="form-group">
		    			        <label for="email">Please eneter your account Email:</label>
								<input type="email" name="email" class="form-control" placeholder="Email">
							</div>
							<br>
							<input type="submit" name="sendMail" class="btn btn-default" value="Get New Password">
						</form>
						<?php 
							include ("includes/reset-password.php");
						?>
					
				</div>
    		</div>
		</div>
	</div>
</div>


				
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
