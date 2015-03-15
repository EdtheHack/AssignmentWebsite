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

				
				$product = new product($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6]);
				
				$price = round($product->getPrice(), 2);
				$percent = $product->getPercentage();
				
				$sale_price_tmp = $price * $percent / 100;
				$sale_price = $price - $sale_price_tmp;
		?>
		
			<div class="row">
				<br>
				<div class="thumbnail">
					<img src="img/<?php echo $product->getImg(); ?>" alt="">
					<div class="caption">
						<h5 class="pull-right"><?php echo "Price: <strong>&pound;".$sale_price."</strong><br></h5>
															<h6 class=\"pull-right\">RRP: <strike>&pound;".$price ."</strike><br>
															You Save: <em>&pound;".$sale_price_tmp."</em>"?></h6> <!-- PLEASE IGNORE HTML ERRORS -->
						<h4>
							<a href="#"><?php echo $product->getName(); ?></a>
						</h4>
						<p> <?php echo $product->getDescription(); ?></p>
						
						<!--<div class="col-md-6">-->
							<form method="POST" action="viewProduct.php">
								<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default left-margin"><i class="fa fa-eye"></i> <b> View </b> </button>	
							</form>
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
		
				if(isset($_POST['viewProduct'])){   //serialization does not work
					$_SESSION["serializedProduct"] = serialize($product);
					$_SESSION["name"] = $this->getName();
					echo "<script type=\"text/javascript\">document.location.href=\"viewProduct.php\";</script>";
				}

		}
		?>
	</div>
</div>