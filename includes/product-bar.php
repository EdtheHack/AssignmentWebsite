<?php	
	foreach ($rows as $row) {
		$product = new product ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
		
		$cutOff = 75;
		$des = $product->getDescription();
		$des = (strlen($des) > $cutOff) ? substr($des,0,$cutOff).'...<a href="view-product.php?'.$product->getId().'">read more</a>' : $des;
?> 
	<div class="col-md-4">
		<div class="thumbnail"> 
			<a href="view-product.php?<?php echo $product->getId(); ?>"> <img src="img/<?php echo $product->getImg(); ?>" alt="Image of one of our products" style="width:150px;height:150px"> </a>
			<div class="caption">
				<h4><a href="view-product.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a></h4>
				<p><?php echo $des ?></p>
			</div>
			<div> 
				<span class="pull-right"><a href="view-product.php?<?php echo $product->getId(); ?>"> <button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> <b>View</b></button></a></span>
			</div>
			<h5><?php if ($product->getPercentage() == 0){
				echo "<strong> &pound;".$product->getPrice()."</strong>";
			} else {
				$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
				$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
				echo "<strike>&pound;".$product->getPrice()."</strike>  ".$product->getPercentage()."% off! <br> <strong> Our Price: &pound;".$salePrice."</strong> <br>";
			} ?></h5>
		</div>  
	</div>			
<?php
	}
?>