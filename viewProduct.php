<?php
session_start();
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

include ("includes/product.php");
include ("includes/common-functions.php");


//$row = getItem ($_POST['itemId']);
//$product = new product ( $row [0], $row [1], $row [2], $row [3], $row[4], $row[5], $row[6], $row[7], $row[8] );
//$_SESSION['product'] = serialize($product);

$pageId = $_SERVER[ 'QUERY_STRING' ];

$row = getPage($pageId);

$product = new product ( $row [0], $row [1], $row [2], $row [3], $row[4], $row[5], $row[6], $row[7], $row[8] );

if($row[5] == 1){
		
	$price = round($product->getPrice(), 2);
	$percent = $product->getPercentage();
	
	$sale_price_tmp = round($price * $percent / 100, 2);
	$sale_price =  round($price - $sale_price_tmp, 2);
}

// $product = unserialize($_POST['product']);
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
	?>
	
	
	<div class="container">
		<div class="well">
			<div class="row">
				<br>
				<div class="col-md-6">
					<img src="img/<?php echo $product->getImg(); ?>" alt="">
				</div>

				<div class="col-md-6">
					<div class="col-md-5 pull-right" >
						<h4 class="pull-left"><?php if($row[5] == 1){
														echo "<strong> Our Price: &pound;".$sale_price."</strong><br>
															RRP: <strike>&pound;".$price ."</strike><br>
															You Save: <em>&pound;".$sale_price_tmp." (".$percent."&#37;)</em><br>";
													}else{
														echo "&pound;".round($product->getPrice(), 2);
													}?></h4>
					
					</div>
					<h4>
					
						<a href="#"><?php echo $product->getName();?></a>
					</h4>
					<p><?php echo $product->getDescription();?></p>
					<br>
                    <p>Remaining Stock: 0</p>
					<form method="POST" action="viewBasket.php">  
						<button type="submit" class="btn btn-default pull-right">
							<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
						</button>
						<?php include ("includes/quantitySpinner.php"); ?>
					</form>
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
				
				for ($i = 0; $i < count($rows); $i++) {
					$similarProduct = new product($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6]);
					
										
				?>
						
					<div class="col-md-4">
						<img src="img/<?php echo $similarProduct->getImg(); ?>" alt="">
						<div class="caption">
							<h3><?php echo $similarProduct->getName(); ?></h3>
							<p><?php echo $similarProduct->getDescription(); ?></p>
						</div>
						<form method="POST" action="basket.php">
							<button type="submit" name='itemId' value='<?php echo $similarProduct->getId(); ?>' class="btn btn-default left-margin"><i class="fa fa-eye"></i> <b> View </b> </button>	
						</form>
					</div>

			<?php
				}
			}
			?>
			</div>
		</div>
	</div>
</body>
</html>