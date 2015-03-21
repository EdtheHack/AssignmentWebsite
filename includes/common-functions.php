<?php

// code reuse for cdatabase connection

function connect() {  
	include ($_SERVER ['DOCUMENT_ROOT'] . '/dbconn.php');
	$db_con;
	return $db_con;
}

//  gets a product based on it's id

function getPage($pageId){
	$mysqli = connect ();
	
	$rows = array();

	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE product_id=?" )) {
		$stmt->bind_param ( "i", $pageId );
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6, $col7, $col8 );
		$stmt->fetch();
		$rows = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		$stmt->close ();
	}

	$mysqli->close ();
	return $rows;

}

// out of stock items

function getNoOfOutOfStockItems(){  
	$mysqli = connect ();
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product_id FROM product WHERE stock=0")) {
		$stmt->execute ();
		$stmt->bind_result ( $procuct);
	   	while($stmt->fetch()) {
			$rows[] = array( $procuct);
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return count($rows);
}

// get number of unlisted items

function getNoOfUnlistedItems(){  
	$mysqli = connect ();
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product_id FROM product WHERE status=2")) {
		$stmt->execute ();
		$stmt->bind_result ( $procuct);
	   	while($stmt->fetch()) {
			$rows[] = array( $procuct);
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return count($rows);
}

// number of customer accounts

function getNoOfCustomers() {
	$mysqli = connect ();
		
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT user_id FROM user WHERE NOT admin=1" )){
		$stmt->execute ();
		$stmt->bind_result($account);
		while($stmt->fetch()) {
			array_push($rows, $account);
		}
		$stmt->close ();
	}
	$mysqli->close ();
	
	return count($rows);
}

// checks whether a user has admin permissions

function checkAdmin() {
	$mysqli = connect ();
	
	if ($stmt = $mysqli->prepare ( "SELECT admin FROM user WHERE user_id=?" )) {
		$user = $_SESSION ["userID"];
		$stmt->bind_param ( "s", $user );
		$stmt->execute ();
		$stmt->bind_result ( $result );
		$stmt->fetch ();
		$stmt->close ();
	}
	return $result;
	$mysqli->close ();
}

// gets the newest items based upon the time they were added to the database

function getNewest(){
	$mysqli = connect ();

	$rows = array();

	if ($stmt = $mysqli->prepare ("SELECT * FROM product ORDER BY date_added DESC" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		while($stmt->fetch()){
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		}
		$stmt->close ();
	}
	$mysqli->close ();
	return $rows;
}

// gets item with selected itemId

function getItem($productId){
	$mysqli = connect ();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE product_id=?")){
		$stmt->bind_param ( "s", $productId );
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6,  $col7,  $col8 );
		
		while($stmt->fetch()){
			$row = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8  );
		}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return $row;
}

// gets items from the same category based on one item 

function getSimilarItems($productId){  //NEEDS WORK
	$mysqli = connect ();
	
		$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product.* FROM `product` LEFT JOIN product_categories ON product.product_id = product_categories.product_id   
									WHERE product_categories.category_id=(SELECT category_id FROM product_categories WHERE product_id=?) AND NOT product_categories.product_id=? LIMIT 3" )) {
		$stmt->bind_param ("ss", $productId, $productId);
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6,  $col7,  $col8);
	   	while($stmt->fetch()) {
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8);
    	}
		$stmt->close ();
	}
	$mysqli->close ();
	
	return $rows;
}

// gets items from a selected category

