<?php
	include ("itemFunctions.php");	
	
	class product{	
		private $name;
		private $price;
		private $description;
		
		public function __construct($itemNumber){
			$row = getNewestItems($itemNumber);
			
			$this->name = $row[1];
			$this->price = $row[2];
			$this->description = $row[3];
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function getPrice(){
			return $this->price;
		}
		
		public function getDescription(){
			return $this->description;
		}
		
		public function html(){
			echo"
		<div class=\"row\">
			<br>
			<div class=\"thumbnail\">
				<img src=\"http://placehold.it/320x150\" alt=\"\">
				<div class=\"caption\">
					<h4 class=\"pull-right\">".$this->price."</h4>
					<h4>
						<a href=\"#\">".$this->name."</a>
					</h4>
					<p>".$this->description."</p>
				</div>
				<div>
					<form method=\"POST\" action=\"\">
						<button type=\"submit\" name=\"viewProduct\" class=\"btn btn-default\">
							<i class=\"fa fa-eye\"></i> <b> View </b>
						</button>
						<button type=\"submit\" class=\"btn btn-default pull-right\">
							<i class=\"fa fa-shopping-cart fa-1x\"></i> <b> Add </b>
						</button>
					</form>
				</div>
			</div>
		</div>";
		}
		
	}
	
	if(isset($_POST['viewProduct'])){
		$_POST['serializedProduct'] = serialize($this);
		echo "<script type=\"text/javascript\">document.location.href=\"viewProduct.php\";</script>";
	}
?>

<div class="col-md-3">
	<div class="well">
		<h3>Just added</h3>
		
		<?php
		$product1 = new product(0);
		$product1->html();
		$product2 = new product(1);
		$product2->html();
		$product3 = new product(2);
		$product3->html();
		?>
	</div>
</div>