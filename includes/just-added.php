<?php
	include ("product.php");
	//include ("common-functions.php");		
	//include ("itemFunctions.php");
	?>

<div class="col-md-3">
	<div class="well">
		<h3>Biggest Deals</h3>
		
		<?php	
			
		$rows = getMostDiscounted();
		
		for ($i = 0; $i < 3; $i++) {  //loop through most discounted items	
				
				$product = new product($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);
				
				$price = round($product->getPrice(), 2);
				$percent = $product->getPercentage();
				
				$sale_price_tmp = round($price * $percent / 100, 2);
				$sale_price =  round($price - $sale_price_tmp, 2);
		?>
		
			<div class="row">
				<br>
				<div class="thumbnail">
					<img src="img/<?php echo $product->getImg(); ?>" alt="">
					<div class="caption">
						<h4>
							<a href="#"><?php echo $product->getName(); ?></a>
						</h4>
						<p> <?php echo $product->getDescription(); ?></p>
						
						<h5 class=""><?php echo "<strong> Our Price: &pound;".$sale_price."</strong><br>
															RRP: <strike>&pound;".$price ."</strike><br>
															You Save: <em>&pound;".$sale_price_tmp." (".$percent."&#37;)</em><br>"?></h5> <!-- PLEASE IGNORE HTML ERRORS -->
						<!--<div class="col-md-6">
							<form method="POST" action="viewProduct.php">-->
								<a href="viewProduct.php?<?php echo $product->getId(); ?>"><button type="submit" class="btn btn-default "><i class="fa fa-eye "></i> <b> View </b> </button></a>
							
						<!-- </div>
						<div class="col-md-6">
							<form method="POST" action="viewBasket.php">  
								<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b> </button>	
							</form>
						</div> -->
					</div>
				</div>
			</div>
		
		<?php
		
			//	if(isset($_GET['viewProduct'])){   //serialization does not work
				//	$_SESSION["serializedProduct"] = serialize($product);
				//	$_SESSION["name"] = $this->getName();
				//	echo "<script type=\"text/javascript\">document.location.href=\"viewProduct.php\";</script>";
			//	}

		}
		?>
	</div>
</div>