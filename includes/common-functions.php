<?php

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

function connect() { // code reuse for cdatabase connection
	include ($_SERVER ['DOCUMENT_ROOT'] . '/dbconn.php');
	$db_con;
	return $db_con;
}

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


function getNewestItem($itemNumber){  //potentially redundant?
	$mysqli = connect ();

	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product ORDER BY price DESC" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
	   	while($stmt->fetch()){
     		$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6,  $col7,  $col8 );
    	}
		$stmt->close ();
	}
	$mysqli->close ();
	return $rows[$itemNumber];
}

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

function getSimilarItems($productId){  //NEEDS WORK
	$mysqli = connect ();
	
		$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product.* FROM product LEFT JOIN product_categories ON product.product_id = product_categories.product_id   
									WHERE product_categories.category_id = (SELECT category_id FROM product_categories WHERE product_id=?) LIMIT 3" )) {
		$stmt->bind_param ("s", $productId);
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

function getAllSearchItems($searchItem){  //NEEDS WORK
	$mysqli = connect ();
	
		$rows = array();
		$searchItem = '%'.$searchItem.'%';
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE UPPER (name) LIKE UPPER (?) OR UPPER (description) LIKE UPPER (?)")) {
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

function getSearchItems($searchItem, $pageIndex){  //NEEDS WORK
	$mysqli = connect ();
	
		//$pageBounds = $pageIndex + 5;
		$rows = array();
		$searchItem = '%'.$searchItem.'%';
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product WHERE UPPER (name) LIKE UPPER (?) OR UPPER (description) LIKE UPPER (?) LIMIT ?, 5")) {
		$stmt->bind_param ("sss", $searchItem, $searchItem, $pageIndex);
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
	
function getCurrentOrderProducts($orderId){
	$mysqli = connect ();
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT product.* FROM `product` LEFT JOIN order_contents ON product.product_id = order_contents.product_id   
									WHERE order_contents.order_id=?" )){ 
		$stmt->bind_param ("i", $orderId);
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

function getProductQuantities($currentOrderId){
	$mysqli = connect ();
	
	echo "ID".$currentOrderId;
	
	$rows = array();
	
	$stmt = $mysqli->prepare ("SELECT quantity FROM order_contents WHERE order_id=?" );
		
	if ($stmt === false) {
		trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($mysqli)), E_USER_ERROR);
	}
	
		$stmt->bind_param ("i", $orderId);
		//$stmt->execute ();

		if(!($stmt->execute ())){
			die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		}
		
		$stmt->bind_result($quantity);
		
	   	while($stmt->fetch()) {
			array_push($rows, $quantity);
			echo "QUANTITY - >".$quantity;
    	}
		$stmt->close ();
	
	$mysqli->close ();
	
	
	
	return $rows;
}

function addOrderProductToDb($orderId, $productId, $quantity){
	$mysqli = connect ();
	
	$rows = array();
	
	if ($stmt = $mysqli->prepare ("SELECT quantity FROM order_contents WHERE order_id=? AND product_id=?;")){ 
		$stmt->bind_param ("ii", $orderId, $productId);
		$stmt->execute ();
		$stmt->bind_result($result);
		$stmt->fetch();
		$stmt->close ();
	}
	
	if ($result == null) {
		if ($stmt = $mysqli->prepare ("INSERT INTO order_contents (order_id, product_id, quantity) VALUES (?,?,?);")){ 
			$stmt->bind_param ("ssi", $orderId, $productId, $quantity);
			$stmt->execute ();
			$stmt->close ();
		}
		
	} else {
		if ($stmt = $mysqli->prepare ("UPDATE order_contents SET quantity=('".$result."' + '".$quantity."') WHERE order_id=? AND product_id=?")){ 
			$stmt->bind_param ("ii", $orderId, $productId);
			$stmt->execute ();
			$stmt->close ();
		}
	}
	
	$mysqli->close ();
}

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

/*

function getAllProducts(){
	
	$mysqli = connect ();

	$products = array();
	
	if ($stmt = $mysqli->prepare ("SELECT * FROM product" )) {
		$stmt->execute ();
		$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6 );
	   	while($stmt->fetch()){
     		$products[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6 );
    	}
		$stmt->close ();
	}
	$mysqli->close ();
	
	return $products[];
}
*/

?>