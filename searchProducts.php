<?php

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

	include ("includes/product.php");
	session_start();
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

		echo $_POST['searchItem'];
		$rows = getSearchedItems($_POST['searchItem']);
		
		for ($rows as $row) {
			$product = new product($row[0], $row[1], $row[2], $row[3]);				
	?>
		
			<div class="row">
				<br>
				<div class="col-md-6">
					<img src="http://placehold.it/320x150" alt="">
				</div>
				<div class="col-md-6">
					<h4 class="pull-right"><?php echo $product->getPrice(); ?></h4>
					<h4>
						<a href="#"><?php echo $product->getName(); ?></a>
					</h4>
					<p> <?php echo $product->getDescription(); ?></p>
				
					<form method="POST" action="viewProduct.php">
						<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default left-margin"><i class="fa fa-eye"></i> <b> View </b> </button>	
					</form>
					
					<form method="POST" action="viewProduct.php">  
						<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b> </button>	
					</form>
				</div>
				<br>
				<br>
			</div>
		
		<?php
		
			if(isset($_POST['viewProduct'])){   //serialization does not work
				$_SESSION["serializedProduct"] = serialize($product);
				$_SESSION["name"] = $this->getName();
				echo "<script type=\"text/javascript\">document.location.href=\"viewProduct.php\";</script>";
			}
		}
		?>