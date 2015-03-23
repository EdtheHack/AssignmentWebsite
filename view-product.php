<?php
session_start();
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

// $product = unserialize($_POST['product']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Product - Web Programming Assignment 2</title>
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
	
	$pageId = $_SERVER[ 'QUERY_STRING' ];

	$row = getPage($pageId);

	$product = new product ( $row [0], $row [1], $row [2], $row [3], $row[4], $row[5], $row[6], $row[7], $row[8] );

	$_SESSION['product'] = serialize($product);  //serialize product object to pass to basket

	if($row[5] == 1){			
		$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
		$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
	}
	?>
	
	<div class="container">
		<div class="well">
			<div class="row">
				<br>
				<div class="col-md-6">
					<img src="img/<?php echo $product->getImg(); ?>" alt="Product Image" style="width:450px;height:auto">
				</div>
				<div class="col-md-6">
					<div class="col-md-5 pull-right" >
						<h4 class="pull-left"><?php if($row[5] == 1){
							echo "<strong> Our Price: &pound;".$salePrice."</strong><br>
								RRP: <strike>&pound;".$product->getPrice()."</strike><br>
								You Save: <em>&pound;".$salePriceTmp." (".$product->getPercentage()."&#37;)</em><br>";
						}else{
							echo "&pound;".round($product->getPrice(), 2);
						}?></h4>
					</div>
					<h4>
					
						<a href="#"><?php echo $product->getName();?></a>
					</h4>
					<p><?php echo $product->getDescription();?></p>
					<br>
                    <p>Remaining Stock: <?php echo $product->getStock();?></p>
					<?php if($product->getStock() >= 1) { //only allow purchase if there is stock?>  
					<form method="POST" action="view-basket.php">  
						<button type="submit" name="add" value="1" class="btn btn-default pull-right">
							<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
						</button>
						<?php include ("includes/quantity-spinner.php"); ?>
					</form>
					<?php }?>
					<br>
					
				</div>
			</div>
		</div>
		
		<?php
			if(count(getSimilarItems($product->getId()) != 0)){
		?>
		<div class="well">
			<h3>Similar Products</h3>
			<div class="row">
				
			<?php
				$rows = getSimilarItems($product->getId());
				include ("includes/product-bar.php"); 
			}
			?>
			</div>
		</div>
	</div>
</body>
</html>