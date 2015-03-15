<div class="row">
	<div class="well">
		<h3>Our Newest Products</h3>
		<div class="row">
			<br>

			<?php
				$rows = getNewest ();
					
				for($i = 0; $i < 3; $i ++) {
					
					$product = new product ($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);
				
			?> 
				<div class="col-md-4">
					<div class="thumbnail">
					<img src="img/<?php echo $product->getImg(); ?>" alt="">
						<div class="caption">
							<h4 class="pull-right">£<?php echo $product->getPrice(); ?></h4>
							<h4><a href="#"><?php echo $product->getName(); ?></a></h4>
							<p><?php echo $product->getDescription(); ?></p>
						</div>
						<div>
							<a href="viewProduct.php?<?php echo $product->getId(); ?>"><button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> <b> View </b></button></a>
							<button type="submit" class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b></button>
						</div>
					</div>
				</div>
								
			<?php
				}
			?>
					
				
		
		</div>
	</div>
</div>
