<?php

$error_array = array();

if(isset($_POST['newProduct'])){

	$name = $_POST['newProductName'];
	$price = $_POST['newProductPrice'];
	$discount = $_POST['newProductDiscount'];
	$description = $_POST['newProductDescription'];
		
	if($name != null){
		if(sanitiseString($name, 1, 100) != 1){  //not cleared
			$error_array[] = "Name field has illegial chars or is too short/long";
		}else{
			echo $name;
		}
	}else{
		$error_array[] = "Product Name field cannot be empty";
	}
		
	if($price != null){
		if(sanitiseCurrency($price) != 1){  //not cleared
			$error_array[] = "price field has illegial chars or is too short/long";
		}else{
			echo $price;
		}
	}else{
		$error_array[] = "Price field cannot be empty";
	}
		
	if(sanitiseSelection($discount) != 1){
		$error_array[] = "You shouldn't be doing this";
	}else{
		echo $discount;
	}
		
		
	if($description != null){
		if(sanitiseString($description, 20, 1500) != 1){  //not cleared
			$error_array[] = "Name field has illegial chars or is too short/long, the description must be between 20 and 1500 chars";
		}else{
			echo $description;
		}
	}else{
		$error_array[] = "product description field cannot be empty";
	}
		
		
	if(isset($_POST['newProductList'])){
		$list = $_POST['newProductList'];
		$list = true;
	}else{
		$list = false;#default value
	}
		

	if(!(empty($error_array))){  //check for an none emprty error array (meaning the array has errors and something bad has happened)
		$error = implode("<br>", $error_array);
		echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in nice BS
		die; //wrong input, do not proceed
	}else{
		$status = productStatus($list);	
	 	addToDB($name, $price, $description, $discount, $status, $img); //everything was fine so carry on and add product
	}
		
	}
		

	function productStatus($list){
		
		if($list == false){  //product not listed
			$status = 2;
		}else if($list == true && $discount == 0){  //listed but is not a sale item
			$status = 0;
		}else if ($list == true && $discount != 0){ //listed and is a sale item
			$status = 1;			
		}else{
			echo "contact admin";
		}
	}
	
	function addToDB($name, $price, $description, $discount, $status, $img){
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		
		$mysqli = $db_con;
		
		$img = "test icles";
		
		if ($stmt = $mysqli->prepare ( "INSERT INTO product (name, price, description, percentage_off, status, img) VALUES (?,?,?,?,?,?)" )) {
			$stmt->bind_param ( "sisiis", $name, $price, $description, $discount, $status, $img);
			$stmt->execute ();
			$stmt->close ();
		}
		
		$mysqli->close ();
	}
?>