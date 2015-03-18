<div class="col-md-3">
	<div class="well">
		<h3>Biggest Deals</h3>
		
		<?php	
			
		$rows = getMostDiscounted();
		
		for ($i = 0; $i < 3; $i++) {  //loop through most discounted items	
				
				$product = new product($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);
				
				$price = $product->getPrice();
				$percent = $product->getPercentage();
				
				//$sale_price_tmp = round($price * $percent / 100, 2);
				//$sale_price =  round($price - $sale_price_tmp, 2);			
				$sale_price_tmp = number_format(($price * $percent / 100), 2, '.', '');
				$sale_price =  number_format(($price - $sale_price_tmp), 2, '.', '');
				
				
				
				$length = 75;
				$cut_off = 75;
				$des = $product->getDescription();
				
				
				$des = (strlen($des) > $length) ? substr($des,0,$cut_off).'...<a href="viewProduct.php?'.$product->getId().'">read more</a>' : $des;
				
		?>
		
			<div class="row">
				<br>
				<div class="thumbnail">
                	<a href="viewProduct.php?<?php echo $product->getId(); ?>">
					<img src="img/<?php echo $product->getImg(); ?>" alt="Image of one of our recently added products." height="150" width="auto">
                    </a>
					<div class="caption">
						<h4>
							<a href="viewProduct.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a>
						</h4>
						<p> <?php echo $des //$product->getDescription(); ?></p>
						
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
		}
		?>
	</div>
</div>