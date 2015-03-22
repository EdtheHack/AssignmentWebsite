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
			<?php if(isset($basketItem)){
				echo "<h4>".$user->getOrder()->getQuantity($count)." x ".$product->getName();</a>."</h4>";
			} else {
				echo "<h4><a href=\"view-product.php?".$product->getId().">".$product->getName()."</a></h4>";
			}
			?>
			<p> <?php echo $product->getDescription(); ?></p>
			<div class="col-md-6">
				<a href="view-product.php?<?php echo $product->getId(); ?>"><button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default right-margin"><i class="fa fa-eye"></i> <b> View </b> </button></a>	
			</div>
			<?php if(isset($basketItem)){ 
			echo 
			"<div class=\"col-md-6\">
				<form method=\"POST\" action=\"view-basket.php\">
					<button type=\"submit\" name=\"removeItemId\" value=".$product->getId()." class=\"btn btn-default left-margin\"><i class=\"fa fa-eye\"></i> <b> Remove </b> </button>	
				</form>
			</div>";
			}
			?>
		</div>
		<br>
	</div>
</div>
<br>