<?php
session_start ();

if(!isset($_SESSION["user"])){  //checks if user is logged in
	echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Your Basket - Web Programming Assignment 2</title>
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
	<?php include ("includes/nav.php"); ?>
	
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
			$rows = array_push($rows, getOtherCustomersBought($user->getCurrentOrderId(), $product->getId()));
			$count++;
		}	
		unset($basketItem);
		
		if ($user->getOrder()->getAmountOfProducts() > 0 && count($rows) > 0){			
		?>
		<div class="row">
			<div class="well">
				<h4>Based On Your Basket</h4>
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
	<?php include ("includes/footer.php")?>
</body>
</html>