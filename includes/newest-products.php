<?php
include ("product.php");
?>


<div class="row">
	<div class="well">
		<h3>Our Newest Products</h3>

		<?php 
		$rows = getNewestItem();
		
		for($i = 0; $i < 3; $i++){
			
			$product = new product($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);
			$price = round($product->getPrice(), 2);
			
		}
		?> 

		<div class="row">
			<div class="well">
				<h3>Our Newest Products</h3>
				<div class="row">
					<br>
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="img/<?php echo $product->getImg(); ?>" alt="">
							<div class="caption">
								<h4 class="pull-right">PRICE</h4>
								<h4>
									<a href="#"><?php echo $product->getName(); ?></a>
								</h4>
								<p><?php echo $product->getDescription(); ?></p>
							</div>
							<div>
								<button type="submit" class="btn btn-default">
									<i class="fa fa-eye"></i> <b> View </b>
								</button>
								<button type="submit" class="btn btn-default pull-right">
									<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
								</button>
							</div>
						</div>
					</div>