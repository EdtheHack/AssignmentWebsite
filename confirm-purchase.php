<?php
	session_start();
	include 'includes/user-validation.php';
	
	ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Confirm Purchase - Web Programming Assignment 2</title>
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
		if ($user->getOrder()->getAmountOfProducts() == 0){
			echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>";
		}
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
	}
	
	
/*==================
 *  Delivery Logic
 *==================
 *
 *Free delivery over £75
 *For first products delivery is £3.80
 *For every product after that it's plus £2.80 
 *
 *The delivery price is then added to the total price and is what the user pays
 */
	
	$product_total = $user->getOrder()->getAmountOfProducts(); //int 
	$order_total = $user->getOrder()->getTotalPrice(); 
	$delivery_fee = 0; //default delivery price
	
	if ($order_total >= 75){
	$delivery_fee = number_format(( $delivery_fee = 0), 2, '.', '');
	}else{
		for ($i = 0; $i < $product_total; $i++){
			if($i == 0){
				$delivery_fee = number_format(( $delivery_fee + 3.80), 2, '.', ''); 
			}else{
				$delivery_fee = number_format(( $delivery_fee + 2.80), 2, '.', '');
			}
		}
	}
		
	
?>
	<div class="container">
		<div class="well">
			<div class="row">
				<div class="col-md-4">
					<h4><?php echo $user->getName()."'s Basket"; ?></h4>
				</div>
				<div class="col-md-4">
					<h4><?php echo "Purchasing " .$user->getOrder()->getAmountOfProducts()." Items";?></h4>
				</div>
				<div class="col-md-4">
					<h4><?php $total = $user->getOrder()->getTotalPrice() + $delivery_fee; echo "Total Price: Â£".$total?></h4>
				</div>
			</div>
		</div
			<br>
			<hr>
			<div class="well">
			<div class="row">
				<div class="col-md-6">
				<h4>Order Contents</h4>
				<br>
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
							$count++;
							}
						?>
						</tbody>
					</table>
					<br>
					<h4>Order Break Down</h4>
					<br>
					<table class="table table-hover table-responsive pull-right">
						<thead>
							<tr>
								<th>Items ordered</th>
								<th>Item Total</th>
								<th>Postage and Packing</th>
								<th>Order Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $user->getOrder()->getAmountOfProducts(); ?></td>
								<td><?php echo "&pound;".$user->getOrder()->getTotalPrice();?></td>
								<td><?php if($delivery_fee == 0){ echo "FREE!"; }else{ echo "&pound;".$delivery_fee; }?></td>
								<td><?php $total = $user->getOrder()->getTotalPrice() + $delivery_fee; echo "&pound;".$total?></td>
								
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="col-md-6">
					<h4>Delivery Address</h4>
					<br>
					<table class="table table-responsive pull-right">
						<tbody>
							<tr>
								<td>Name</td>
								<td><?php echo $user->getName()." ".$_SESSION["lastName"];?></td>
							</tr>
							<tr>
								<td>Address Line 1</td>
								<td><?php echo $_SESSION["addressLine1"]?></td>
							</tr>
							<tr>
								<td>Address Line 2</td>
								<td><?php echo $_SESSION["addressLine2"]?></td>
							</tr>
							<tr>
								<td>Postcode</td>
								<td><?php echo $_SESSION["postcode"]?></td>
							</tr>
						</tbody>
					</table>
					<a href="change-account-details.php?purchase#sectionC" class="pull-right">Change Details</a>
				
					<br>
					<p> Confirm your password to buy </p>
					<form method="POST" action="">
						<div class="form-group"> 
							<input type="password" name="password" class="form-control" placeholder="Password" <?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>		
							<br>
							<p style="float: right"> <input type="submit" name="confirm" class="btn btn-info" value="Confirm"> <a data-toggle="tab" href="#" id="btn-next" ><input class="btn btn-default" value="Forgotten Password"></a></p>
						</div>
					</form>
					<?php
					if(isset($_POST["password"])){  //checks if user submit a password
						if (validateUser($user->getEmail(), $_POST["password"]) == 1){
							$user->purchaseCurrentOrder();
							$_SESSION["user"] = serialize($user);
						} else {
							echo "Incorrect Password";
						}						
					}
					?>
					
				</div>
			</div>
		</div>
	</div>
	<?php include ("includes/footer.php")?>
</body>
</html>