<?php
	session_start();
	
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
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
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
			<div class="row">
				<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<th>Product</th>
							<th>Price</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$products = $user->getOrder()->getProducts();
						$count = 0;
						
						foreach ($products as $product){
							$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
							$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
					?>
						<tr>
							<td><?php echo $product->getName()?></td>
							<td><?php echo "&pound;".$salePrice?></td>
							<td><?php echo $user->getOrder()->getQuantity($count)?></td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<div class="row">
				<form method="POST" action="">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Email" <?php if(!empty($_POST["email"])){ echo " value='".$_POST["email"]."'"; }?>>							
						<br> 
						<input type="password" name="password" class="form-control" placeholder="Password" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>		
						<br>
						<p style="float: right"> <input type="submit" name="confirm" class="btn btn-default" value="Confirm"> <a data-toggle="tab" href="#" id="btn-next" ><input class="btn btn-default" value="Forgotten Password"></a></p>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>