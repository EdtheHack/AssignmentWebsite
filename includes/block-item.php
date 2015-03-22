<?php
	$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
	$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
	
	$cutOff = 75;
	$des = $product->getDescription();
	$des = (strlen($des) > $cutOff) ? substr($des,0,$cutOff).'...<a href="viewProduct.php?'.$product->getId().'">read more</a>' : $des;
?>

<div class="thumbnail">
	<a href="view-product.php?<?php echo $product->getId(); ?>">
		<img src="img/<?php echo $product->getImg(); ?>" alt="Image of one of our recently added products." height="150" width="auto">
	</a>
	<div class="caption">
		<h4>
			<a href="view-product.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a>
		</h4>
		<p> <?php echo $des ?></p>
		
		<h5 class=""><?php echo "<strong> Our Price: &pound;".$salePrice."</strong><br>
											RRP: <strike>&pound;".$product->getPrice() ."</strike><br>
											You Save: <em>&pound;".$salePriceTmp." (".$product->getPercentage()."&#37;)</em><br>"?></h5> <!-- PLEASE IGNORE HTML ERRORS -->
		<a href="view-product.php?<?php echo $product->getId(); ?>"><button type="submit" class="btn btn-default "><i class="fa fa-eye "></i> <b> View </b> </button></a>				
	</div>
</div>