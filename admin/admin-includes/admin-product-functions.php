<?php

include ("../includes/sanitisation.php");

/*
 ========================
   FORM POST FUNCTION
 ========================
*/

$error_array = array(); //collection of errors 

if(isset($_POST['newProduct'])){

	$name = $_POST['newProductName'];
	$price = $_POST['newProductPrice'];
	$discount = $_POST['newProductDiscount'];
	$description = $_POST['newProductDescription'];
	$listProduct = $_POST['listProduct'];
	$stock = $_POST['newStockQuantity'];
		
	if($name != null){
		if(sanitiseString($name, 1, 100) != 1){  //not cleared
			$error_array[] = "Name field has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Product Name field cannot be empty";
	}
		
	if($price != null){
		if(sanitiseCurrency($price) != 1){  //not cleared
			$error_array[] = "price field has illegial chars or is too short/long";
		}
	}else{
		$error_array[] = "Price field cannot be empty";
	}
		
	if(sanitiseSelection($discount) != 1){
		$error_array[] = "You shouldn't be doing this";
	}else
		
	if($description != null){
		if(sanitiseString($description, 20, 1500) != 1){  //not cleared
			$error_array[] = "Name field has illegial chars or is too short/long, the description must be between 20 and 1500 chars";
		}
	}else{
		$error_array[] = "product description field cannot be empty";
	}
	
	
	if($stock != null){
		if(sanitiseInteger($stock) != 1){
			$error_array[] = "Stock can only be a Interger.";
		}
	}else{
		$error_array[] = "You must enter 0 or more and cannot be empty";
	}
	
	
	if(!empty($_POST['categories'])){
		$categories = array();
		foreach($_POST['categories'] as $selected){ //for every selected check box add to an array which can be later used 
			$categories[] = $selected;
		}
	}else{
		$categories = array(); //empty array to protect varis
	}
	
	if(sanitiseListProduct($listProduct) == 1){
		if($listProduct == 1 && $discount == 0){
			$error_array[] = "You cannot list the product as a sale item without having a discount value";
		}else{
			$status = $listProduct; //just for names sake lets rename this
		}
	}else{
		$error_array[] = "You should not be inputing anything here";
	}
	
	if(!(empty($error_array))){  //check for an none emprty error array (meaning the array has errors and something bad has happened)
		$error = implode("<br>", $error_array);
		echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in nice BS
		die; //wrong input, do not proceed
	}else{
		if($edit == false){ //adding new not editing current
			if(isset($_FILES['photo'])){ //if no errors have oocured now lets check the file upload (prevents uploading even when errors occur)
				$output = uploadPhoto();  
			
				if(is_array($output)){  //check to see if the ouput from function is an array, if it is an array then errors have occured
					$error_array = array_merge($error_array, $output); //merge errors to the error array
					$img = ""; //just to clear intilisation messages
				}else{
					$img = $output;  //if it's not a error then it can only be the file location of the picture which needs to be added to the db
				}
		}else{
			$error_array[] = "No image selected"; //image wasnt selected in the firm place
		}
		}else{ //editing products nott adding new ones
			if(isset($_FILES['photo'])){ //if no errors have oocured and a file has been uploaded do this (NOTE: USER DOES NOT HAVE TO ADD A PHOTO WHEN EDITING A PRODUCT)
				$output = uploadPhoto();
					
				if(is_array($output)){  //check to see if the ouput from function is an array, if it is an array then errors have occured
					$error_array = array_merge($error_array, $output); //merge errors to the error array
					$img = ""; //just to clear intilisation messages
				}else{
					$img = $output;  //if it's not a error then it can only be the file location of the picture which needs to be added to the db
				}
			}else{	
				$img = $product->getImg(); //no new image was uploaded to just add the old img string back to the db for simplicity 
			}
		}
		
		//check to see if errors have occured after the picture upload and print them to the screen
		if(!(empty($error_array))){  //check for an none emprty error array (meaning the array has errors and something bad has happened)
			$error = implode("<br>", $error_array);
			echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>"; //print and show in nice BS
			die; //wrong input, do not proceed
		}else{ //if all errors are clear then carry on 
			if($edit == false){ //adding new files not editing current
				if(productCheck($name) == 1){	
					$date_added = date('Y/m/d');
	 				addToDB($name, $price, $description, $discount, $status, $img, $categories, $stock, $date_added); //everything was fine so carry on and add product
				}else{
					echo "<script> $('#print_errors').bs_alert('Product already exits!', 'ERROR'); </script>";
				}
			}else{//editing current files so run the following functions
				updateProduct($name, $price, $description, $discount, $status, $img, $categories, $stock, $pageId);
				
			}
		}
	}
}
	
/*	
	========================
		 CORE FUNCTIONS
	========================
	- productCheck: Checks for existing products in the DB
	- updateProduct: updates all variables even if they are not changed as the sql handles it
	- updateCategories: changes the products associated category in the database
	- addToDB: Adds the product to the database if all checks are passed
	- addProductCategories: If the DB Add is a success then the new product will have associated categories added to it in this function 
	- uploadPhoto: Handles the uploading of the files entered by the Admin and checks for the file input
	- completedProductAdd: Only happens once everything has been added sucessfully, shows modal to confirm 	
*/

	

	function productCheck($name){ //this is a basic product check and could do with adding the search funcitonality to it
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		
		$mysqli = $db_con;
		
		if ($stmt = $mysqli->prepare ("SELECT name FROM product" )) {
			$stmt->execute ();
			$stmt->bind_result ( $col0 );
			while($stmt->fetch()){
				if (strcasecmp($col0, $name) == 0) {
					return 0;  //name already exits in the db therefore same product entered
				}
			}
			return 1; //no products matched, must be a new product
			$stmt->close ();
		}
		$mysqli->close ();
	}
	
	function updateProduct($name, $price, $description, $discount, $status, $img, $categories, $stock, $pageId){
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
		$mysqli = $db_con;
	
		$stmt = $mysqli->prepare ( "UPDATE product SET name=?, price=?, description=?, percentage_off=?, status=?, img=?, stock=? WHERE product_id=?" );
		
			
		if ($stmt === false) {
			trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
		}
		
		$stmt->bind_param ("sdsiisii", $name, $price, $description, $discount, $status, $img, $stock, $pageId);
			
		if(!($stmt->execute ())){
			die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
	
		$product_id = mysqli_insert_id($mysqli); //get the PK ID from the entr
		$stmt->close ();
		$mysqli->close ();
	
		updateProductCategories($product_id, $categories); //add the related categories to the product_categories table
		//product ID comes from the entery and Categories get passed into this function and then transfered to the next
	
	}
	
	
	function updateProductCategories ($product_id, $categories){
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
	
		$mysqli = $db_con; //just for names sake
	
		$close = false; //initilise
	
		foreach ($categories as $value){ //for every checkbox selected set to value
				
			$stmt = $mysqli->prepare ( "UPDATE product_categories SET category_id=? WHERE product_id=?" );
			$stmt->bind_param ("ii", $value, $product_id);
				
			if ($stmt === false) {
				trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
			}
				
			if(!($stmt->execute ())){
				die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
			}
				
			$close = true;
		}
	
	
		if($close){
			$stmt->close ();
		}
	
		$mysqli->close ();
	
		completedProductAdd();
	}
	
	
	
	function addToDB($name, $price, $description, $discount, $status, $img, $categories, $stock, $date_added){
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		
		$mysqli = $db_con;
		
		$stmt = $mysqli->prepare ( "INSERT INTO product (name, price, description, percentage_off, status, img, stock, date_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?)" );
		$stmt->bind_param ("sdsiisis", $name, $price, $description, $discount, $status, $img, $stock, $date_added);
			
		if ($stmt === false) {
			trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
		}
			
		if(!($stmt->execute ())){
		   die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
		
		$product_id = mysqli_insert_id($mysqli); //get the PK ID from the entry 
		$stmt->close ();
		$mysqli->close ();
		
		addProductCategories($product_id, $categories); //add the related categories to the product_categories table
														//product ID comes from the entery and Categories get passed into this function and then transfered to the next
		
	}
	
	function addProductCategories ($product_id, $categories){ 
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		
		$mysqli = $db_con; //just for names sake 
		
		$close = false; //initilise 
		
		foreach ($categories as $value){ //for every checkbox selected set to value
			
			$stmt = $mysqli->prepare ( "INSERT INTO product_categories (product_id, category_id)VALUES (?, ?)" );
			$stmt->bind_param ("ii", $product_id, $value);
			
			if ($stmt === false) {
				trigger_error('Statement 2 failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
			}
			
			if(!($stmt->execute ())){
				die('Error: please contact a system admin, following error occured : ('. $mysqli->errno .') '. $mysqli->error);
			}
			
			$close = true;
		}
		
		
		if($close){
			$stmt->close ();
		}
		
		$mysqli->close ();
		
		completedProductAdd();
	}
	
	
	
	function uploadPhoto (){
		$errors = array();
		
		$dest = "../img/"; //where the file is going to 
		$dest_file = $dest.basename($_FILES['photo']['name']);  //get the file name
		$file_size = $_FILES['photo']['size']; //get the file size
		
		$name = $_FILES['photo']['name'];
		$ext = pathinfo($name, PATHINFO_EXTENSION); //get file extention
		
		$ext_types = array("jpeg","jpg","png", "PNG"); //file types allowed
		if(in_array($ext,$ext_types )=== false){ //check for a match 
			$errors[]="File extension is not allowed, please upload only JPEG, JPG or PNG files.";
		}
		
		if($file_size > 10000000){ //check for file size being too high
			$errors[]='File size must be 10 MB or less';
		}
		
		if(empty($errors)){ //only upload if no errors have occured
			if (is_uploaded_file($_FILES['photo']['tmp_name'])) { // check to see if the file already exists
				if(move_uploaded_file($_FILES['photo']['tmp_name'], $dest_file)) { //move file
					checkUploads();
					return $dest_file; //retrun the destination to be uploaded to the DB
				} else {
					$errors[]='Unable to upload or file already exists';
					return $errors; //error has occured to cancel and return it to be displayed
				}
			} else { 
				$errors[]='Unable to upload or file already exists, please try again';
				return $errors;
			}
		}else{
			return $errors; 
		}
	}
	
	function checkUploads(){
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		$dir = "../img/";
		$files = scandir($dir);
		
		$mysqli = $db_con;
		
		$img = array();
		
		if ($stmt = $mysqli->prepare ("SELECT img FROM product")){
			$stmt->execute ();
			$stmt->bind_result ( $col0 );
		
			while($stmt->fetch()){
				array_push($img, $col0);
			}
			$stmt->close ();
		}
		
		print_r ($img);
		$mysqli->close ();
		
		

		foreach ($files as $file){
			
			
		//$file = str_replace("../img/", "", $file); //won't let us search if we dont replace 
						
			if(in_array($file, $img )=== false){
				echo "deleting".$file;
				
				$file = "../img/".$file;
				unlink($file); //add dir back in
			}
		}
		
	}
	
	
	function completedProductAdd(){
		echo "<script type='text/javascript'>
					$(document).ready(function(){
					$('#CompletedAdd').modal('show');
					});
				</script>";
	}
	
?>