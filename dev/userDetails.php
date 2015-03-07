<?php
	include 'includes/databaseValidation.php';	
	if ($_SESSION["loggedIn"] == true){
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> View Details </title>
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
				<li class="active">View Details</li>
			</ul>
		</div>
	</nav>
	
	<h1 class ="text-center"> Your Details </h1>
	
	<br>
	
	<div id="d1" class="panel panel-default">
		<div style="padding-top: 24px" class="panel-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-3 col-sm-3">
							<div class="row">
								<p id="p1"><span class="label label-default">First Name</span></p>
							</div>		
							<div class="row">
								<p id="p1"><span class="label label-default">Last Name</span></p>
							</div>	
							<div class="row">
								<p id="p1"><span class="label label-default">Address Line 1</span></p>
							</div>
							<div class="row">
								<p id="p1"><span class="label label-default">Address Line 2</span></p>
							</div>
							<div class="row">
								<p id="p1"><span class="label label-default">Mobile Number</span></p>
							</div>			
							<div class="row">
								<p id="p1"><span class="label label-default">Home Number</span></p>
							</div>	
					</div>
					
					<div class="col-xs-9 col-sm-9">
						<ul class="list-group">
							<li class="list-group-item"><?php echo $_SESSION['firstName'] ?></li>
							<li class="list-group-item"><?php echo $_SESSION['lastName'] ?></li>
							<li class="list-group-item"><?php echo $_SESSION['addressLine1'] ?></li>
							<li class="list-group-item"><?php echo $_SESSION['addressLine2'] ?></li>
							<li class="list-group-item"><?php echo $_SESSION['mobileNumber'] ?></li>
							<li class="list-group-item"><?php echo $_SESSION['homeNumber'] ?></li>
						</ul>
					</div>
				</div>
			</div>
			
			<br>
			<form method="POST" action="">
			<p style="text-align: center"> <input type="submit" name="logout" class="btn btn-default" value="Log Out"> <button input type="submit" name="editDetails" class="btn btn-default">Edit Details</button></p>
			</form>
			<?php 
				if(isset($_POST['editDetails'])){
					echo "<script>window.location.replace(editDetails.php)</script>";
				}
				
				if(isset($_POST['logout'])){
					$_SESSION["loggedIn"] = false;
					unset($_SESSION);
					session_destroy();
					echo "<script>window.location.replace(index.php)</script>";
				}
			?>
		</div>
	</div>
	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
