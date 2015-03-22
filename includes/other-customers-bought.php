<?php 
	$rows = getOtherCustomersBought($user->getCurrentOrderId(), $user->getOrder()->getProducts()[0]->getId());
?>
<div class="row">
	<div class="well">
		<h3>You Bought <?php $user->getOrder()->getProducts()[0]->getName()?></h3>
		<h3>Other Customers also Bought</h3>
		<div class="row">
			<br>

			<?php	
				for($i = 0; $i < 3; $i ++) {
					
					$product = new product ($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);
					
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