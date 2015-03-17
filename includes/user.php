<?php	
	include ("../includes/order.php");

	class user{	   //User object
		private $id;
		private $name;
		private $currentOrderId;
		private $admin;
		private $order;
		private $firstname;
		private $lastname;
		private $addr1;
		private $addr2;
		private $postcode;
		private $home;
		private $mobile;
		private $blocked;
		
		public function __construct($id, $name, $currentOrderId, $admin){
			$this->id = $id;
			$this->name = $name;
			$this->currentOrderId = $currentOrderId;
			$this->admin = $admin;
			$this->order = new order($currentOrderId, getCurrentOrderProducts($currentOrderId), 0);
		}

		public function __construct($id, $first_name, $second_name, $addr1, $addr1, $postcode, $mNo, $hNo, $blocked, $admin){
			$this->id = $id;
			$this->firstname = $first_name;
			$this->secondname = $second_name;
			$this->addr1 = $addr1;
			$this->addr2 = $addr2;
			$this->postcode = $postcode;
			$this->mobile = $mNo;
			$this->home = $hNo;
			$this->blocked = $blocked;
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
		
		public function getOrder(){
			return $this->order;
		}
		
		public function getId(){
			return $this->id;
		}

		public function getFirstName(){
			return $this->firstname;
		}

		public function getSecondName(){
			return $this->secondname;
		}
		public function getAddr1(){
			return $this->addr1;
		}		
		public function getAddr2(){
			return $this->addr2;
		}
		public function getPostcode(){
			return $this->postcode;
		}
		public function getMobile(){
			return $this->mobile;
		}
		public function getHome(){
			return $this->home;
		}
		public function getBlocked(){
			return $this->blocked;
		}	
	}
	?>