<?php	
	class product{	   //Product object
		private $id;
		private $name;
		private $price;
		private $description;
		private $percentage_off;
		private $img;
		private $status;
		
		public function __construct($id, $name, $price, $description, $percentage_off, $status, $img){
			$this->id = $id;
			$this->name = $name;
			$this->price = round($price, 2);
			$this->description = $description;
			$this->percentage_off = $percentage_off;
			$this->img = $img;
			$this->status = $status;
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
		
		public function getPercentage(){
			return $this->percentage_off;
		}
		
		public function getImg(){
			return $this->img;
		}
		
		public function getStatus(){
			return $this->status;
		}
	}
	?>