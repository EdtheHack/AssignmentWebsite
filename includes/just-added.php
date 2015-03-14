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

			if($rows[$i][5] == 3){
				$percent = $rows[$i][4];
				$price = $rows[$i][1];
				
				$price = $percent * $price - $price; 
			}else{
				$price = $rows[$i][1];
			}
			
			$product = new product($rows[$i][0], $price, $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][6]);
			
		?>
		
			<div class="row">
				<br>
				<div class="thumbnail">
					<img src="img/<?php echo $product->getImg(); ?>" alt="">
					<div class="caption">
						<h4 class="pull-right"><?php echo "&pound;".round($product->getPrice(), 2); ?></h4>
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