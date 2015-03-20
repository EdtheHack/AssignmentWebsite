<?php
session_start ();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>All Products - Web Programming Assignment 2</title>
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
		<?php include ("includes/just-added.php");?>
		<div class="col-md-9">
			<div class="well">
				<h3>All Products</h3>
				<?php
				if(isset($_GET['deals'])){
					$rows = getDealProducts();
				} else {
					$rows = getAllProducts();
				}			
	    		
	    		$count = 0;
				
				for($i = 0; $i < count($rows); $i++) {
				
				$product = new product ($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);

				$length = 65;
				$cut_off = 65;
				$des = $product->getDescription();
				$des = (strlen($des) > $length) ? substr($des,0,$cut_off).'...<a href="viewProduct.php?'.$product->getId().'">read more</a>' : $des;

				?>
				<div class="col-md-4">
					<div class="thumbnail"> 
						<h5 class="pull-right"><?php if ($product->getPercentage() == 0){
							echo "<strong> &pound;".$product->getPrice()."</strong>";
						} else {
							$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
							$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
							echo "<strong> Our Price: &pound;".$salePrice."</strong> RRP: <strike>&pound;".$product->getPrice() ."</strike><br>";
						} ?> </h5>
						<a href="viewProduct.php?<?php echo $product->getId(); ?>"> <img src="img/<?php echo $product->getImg(); ?>" alt="Image of one of our products" style="width:150px;height:150px"> </a>
						<div class="caption">
							<h4><a href="viewProduct.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a></h4>
							<p><?php echo $des ?></p>
						</div>
						<div> 
							<a href="viewProduct.php?<?php echo $product->getId(); ?>"> <button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> <b> View </b></button></a>
						</div>
					</div>  
				</div>
				<?php
				} 
				?>
			</div>
		</div>
	</div>
</body>
</html>