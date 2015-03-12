<?php	
	class product{	   //Product object
		private $id;
		private $name;
		private $price;
		private $description;
		private $reduced_price;
		private $img;
		
		public function __construct($id, $name, $price, $description, $reduced_price, $img){
			$this->id = $id;
			$this->name = $name;
			$this->price = round($price, 2);
			$this->description = $description;
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
		
		public function getId(){
			return $this->id;
		}
		
		public function getReducedPrice(){
			return $this->reduced_price;
		}
		
		public function getImg(){
			return $this->img;
		}
	}
	?>