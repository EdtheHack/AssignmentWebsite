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
		if(isset($_SESSION["product"]) && isset($_POST["add"])){   //checks if user came here from a product page
			$addProduct = unserialize($_SESSION["product"]);
			$user->getOrder()->addProduct($addProduct, $_POST['quantity']);
			unset($_SESSION['product']);
			$_SESSION["user"] = serialize($user);
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
			<div class="row">
				<div class="col-md-4">
					<h4><?php echo $user->getName()."'s Basket"; ?></h4>
				</div>
				<div class="col-md-4">
					<h4><?php echo $user->getOrder()->getAmountOfProducts()." Products";?></h4>
				</div>
				<div class="col-md-4">
					<h4><?php echo "Total Price: £".$user->getOrder()->getTotalPrice(); ?></h4>
				</div>
			</div>
		</div>
	
	<?php	
	
	$products = $user->getOrder()->getProducts();
	$quantities = $user->getOrder()->getQuantities();
	$count = 0;
	foreach ($products as $product) {
		$price = $product->getPrice();
		$percent = $product->getPercentage();
						
		$sale_price_tmp = number_format(($price * $percent / 100), 2, '.', '');
		$sale_price =  number_format(($price - $sale_price_tmp), 2, '.', '');
	?>

		<div class="well">
			<div class="row">
				<div class="col-md-6">
					<img src="includes/<?php echo $product->getImg(); ?>" alt="Product Image" height="150" width="auto">
				</div>
				<div class="col-md-6">
					<h5 class=""><?php echo "<strong> Our Price: &pound;".$sale_price."</strong><br>
															RRP: <strike>&pound;".$product->getPrice() ."</strike><br>
															You Save: <em>&pound;".$sale_price_tmp." (".$percent."&#37;)</em><br>"?></h5> <!-- PLEASE IGNORE HTML ERRORS -->
					<h4>
						<a href="#"><?php echo $quantities[$count]." -- ".$product->getName(); ?></a>
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
		</div>
		<?php
		$count++;
		}
		?>
		<a href="confirmPurchase.php"><button type="submit" class="btn btn-default "><i class="fa fa-eye "></i> <b> View </b> </button></a>
	</div>

</body>
</html>