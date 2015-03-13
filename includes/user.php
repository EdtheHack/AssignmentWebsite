<?php	
	class user{	   //User object
		private $id;
		private $name;
		private $currentOrderId;
		private $admin;
		
		public function __construct($id, $name, $currentOrderId, $admin){
			$this->id = $id;
			$this->name = $name;
			$this->currentOrderId = $currentOrderId;
			$this->admin = $admin;
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function getAdmin(){
			return $this->admin;
		}
		
		public function getCurrentOrderId(){
			return $this->currentOrderId;
		}
		
		public function getId(){
			return $this->id;
		}
	}
	?>