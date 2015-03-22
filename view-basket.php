<?php
session_start ();
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
			setBasket($user->getOrder()->getAmountOfProducts());
			unset($_SESSION['product']);
			$_SESSION["user"] = serialize($user);
		}
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
	}
	
	if(isset($_POST["removeItemId"])){ 
		$user->getOrder()->removeProduct($_POST["removeItemId"]);
		setBasket($user->getOrder()->getAmountOfProducts());
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
					if ($user->getOrder()->getAmountOfProducts() != 0) { echo "<a href=\"confirm-purchase.php\"><button type=\"submit\" class=\"btn btn-default \"> <b> Confirm Purchase </b> </button></a>"; }
				?> </div>
			</div>
		</div>
	
		<?php	
		$products = $user->getOrder()->getProducts();
		$count = 0;
		$basketItem = true;
		foreach ($products as $product) {				
			include ("includes/row-item.php");
			$count++;
		}	
		unset($basketItem);
		
		if (count($products) > 0){ $rows = getOtherCustomersBought($user->getCurrentOrderId(), $products[0]->getId()); }
		if ($user->getOrder()->getAmountOfProducts() > 0 && count($rows) > 0){			
		?>
		<div class="row">
			<div class="well">
				<h4>You Have <?php echo $products[0]->getName();?></h4>
				<h3>Other Customers also Bought</h3>
				<div class="row">
					<br>
					<?php include ("includes/product-bar.php"); ?>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>

</body>
</html>