<?php	
	require_once "include/product.php";

	class order{	   //Order object
		private $id;
		private $products;
		private $confirmed;
		private $total;
		
		public function __construct($id, $products, $confirmed, $total){
			$this->id = $id;
			$this->products = $products;
			$this->confirmed =$confirmed;
			$this->total = $total;			
		}
		
		public function getProduct($productId){
			return $this->products[$productId];
		}
		
		public function getTotal(){
			return $this->total;
		}
		
		public function getConfirmed(){
			return $this->confirmed;
		}
		
		public function getId(){
			return $this->id;
		}
	}
	?>