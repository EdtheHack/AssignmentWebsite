<?php	
	class user{	   //User object
		private $id;
		private $name;
		private $admin;
		
		public function __construct($id, $name, $admin){
			$this->id = $id;
			$this->name = $name;
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function getAdmin(){
			return $this->admin;
		}
		
		public function getId(){
			return $this->id;
		}
	}
	?>