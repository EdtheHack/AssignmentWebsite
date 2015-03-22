<div class="well">
	<div class="row">
		<div class="col-md-3">
		<a href="view-product.php?<?php echo $product->getId(); ?>">
			<img src="includes/<?php echo $product->getImg(); ?>" alt="Image of a product found from your search query" height="150" width="150">
			</a>
		</div>
		<div class="col-md-9">
			<h5 class="pull-right"><?php if ($product->getPercentage() == 0){
				echo "<strong> &pound;".$product->getPrice()."</strong>";
			} else {
				$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
				$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
				echo "<strong> Our Price: &pound;".$salePrice."</strong> RRP: <strike>&pound;".$product->getPrice() ."</strike><br>";
			} ?> </h5> <!-- PLEASE IGNORE HTML ERRORS -->
			<h4><a href="view-product.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a></h4>
			<p> <?php echo $product->getDescription(); ?></p>
			<a href="view-product.php?<?php echo $product->getId(); ?>"><button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default right-margin"><i class="fa fa-eye"></i> <b> View </b> </button></a>	
		</div>
		<br>
	</div>
</div>
<br>