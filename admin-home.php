<?php
session_start ();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin - Web Programming Assignment 2</title>
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
?>
	
<div class="container">
	<?php include ("includes/just-added.php")?>
    
    <div class="col-md-9">
			<div class="row">
				<div class="jumbotron">
					<h2>
						Hi, [name here pls].<br>
						<small class="pull-right">What would you like to do today?</small>
					</h2>
					<br> <br> <img src="http://placehold.it/750x200" alt=""> <br>
					<p>Welcome to the administration pages. From here, you can add,
						edit, and remove products, plus much more.</p>
				</div>
			</div>

			<div class="row">

				<div class="list-group">
					<a href="#" class="list-group-item active"> Admin Home </a> <a
						href="#" class="list-group-item">Add New Product</a> <a href="#"
						class="list-group-item">Edit Existing Product</a> <a href="#"
						class="list-group-item">Remove Product</a> <a href="#"
						class="list-group-item">Update Account Details</a> <a href="#"
						class="list-group-item">Update Customer Account Details</a>
				</div>


			</div>
		</div>
	</div>
</body>
</html>