function getCategoryItems($category, $pageIndex){
	$mysqli = connect ();

		$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product.* FROM `product` LEFT JOIN product_categories ON product.product_id = product_categories.product_id   
									WHERE product_categories.category_id=(SELECT category_id FROM categories WHERE name=?) AND NOT product.status=2 LIMIT ?, 5" )){
		$stmt->bind_param ("si", $category, $pageIndex);
		$stmt->execute ();
		$stmt->bind_result ($col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6,  $col7,  $col8);
	   	while($stmt->fetch()) {
			$rows[] = array($col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8);
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return $rows;
}

// gets number of returned items from a selected category

function getNoOfCategoryItems($category){
	$mysqli = connect ();

		$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product.* FROM `product` LEFT JOIN product_categories ON product.product_id = product_categories.product_id   
									WHERE product_categories.category_id=(SELECT category_id FROM categories WHERE name=?) AND NOT product.status=2" )){
		$stmt->bind_param ("s", $category);
		$stmt->execute ();
		$stmt->bind_result ($col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6,  $col7,  $col8);
	   	while($stmt->fetch()) {
			$rows[] = array($col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8);
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return count($rows);
}

// gets items with names containing the $searchItem variable

function getSearchItems($searchItem, $pageIndex){  //COULD BE SMARTER
	$mysqli = connect ();

		$rows = array();
		$searchItem = '%'.$searchItem.'%';
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE (UPPER (name) LIKE UPPER (?) OR UPPER (description) LIKE UPPER (?)) AND NOT status=2 LIMIT ?, 5")) {
		$stmt->bind_param ("ssi", $searchItem, $searchItem, $pageIndex);
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6,  $col7,  $col8);
	   	while($stmt->fetch()) {
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8);
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return $rows;
}

// returns number of items retrieved by the search

function getNoOfSearchItems($searchItem){  
	$mysqli = connect ();

		$rows = array();
		$searchItem = '%'.$searchItem.'%';
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE (UPPER (name) LIKE UPPER (?) OR UPPER (description) LIKE UPPER (?)) AND NOT status=2")) {
		$stmt->bind_param ("ss", $searchItem, $searchItem);
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6,  $col7,  $col8);
	   	while($stmt->fetch()) {
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8);
    	}
		$stmt->close ();
	}
	
	$mysqli->close ();
	return count($rows);
}

// gets the sale items and orders by highest percentage off

function getMostDiscounted(){
	$mysqli = connect ();
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE status=1 ORDER BY percentage_off DESC ")){ //get the most 
		
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2, $col3, $col4,  $col5, $col6,  $col7,  $col8 );
		while($stmt->fetch()) {
			$rows[] = array( $col0,  $col1,  $col2, $col3 , $col4,  $col5, $col6,  $col7,  $col8 );
		}
		$stmt->close ();
	}
	$mysqli->close ();	
	return $rows;
}

// get the active orderId of a user

function getCurrentUserOrderId($userId){
	$mysqli = connect ();
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT order_id FROM `order` WHERE user_id = ? AND purchased = 0")){ //get the most 
		$stmt->bind_param ( "i", $userId);
		$stmt->execute ();
		$stmt->bind_result ( $result);
		$stmt->fetch();
		$stmt->close ();
	}
	$mysqli->close ();	
	
	if(isset($result)){ 
		return $result;
	} else {
		return false;
	}
}

// add a new active order to a user in the database

function addNewUserOrder($userId){
	$mysqli = connect();
		
	echo"id - >".$userId;
		
	if ($stmt = $mysqli->prepare ("INSERT INTO `order` (`user_id`, `purchased`) VALUES (?, 0);" )){
		$stmt->bind_param("i", $userId);
			
		if ($stmt === false) {
			trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
		}
			
		if(!($stmt->execute ())){
		   die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
		$stmt->close ();
	} else {
	
	}
	$mysqli->close ();
}

// gets the products inside an order
	
function getOrderProducts($orderId){
	$mysqli = connect ();
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product.*, order_contents.quantity FROM `product` LEFT JOIN order_contents ON product.product_id = order_contents.product_id   
									WHERE order_contents.order_id=?" )){ 
		$stmt->bind_param ("i", $orderId);
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3, $col4,  $col5,  $col6,  $col7,  $col8, $col9);
	   	while($stmt->fetch()) {
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8, $col9);
    	}
		$stmt->close ();
	}
	$mysqli->close ();
	
	return $rows;
}

// gets the quantities of the products in an order

