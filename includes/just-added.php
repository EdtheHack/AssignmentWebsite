<div class="col-md-3">
	<div class="well">
		<h3>Biggest Deals</h3>
		<br>
		<?php	
			
		$rows = getMostDiscounted();
		
		for ($i = 0; $i < 3; $i++) {  //loop through most discounted items	
				
				$product = new product($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);
				
				$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
				$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
				
				$length = 75;
				$cut_off = 75;
				$des = $product->getDescription();
				$des = (strlen($des) > $length) ? substr($des,0,$cut_off).'...<a href="viewProduct.php?'.$product->getId().'">read more</a>' : $des;
				
		?>	
			<div class="row">
				<div class="thumbnail">
                	<a href="viewProduct.php?<?php echo $product->getId(); ?>">
					<img src="img/<?php echo $product->getImg(); ?>" alt="Image of one of our recently added products." height="150" width="auto">
                    </a>
					<div class="caption">
						<h4>
							<a href="viewProduct.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a>
						</h4>
						<p> <?php echo $des //$product->getDescription(); ?></p>
						
						<h5 class=""><?php echo "<strong> Our Price: &pound;".$salePrice."</strong><br>
															RRP: <strike>&pound;".$product->getPrice() ."</strike><br>
															You Save: <em>&pound;".$salePriceTmp." (".$product->getPercentage()."&#37;)</em><br>"?></h5> <!-- PLEASE IGNORE HTML ERRORS -->
						<a href="viewProduct.php?<?php echo $product->getId(); ?>"><button type="submit" class="btn btn-default "><i class="fa fa-eye "></i> <b> View </b> </button></a>				
					</div>
				</div>
			</div>
		
		<?php
		}
		?>
	</div>
</div>