<?php
session_start();
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

include ("includes/product.php");
include ("includes/common-functions.php");

$row = getItem ( $_POST ['itemId'] );
$product = new product ( $row [0], $row [1], $row [2], $row [3] );

// $product = unserialize($_POST['product']);
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
	?>
	
	
	<div class="container">
		<div class="well">
			<div class="row">
				<br>
				<div class="col-md-6">
					<img src="http://placehold.it/500x400" alt="">
				</div>

				<div class="col-md-6">
					<h4 class="pull-right"><?php echo "&pound;".round($product->getPrice(), 2);?></h4>
					<h4>
						<a href="#"><?php echo $product->getName();?></a>
					</h4>
					<p><?php echo $product->getDescription();?></p>
					<br>
					<button type="submit" class="btn btn-default pull-right">
						<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
					</button>
				</div>
			</div>
		</div>
		<div class="well">
		
		<?php
		
		for ($i = 0; $i < $arr_length; $i++) {
		
		?>
	
			<div class="row">
				<h3>Similar Products</h3>
				<div class="row">
					<div class="col-md-4">
						<img src="http://placehold.it/320x150" alt="">
						<div class="caption">
							<h3>Product Name</h3>
							<p>Description....</p>
						</div>
					</div>
				</div>
			</div>
		
		<?php
		
		}
		
		?>
		</div>
	</div>
</body>
</html>