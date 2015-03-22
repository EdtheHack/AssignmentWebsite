<?php 
	//$user = unserialize($_SESSION["user"]);
	$products = $user->getOrder()->getProducts();
	$rows = getOtherCustomersBought($user->getCurrentOrderId(), $products[0]->getId());
?>
<div class="row">
	<div class="well">
		<h4>You Have <?php echo $products[0]->getName();?></h4>
		<h3>Other Customers also Bought</h3>
		<div class="row">
			<br>

			<?php	
				foreach ($rows as $row) {
					
					$product = new product ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
					
					$cutOff = 75;
					$des = $product->getDescription();
					$des = (strlen($des) > $cutOff) ? substr($des,0,$cutOff).'...<a href="viewProduct.php?'.$product->getId().'">read more</a>' : $des;
				
			?> 
				<div class="col-md-4">
					<div class="thumbnail">
                    <a href="viewProduct.php?<?php echo $product->getId(); ?>">
					<img src="img/<?php echo $product->getImg(); ?>" alt="Image of a product" height="150" width="auto">
                    </a>
						<div class="caption">
							<h4 class="pull-right">£<?php echo $product->getPrice(); ?></h4>
							<h4><a href="viewProduct.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a></h4>
							<p><?php echo $des ?></p>
						</div>
						<div>
							<a href="viewProduct.php?<?php echo $product->getId(); ?>"><button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> <b> View </b></button></a>
						</div>
					</div>
				</div>
								
			<?php
				}
			?>
		</div>
	</div>
</div>