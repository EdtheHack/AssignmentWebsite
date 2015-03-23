<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Orders - Web Programming Assignment 2</title>
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
				<h4><?php echo $user->getName()."'s Orders";?></h4>
			</div>
			<br>
			<?php
				$orderIdDates = getPurchasedOrders($user->getId());
				$count = 0;
						
				foreach ($orderIdDates as $orderIdDate){
			?>
			<div class="row">
			<h4><?php echo "Order Id: ".$orderIdDate[0]." - Purchased: ".$orderIdDate[1];?></h4>
				<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<th>Product</th>
							<th>Description</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$products = getOrderProducts($orderIdDate[0]);
						
						foreach ($products as $product){
					?>
						<tr>
							<td><?php echo $product[1]?></td>
							<td><?php echo $product[3]?></td>
							<td><?php echo $product[9]?></td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
			$count++;
			}
			?>
			<br>
		</div>
	</div>
</body>
</html>