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

	<div class="row">
		<br>
		<div class="thumbnail">
			<img src="http://placehold.it/320x150" alt="">
			<div class="caption">
				<h4 class="pull-right"><?php echo $product1->getPrice();?></h4>
				<h4>
					<a href="#"><?php echo $product1->getName();?></a>
				</h4>
				<p><?php echo $product1->getDescription();?></p>
			</div>
			<div>
				<button type="submit" class="btn btn-default">
					<i class="fa fa-eye"></i> <b> View </b>
				</button>
				<button type="submit" class="btn btn-default pull-right">
					<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
				</button>
			</div>
		</div>
	</div>
</body>
</html>