function getProductQuantities($orderId){
	$mysqli = connect ();
		
	$rows = array();
	
	$stmt = $mysqli->prepare ("SELECT quantity FROM order_contents WHERE order_id=?" );
		
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
	$stmt->bind_param ("i", $orderId);
	if(!($stmt->execute ())){
		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
	$stmt->bind_result($quantity);
		
	while($stmt->fetch()) {
		array_push($rows, $quantity);
    }
	$stmt->close ();
	$mysqli->close ();
	
	return $rows;
}

// adds a quantity to an existing order

function addQuantityToDb($orderId, $productId, $quantity, $currentQuantity){
	$mysqli = connect ();
	
	if ($stmt = $mysqli->prepare ("UPDATE order_contents SET quantity=('".$currentQuantity."' + '".$quantity."') WHERE order_id=? AND product_id=?")){ 
		$stmt->bind_param ("ii", $orderId, $productId);
		$stmt->execute ();
		$stmt->close ();
	}
	$mysqli->close ();
}

// confirm an order and remove the stock from the product

function purchaseOrder($orderId){
	$mysqli = connect ();
	$date = date('Y/m/d');
	$halt = false;
	
	if ($stmt = $mysqli->prepare ("SELECT product.name, product.stock-order_contents.quantity FROM product LEFT JOIN order_contents ON product.product_id = order_contents.product_id 
									WHERE order_contents.order_id=?")){ 
		$stmt->bind_param ("i", $orderId);
		$stmt->execute ();
		$stmt->bind_result($name, $stockLeft);
		while($stmt->fetch()) {
			if ($stockLeft < 0){
				$problem = $name;
				$halt = true;
			}
		}
		$stmt->close ();
	}
	
	if ($halt != true){
		if ($stmt = $mysqli->prepare ("UPDATE `order` SET purchased=1, date_purchased=? WHERE order_id=?")){ 
			$stmt->bind_param ("si", $date, $orderId);
			$stmt->execute ();
			$stmt->close ();
		}
		
		if ($stmt = $mysqli->prepare ("UPDATE `product` LEFT JOIN order_contents ON product.product_id = order_contents.product_id SET product.stock=product.stock-order_contents.quantity
										WHERE order_contents.order_id=?")){ 
			$stmt->bind_param ("i", $orderId);
			$stmt->execute ();
			$stmt->close ();
		}
		$mysqli->close ();
		return 1;
	} else {
		return $problem;
	}
}

// gets all the products from every purchased order from a user

function getPurchasedOrders($userId){
	$mysqli = connect ();
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT order_id, date_purchased FROM `order` WHERE user_id = ? AND purchased = 1" )){ 
		$stmt->bind_param ("i", $userId);
		$stmt->execute ();
		$stmt->bind_result ($id, $date);
	   	while($stmt->fetch()) {
			$rows[] = array($id,  $date);
    	}
		$stmt->close ();
	}
	$mysqli->close ();
	
	return $rows;
}

// adds a product to a user order in the database

function addOrderProductToDb($orderId, $productId, $quantity){
	$mysqli = connect ();

	if ($stmt = $mysqli->prepare ("INSERT INTO order_contents (order_id, product_id, quantity) VALUES (?,?,?);")){ 
		$stmt->bind_param ("ssi", $orderId, $productId, $quantity);
		$stmt->execute ();
		$stmt->close ();
	}
	$mysqli->close ();
}

// removes a product from a user order in the database

function removeOrderProductFromDb($orderId, $productId){
	$mysqli = connect ();
	
	$rows = array();
		
	if ($stmt = $mysqli->prepare ("DELETE FROM order_contents WHERE order_id=? AND product_id=?;")){ 
		$stmt->bind_param ("ii", $orderId, $productId);
		$stmt->execute ();
		$stmt->close ();
	}
	$mysqli->close ();
}

// uploads a picture to the database

function fileUploads(){
	//if they DID upload a file...
	if($_FILES['photo']['name']){
		//if no errors...
		if(!$_FILES['photo']['error']){
			//now is the time to modify the future file name and validate the file
			$new_file_name = strtolower($_FILES['photo']['tmp_name']); //rename file
			if($_FILES['photo']['size'] > (1024000)) //can't be larger than 1 MB
			{
				$valid_file = false;
				$message = 'Oops!  Your file\'s size is to large.';
			}
	
			//if the file has passed the test
			if($valid_file)
			{
				//move it to where we want it to be
				move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/'.$new_file_name);
				$message = 'Congratulations!  Your file was accepted.';
			}
		}
		//if there is an error...
		else
		{
			//set that to be the returned message
			$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
		}
	}
	
	//you get the following information for each file:
	$_FILES['field_name']['name'];
	$_FILES['field_name']['size'];
	$_FILES['field_name']['type'];
	$_FILES['field_name']['tmp_name'];	
}

// get all the products in the products table

function getAllProducts(){
	$mysqli = connect ();

	$rows = array();

	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE status=1 OR status=0" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		while($stmt->fetch()){
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		}
		$stmt->close ();
	}
	$mysqli->close ();
	return $rows;
}

// get all products on deal

function getDealProducts(){
	$mysqli = connect ();

	$rows = array();

	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE status=1" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		while($stmt->fetch()){
			$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
		}
		$stmt->close ();
	}
	$mysqli->close ();
	return $rows;
}

// lists all the categories

function getAllCategories(){
	$mysqli = connect ();

	$rows = array();

	if ($stmt = $mysqli->prepare ("SELECT * FROM categories" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0, $col1 );
		while($stmt->fetch()){
			$rows[] = array( $col0, $col1 );
		}
		$stmt->close ();
	}
	$mysqli->close ();
	return $rows;
}

?>