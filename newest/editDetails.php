<?php
	include 'functions/databaseValidation.php';	
	if ($_SESSION["loggedIn"] == true){
	} else {
		echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/index.php\")</script>";
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<title> Edit Details </title>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
		
		<style>
			p#p1 {
				margin-top: 11px;
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
				<li class="active">Edit Details</li>
			</ul>
		</div>
	</nav>
	
	<h1 class ="text-center"> Edit Details </h1>
	
	<br>
	
	<form method="POST" action="">
		<div id="d1" class="panel panel-default">
			<div style="padding-top: 24px" class="panel-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="row">
								<p id="p1"><span class="label label-default">First Name</span></p>
							</div>		
						</div>
						<div id="d2" class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="text" name="firstName" class="form-control" placeholder="<?php echo $_SESSION['firstName'] ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="row">
								<p id="p1"><span class="label label-default">Last Name</span></p>
							</div>		
						</div>
						<div id="d2" class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="text" name="lastName" class="form-control" placeholder="<?php echo $_SESSION['lastName'] ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="row">
								<p id="p1"><span class="label label-default">Address Line 1</span></p>
							</div>		
						</div>
						<div id="d2" class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="text" name="addressLine1" class="form-control" placeholder="<?php echo $_SESSION['addressLine1'] ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="row">
								<p id="p1"><span class="label label-default">Address Line 2</span></p>
							</div>		
						</div>
						<div id="d2" class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="text" name="addressLine2" class="form-control" placeholder="<?php echo $_SESSION['addressLine2'] ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="row">
								<p id="p1"><span class="label label-default">Mobile Number</span></p>
							</div>		
						</div>
						<div id="d2" class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="text" name="mobileNumber" class="form-control" placeholder="<?php echo $_SESSION['mobileNumber'] ?>">
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="row">
								<p id="p1"><span class="label label-default">Home Number</span></p>
							</div>		
						</div>
						<div id="d2" class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="text" name="homeNumber" class="form-control" placeholder="<?php echo $_SESSION['homeNumber'] ?>">
							</div>
						</div>
					</div>	
					<br>
				</div>
				
				<br>
				<form method="POST" action="">
				<p style="text-align: center"> <input type="submit" name="back" class="btn btn-default" value="Back"> <input type="submit" name="saveDetails" class="btn btn-default" value="Save"> <input type="submit" name="changeEmail" class="btn btn-default" value="Change Email"> <input type="submit" name="changePass" class="btn btn-default" value="Change Password"></p>
				</form>
			</div>
		</div>
	</form>
	
	<?php
		if (isset ($_POST['saveDetails'])) {
			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$addressLine1 = $_POST['addressLine1'];
			$addressLine2 = $_POST['addressLine2'];
			$mobileNumber = $_POST['mobileNumber'];
			$homeNumber = $_POST['homeNumber'];
			if (updateUser($firstName, $lastName, $addressLine1, $addressLine2, $mobileNumber, $homeNumber) == 1) {
				echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/userDetails.php\")</script>";
			} else {
				echo "There was a problem updating information";
			}		
		}
		
		if (isset ($_POST['back'])) {
				echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/userDetails.php\")</script>";		
		}
		
		if (isset ($_POST['changePass'])) {
				echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/changePassword.php\")</script>";		
		}
		
		if (isset ($_POST['changeEmail'])) {
				echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/changeEmail.php\")</script>";		
		}
	?>
	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
