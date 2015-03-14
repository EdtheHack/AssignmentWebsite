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
	include ("includes/order.php");
	include ("includes/product.php");
	
	 if(isset($_SESSION["user"])){  //checks if user is logged in
		$user = unserialize($_SESSION["user"]);
		$order = unserialize($_SESSION["order"]);
		if(isset($_SESSION["product"])){   //checks if user came here from a product page
			$addProduct = unserialize($_SESSION["product"]);
			$order->addProduct(unserialize($_SESSION["product"]));
			addProduct($order->getId(), $addProduct->getId(), 1);
		}
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
	}
	
	foreach ($order->getProducts() as $product) {
		echo $order->getId();
		echo $product->getName();
?>

		<div class="well">
			<div class="row">
				<div class="col-md-6">
					<img src="http://placehold.it/320x150" alt="">
				</div>
				<div class="col-md-6">
					<h4 class="pull-right"><?php echo $product->getPrice(); ?></h4>
					<h4>
						<a href="#"><?php echo $product->getName(); ?></a>
					</h4>
					<p> <?php echo $product->getDescription(); ?></p>
				
					<div class="col-md-6">
						<form method="POST" action="viewProduct.php">
							<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default left-margin"><i class="fa fa-eye"></i> <b> View </b> </button>	
						</form>
					</div>
					<div class="col-md-6">
						<form method="POST" action="viewProduct.php">  
							<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b> </button>	
						</form>
					</div>
				</div>
				<br>
			</div>
		</div>
		<?php
		}
		?>

</body>
</html>