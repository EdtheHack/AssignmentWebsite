<?php	
	class order{	   //Order object
		private $id;
		private $products = array();
		private $confirmed;
		
		public function __construct($id, $products, $confirmed){
		
			$this->id = $id;
			for ($i = 0; $i < count($products); $i++) {
				$this->products[$i] = new product($products[$i][0], $products[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][6]);
			}
			$this->confirmed =$confirmed;
		}
		
		public function getProducts(){
			return $this->products;
		}
		
		public function addProduct(){
			return $this->products;
		}
		
		
		public function getConfirmed(){
			return $this->confirmed;
		}
		
		public function getId(){
			return $this->id;
		}
	}
	?>