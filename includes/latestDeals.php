<?php
include ("product.php");
?>


<div class="row">
	<div class="well">
		<h3>Our Latest Deals</h3>

		<!-- CREATE PHP TO RETREIVE SQL AND LOOP ITEMS HERE -->

		<div class="row">
			<div class="well">
				<h3>Our Latest Deals</h3>
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