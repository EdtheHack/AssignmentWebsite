<?php	
	include ($_SERVER['DOCUMENT_ROOT'] . '/assignment2/includes/product.php');

	class order{	   //Order object
		private $id;
		private $products = array();
		private $quantities = array();
		private $confirmed;
		
		public function __construct($id, $products, $confirmed){	
			$this->id = $id;
			for ($i = 0; $i < count($products); $i++) {
				$product = new product($products[$i][0], $products[$i][1], $products[$i][2], $products[$i][3], $products[$i][4], $products[$i][5], $products[$i][6], $products[$i][7], $products[$i][8]);
				$this->products[$i] = $product;
				$this->quantities[$i] = $products[$i][9];
			}
			$this->confirmed =$confirmed;
		}
		
		public function getProducts(){
			return $this->products;
		}
		
		public function getQuantity($id){
			return $this->quantities[$id];
		}
		
		public function getAmountOfProducts(){
			$total = 0;
			foreach ($this->quantities as $quantity){
				$total += $quantity;
			}
			return $total;
		}
		
		public function getTotalPrice(){
			$total = 0;
			$count = 0;
			foreach ($this->products as $product) {
				if ($product->getPercentage() == 0){
					$total = $total + ($product->getPrice() * $this->quantities[$count]);
				} else {
					$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
					$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
					$total = $total + ($salePrice * $this->quantities[$count]);
				}
				$count++;
			}
			return $total;
		}
		
		public function addProduct($product, $quantity){
			$exists = false;
			$count = 0;
			foreach ($this->products as $currentProduct){
				if ($currentProduct->getId() == $product->getId()){
					addQuantityToDb($this->id, $product->getId(), $quantity, $this->quantities[$count]);
					$this->quantities[$count] = $this->quantities[$count] + $quantity;
					$exists = true;
				} 	
				$count++;
			}
			
			if ($exists == false){
					array_push($this->products, $product);
					array_push($this->quantities, $quantity);
					addOrderProductToDb($this->id, $product->getId(), $quantity);
			}	
		}
		
		public function removeProduct($removeId){
			for ($i = 0; $i < count($this->products); $i++) {
				if ($this->products[$i]->getId() == $removeId){
					array_splice($this->products, $i, 1);
					array_splice($this->quantities, $i, 1);
					continue;
				}			
			}
			removeOrderProductFromDb($this->id, $removeId, 1);
		}
			
		public function getConfirmed(){
			return $this->confirmed;
		}
		
		public function getId(){
			return $this->id;
		}
	}
	?>