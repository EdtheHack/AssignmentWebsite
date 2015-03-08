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
	
	<div class="col-md-9">
		<div class="bs-example">
		    <ul class="nav nav-tabs">
		        <li class="active"><a data-toggle="tab" href="#sectionA">Change Password</a></li>
		        <li><a data-toggle="tab" href="#sectionB">Change Email</a></li>
		        <li><a data-toggle="tab" href="#sectionC">Change Other Details</a></li>
		   </ul>
		     	<div class="tab-content">
		       		<div id="sectionA" class="tab-pane fade in active">	
						<h3>Change Password</h3>
						<br>
							<form method="POST" action="">
								<div class="form-group">
							     	<label for="email">Old Password :</label>
									<input type="password" name="oldPassword" class="form-control" placeholder="Enter old password" <?php if(!empty($_POST["oldPassword"])){ echo " value='".$_POST["oldPassword"]."'"; }?>>
								</div>			
								<br>
								<div class="form-group">
							     	<label for="email">New Password :</label>
									<input type="password" name="newPassword" class="form-control" placeholder="Enter new password" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
								</div>
								<div class="form-group">
							     	<label for="email">Confirm New Password :</label>
									<input type="password" name="newPasswordCheck" class="form-control" placeholder="Confirm new password"  <?php if(!empty($_POST["passwordCheck"])){ echo " value='".$_POST["passwordCheck"]."'"; }?>>
								</div>
								<br>
									<input type="submit" name="changePassword" class="btn btn-default" value="Save"> <input style="float: right;" type="submit" name="back" class="btn btn-default" value="Cancel"> 
							</form>	
							<br>
						</div>            
		        		<div id="sectionB" class="tab-pane fade">
		        			<h3>Change your email address</h3>
							<br>
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
									 <input type="submit" name="changeEmail" class="btn btn-default" value="Save"><input style="float: right;" type="submit" name="back" class="btn btn-default" value="Cancel"> 
							</form>	
							<br>
		        		</div>
		        		<div id="sectionC" class="tab-pane fade">
		        			<form method="POST" action="">
		        			<h3>Change other account details</h3>
		        			<br>
								<div class="form-group">
									<label for="firstname">First Name:</label>
									<input type="text" name="firstName" class="form-control" placeholder="Enter First Name" value="<?php echo $_SESSION['firstName'] ?>">
								</div>
								<div class="form-group">
									<label for="lastname">Last Name:</label>
									<input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" value="<?php echo $_SESSION['lastName'] ?>">
								</div>
								<div class="form-group">
									<label for="addr1">Address Line 1:</label>
									<input type="text" name="addressLine1" class="form-control" placeholder="Enter Address Line 1" value="<?php echo $_SESSION['addressLine1'] ?>">
								</div>
								<div class="form-group">
									<label for="addr2">Address Line 2:</label>
									<input type="text" name="addressLine2" class="form-control" placeholder="Enter Address Line 2" value="<?php echo $_SESSION['addressLine2'] ?>">
								</div>
								<div class="form-group">
									<label for="addr2">Postcode:</label>
									<input type="text" name="addressLine2" class="form-control" placeholder="Enter Address Line 2" value="<?php echo $_SESSION['postcode'] ?>">
								</div>
								<div class="form-group">
									<label for="no1">Mobile Number:</label>
									<input type="text" name="mobileNumber" class="form-control" placeholder="Enter Mobile Number" value="<?php echo $_SESSION['mobileNumber'] ?>">
								</div>
								<div class="form-group">
									<label for="no2">Home Number:</label>
									<input type="text" name="homeNumber" class="form-control" placeholder="Enter Home Number" value="<?php echo $_SESSION['homeNumber'] ?>">
								</div>
								
								<input type="submit" name="changeDetails" class="btn btn-default" value="Save"><input style="float: right;" type="submit" name="back" class="btn btn-default" value="Cancel"> 
							</form>
	
		        		</div>
		        	</div>
		        		
		        		<?php 
		        		include ("includes/account-details.php");
		        		?>
		     </div>
		</div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
	