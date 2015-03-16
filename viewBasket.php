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
	
	 if(isset($_SESSION["user"])){  //checks if user is logged in
		$user = unserialize($_SESSION["user"]);
		if(isset($_SESSION["product"])){   //checks if user came here from a product page
			$addProduct = unserialize($_SESSION["product"]);
			$user->getOrder()->addProduct($addProduct);
		}
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
	}
	
	if(isset($_POST["removeItemId"])){ 
		$user->getOrder()->removeProduct($_POST["removeItemId"]);
	}

	?>
	
	<div class="container">
		<div class="well">
			<div class="col-md-4">
				<h2><?php echo $user->getName()."'s Basket"; ?></h2>
			</div>
			<div class="col-md-4">
				<h2><?php echo $user->getOrder()->getAmountOfProducts()." Products";?></h2>
			</div>
			<div class="col-md-4">
				<h2><?php echo "Total Price: £".$user->getOrder()->getTotalPrice(); ?></h2>
			</div>
		</div>
	
	<?php	
	
	$products = $user->getOrder()->getProducts();
	foreach ($products as $product) {
	?>

		<div class="well">
			<div class="col-md-6">
				<img src="includes/<?php echo $product->getImg(); ?>" alt="Product Image" height="150" width="auto">
			</div>
			<div class="col-md-6">
				<h4 class="pull-right"><?php echo $product->getPrice(); ?></h4>
				<h4>
					<a href="#"><?php echo $product->getName(); ?></a>
				</h4>
				<p> <?php echo $product->getDescription(); ?></p>
			
				<div class="col-md-6">
					<a href="viewProduct.php?<?php echo $product->getId(); ?>"><button type="submit" class="btn btn-default "><i class="fa fa-eye "></i> <b> View </b> </button></a>
				</div>
				<div class="col-md-6">
					<form method="POST" action="viewBasket.php">
						<button type="submit" name='removeItemId' value='<?php echo $product->getId(); ?>' class="btn btn-default left-margin"><i class="fa fa-eye"></i> <b> Remove </b> </button>	
					</form>
				</div>
			</div>
			<br>
		</div>
		<?php
		}
		?>
	</div>

</body>
</html>