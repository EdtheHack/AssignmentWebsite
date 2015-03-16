<?php	
	include ("includes/product.php");

	class order{	   //Order object
		private $id;
		private $products = array();
		private $confirmed;
		
		public function __construct($id, $products, $confirmed){	
			$this->id = $id;
			for ($i = 0; $i < count($products); $i++) {
				$product = new product($products[$i][0], $products[$i][1], $products[$i][2], $products[$i][3], $products[$i][4], $products[$i][5], $products[$i][6], $products[$i][7], $products[$i][8]);
				$this->products[$i] = $product;
			}
			$this->confirmed =$confirmed;
		}
		
		public function getProducts(){
			return $this->products;
		}
		
		public function getAmountOfProducts(){
			return count($this->products);
		}
		
		public function getTotalPrice(){
			$total = 0;
			foreach ($this->products as $product) {
				$total = $total + $product->getPrice();
			}
			return $total;
		}
		
		public function addProduct($product){
			array_push($this->products, $product);
			addOrderProductToDb($this->id, $product->getId(), 1);
		}
		
		public function removeProduct($remiveId){
			for ($i = 0; $i < count($products); $i++) {
				if ($this->products[$i]->getId() == $removeId){
					array_splice($this->products, $i, 1);
					continue;
				}			
			}
			removeOrderProductFromDb($this->id, $product->getId(), 1);
		}
			
		public function getConfirmed(){
			return $this->confirmed;
		}
		
		public function getId(){
			return $this->id;
		}
	}
	?>