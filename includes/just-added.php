<?php
	include 'itemFunctions.php';	
	
	class product{	
		private $name;
		private $price;
		private $description;
		
		public function __construct($itemNumber){
			echo getNewestItems($itemNumber);
			echo getNewestItems($itemNumber)[1];

			$this->name = getNewestItems($itemNumber)[1];
			$this->price = getNewestItems($itemNumber)[2];
			$this->description = getNewestItems($itemNumber)[3];
		}
		
		public function getName(){
			return $name;
		}
		
		public function getPrice(){
			return $price;
		}
		
		public function getDescription(){
			return $description;
		}
	}
?>



<div class="col-md-3">
	<div class="well">
		<h3>Just added</h3>
		
		<?php
		$product1 = new product(1);
		$product2 = new product(2);
		$product3 = new product(3);
		?>
		
		<div class="row">
			<br>
			<div class="thumbnail">
				<img src="http://placehold.it/320x150" alt="">
				<div class="caption">
					<h4 class="pull-right"><?php echo $product1->getPrice();?></h4>
					<h4>
						<a href="#"><?php echo $product1->getName();?></a>
					</h4>
					<p><?php echo $product1->getDescription();?></p>
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
		<div class="row">
			<br>
			<div class="thumbnail">
				<img src="http://placehold.it/320x150" alt="">
				<div class="caption">
					<h4 class="pull-right">PRICE</h4>
					<h4>
						<a href="#">Product</a>
					</h4>
					<p>DESCRIPTION</p>
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
		<div class="row">
			<br>
			<div class="thumbnail">
				<img src="http://placehold.it/320x150" alt="">
				<div class="caption">
					<h4 class="pull-right">PRICE</h4>
					<h4>
						<a href="#">Product</a>
					</h4>
					<p>DESCRIPTION</p>
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
	</div>
</div>