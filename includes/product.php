<?php	
	class product{	   //Product object
		private $id;
		private $name;
		private $price;
		private $description;
		
		public function __construct($id, $name, $price, $description){
			$this->id = $id;
			$this->name = $name;
			$this->price = $price;
			$this->description = $description;
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function getPrice(){
			return $this->round(price, 2);
		}
		
		public function getDescription(){
			return $this->description;
		}
		
		public function getId(){
			return $this->id;
		}
	}
	?>