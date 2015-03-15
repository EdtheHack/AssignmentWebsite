<?php
	session_start();
	
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
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
<?php
	include ("includes/nav.php");
?>
	
<div class="container">
	<?php include ("includes/just-added.php")?>
    
    <div class="col-md-9">
	  <div class="row">
	   	 <div class="jumbotron">
	  		<h2>Guaranteed next day delivery...<br><small class="pull-right">(..or your next delivery is on us!)</small></h2>
	  		<br>
	  		<br>
	  		<img src="http://placehold.it/750x200" alt="">
	  		<br>
	 		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut mi non urna pellentesque vulputate vel nec sem. Nulla feugiat facilisis ex non finibus.</p>
	  		<p><a class="btn btn-default btn-lg" href="#" role="button">Learn more</a></p>
		</div>
	</div>
	
<?php 
	include ("includes/newest-products.php")
?>

    </div>
  </div>
</div>
</body>
</html>