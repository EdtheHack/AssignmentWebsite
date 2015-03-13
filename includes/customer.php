<?php	
	class customer{	   //Customer object
		private $id;
		private $name;
		private $orders;
		
		public function __construct($id, $name, $orders){
			$this->id = $id;
			$this->name = $name;
			$this->orders = $orders;
		}
		
		public function getName(){
			return $this->name;
		}
		
		
		public function getId(){
			return $this->id;
		}
		
		public function getOrder($orderId){
			return $this->orders[$orderId];
		}
	}
	?>