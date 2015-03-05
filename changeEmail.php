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
		<title> Change Email </title>
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
	</head> <!-- Jeremy is a broooo -->

	<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="nav navbar-text">
				<b> i7212753 Web Assignment </b>
			</div>
			<ul class="nav navbar-text">
				<li class="active">Change Email</li>
			</ul>
		</div>
	</nav>
	
	<h1 class ="text-center"> Change Email </h1>
	
	<br>
	
	<div id="d1" class="panel panel-default">
		<div style="padding-top: 24px" class="panel-body">
			<form method="POST" action="">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<p id = "p1" class="text-left"><span class="label label-default">Password</span></p>
						</div>
						<div class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="password" name="password" class="form-control" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
							</div>
						</div>
					</div>
					
					<br>
					
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<p id = "p1" class="text-left"><span class="label label-default">Old Email</span></p>
						</div>
						<div class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="email" name="oldEmail" class="form-control" <?php if(!empty($_POST["oldEmail"])){ echo " value='".$_POST["oldEmail"]."'"; }?>>
							</div>
						</div>
					</div>
					
					<br>
					
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<p id = "p1" class="text-left"><span class="label label-default">New Email</span></p>
						</div>
						<div class="col-xs-9 col-sm-9">
							<div class="center">
								<span class="input-group"></span>
								<input type="email" name="newEmail" class="form-control" <?php if(!empty($_POST["newEmail"])){ echo " value='".$_POST["newEmail"]."'"; }?>>
							</div>
						</div>
					</div>
				</div>
				
				<br>
				
				<p style="text-align: center"> <input type="submit" name="back" class="btn btn-default" value="Back"> <input type="submit" name="saveDetails" class="btn btn-default" value="Save"></p>
			</form>	
			<?php
				if (isset ($_POST['saveDetails'])) {
					$password = $_POST['password'];
					$oldEmail = $_POST['oldEmail'];
					$newEmail = $_POST['newEmail'];
					
					if ($password != null){
						if (updateEmail($password, $oldEmail, $newEmail) == 1) {
							echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/userDetails.php\")</script>";
						} 	
					} else {
						echo "Password can not be null";
					}
				}
				
				if (isset ($_POST['back'])) {
						echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/editDetails.php\")</script>";		
				}
			?>
		</div>
	</div>
	
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
