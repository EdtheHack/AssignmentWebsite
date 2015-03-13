<?php
session_start ();

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home - Web Programming Assignment 2</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet"
	href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	include ("includes/nav.php");
	
	if (isset($_SESSION["user"])){
		$user = unserialize($_SESSION["user"]);
		echo $user->getName();
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
	}
?>

<div class="container">
	<div class="well">
		<div class="row">
			<div class="col-md-4">
				<div class="thumbnail"> 
					<img src="http://placehold.it/320x150" alt="">
				</div>
				<div class="col-md-6">
					<h3>Product Name</h3> <br>
					<p>Product Description.....</p>
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>