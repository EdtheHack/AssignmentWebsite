<?php	
	
include ($_SERVER['DOCUMENT_ROOT'] . '/assignment2/includes/order.php');
//PLEASE DO NOT CHANGE THE ABOVE LINE, THESE ABSOLUTE FILE LOCATION IS NOT IDEAL I KNOW
//BUT IT IS TH ENLY WAY TO ENSURE THAT EVERY FILE IS CAPABALE OF REACHING THIS AS AND INCLUDE DUE TO OUR FILE STRUCTURE

//THANK YOU



	class user{	   //User object
		private $id;
		private $name;
		private $currentOrderId;
		private $admin;
		private $order;
		private $addr1;
		private $addr2;
		private $postcode;
		private $home;
		private $mobile;
		private $blocked;
		private $email;
		
		public function __construct($id, $name, $currentOrderId, $admin){
			$this->id = $id;
			$this->name = $name;
			$this->currentOrderId = $currentOrderId;
			$this->admin = $admin;
			$this->order = new order($currentOrderId, getCurrentOrderProducts($currentOrderId), 0);
		}

		public function additionalConstruct($email, $addr1, $addr2, $postcode, $mNo, $hNo, $blocked){
			$this->email = $email;
			$this->addr1 = $addr1;
			$this->addr2 = $addr2;
			$this->postcode = $postcode;
			$this->mobile = $mNo;
			$this->home = $hNo;
			$this->blocked = $blocked;
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

		public function getEmail(){
			return $this->email;
		}
		function getAddr1(){
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