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
		$_SESSION["user"] = serialize($user);
	}

	?>
	
	<div class="container">
		<div class="well">
			<div class="row">
				<div class="col-md-3">
					<h4><?php echo $user->getName()."'s Basket"; ?></h4>
				</div>
				<div class="col-md-3">
					<h4><?php echo $user->getOrder()->getAmountOfProducts()." Items";?></h4>
				</div>
				<div class="col-md-4">
					<h4><?php echo "Total Price: £".$user->getOrder()->getTotalPrice(); ?></h4> 
				</div>
				<div class="col-md-2"> <?php
					if ($user->getOrder()->getAmountOfProducts() != 0) { echo "<a href=\"confirmPurchase.php\"><button type=\"submit\" class=\"btn btn-default \"> <b> Confirm Purchase </b> </button></a>"; }
				?> </div>
			</div>
		</div>
	
	<?php	
	
	$products = $user->getOrder()->getProducts();
	$count = 0;
	foreach ($products as $product) {				
		$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
		$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
	?>

		<div class="well">
			<div class="row">
				<div class="col-md-6">
					<img src="includes/<?php echo $product->getImg(); ?>" alt="Product Image" height="150" width="auto">
				</div>
				<div class="col-md-6">
					<h5 class=""><?php if ($product->getPercentage() == 0){
						echo "<strong> &pound;".$product->getPrice()."</strong>";
					} else {
						echo "<strong> Our Price: &pound;".$salePrice."</strong><br>
						RRP: <strike>&pound;".$product->getPrice() ."</strike><br>
						You Save: <em>&pound;".$salePriceTmp." (".$product->getPercentage()."&#37;)</em><br>";
					} ?> </h5> <!-- PLEASE IGNORE HTML ERRORS -->
					<h4>
						<a href="#"><?php echo $user->getOrder()->getQuantity($count)." x ".$product->getName(); ?></a>
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
		
		$products = $user->getOrder()->getProducts();
		$rows = getOtherCustomersBought($user->getCurrentOrderId(), $products[0]->getId());
		if ($user->getOrder()->getAmountOfProducts() != 0 && count($rows) != 0){
		?>
		<div class="row">
			<div class="well">
				<h4>You Have <?php echo $products[0]->getName();?></h4>
				<h3>Other Customers also Bought</h3>
				<div class="row">
					<br>
					<?php include ("includes/newest-products.php"); ?>
					
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>

</body>
</html>