<?php
session_start ();

/*
 * include ("includes/common-functions.php");
 *
 * if (($_SESSION["loggedIn"] == true) && checkAdmin() == 1){
 * //admin is logged in
 * }else{
 * echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
 * //FORCE USER TO LOG IN OR NOT ADMIN, IF LOGGED IN AND NOT ADMIN THEN THE LOGIN PAGE WILL SEND TO INDEX
 * //(bit scrubby)
 * }
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View/Edit Products - Web Programming Assignment 2</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet"
	href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include ("nav.php");
?>
<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="jumbotron">
					<h2>View/Edit Products <small> A complete list of all produts, across the store.</small>
					</h2>
				</div>
			</div>
  <?php
	include ("admin-nav.php");
				
	
	function getAllProducts(){
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
			
		$mysqli = $db_con;
				
		$rows = array();
		
		if ($stmt = $mysqli->prepare ("SELECT * FROM product" )) {
			$stmt->execute ();
			$stmt->bind_result ( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6, $col7, $col8 );
			while($stmt->fetch()){
				$rows[] = array( $col0,  $col1,  $col2,  $col3,  $col4,  $col5,  $col6, $col7, $col8  );
			}
			$stmt->close ();
			}
			
			$mysqli->close ();
				
			return $rows;
		}
						
?>
    <div class="col-md-9">
				<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<th>#</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Discount</th>
							<th>Visbility</th>
							<th>Edit</th>
							<th>Delete</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						
						$rows = getAllProducts();
						
							for ($i = 0; $i < count($rows); $i++) { 
							
							$product = new product($rows[$i][0], $rows[$i][1], $rows[$i][2], $rows[$i][3], $rows[$i][4], $rows[$i][5], $rows[$i][6], $rows[$i][7], $rows[$i][8]);
							
							$status = $product->getStatus();
							
							if($status == 0){
								$status = "Listed (Not on sale)";
							}else if($status == 1){
								$status = "Listed (On sale)";
							}else{
								$status = "Not Listed";
							}
						
						?>									
						<tr>
							<td><?php echo $product->getId()?></td>
							<td><?php echo $product->getName()?></td>
							<td><?php echo "&pound;".$product->getPrice()?></td>
							<td><?php echo $product->getPercentage()."&#37;"?></td>
							<td><?php echo $status;?></td>
							<td><form method="POST" action="edit-product.php">
								<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' >Edit Product</button>
							</form></td>
							<td><a href="myModal" data-toggle="modal" data-target="#myModal">Delete Product</a></td>
						</tr>
						
						<?php 
						

						if(isset($_POST['edit-product'])){   //serialization does not work
							$_SESSION["serializedProduct"] = serialize($product);
							$_SESSION["name"] = $this->getName();
							echo "<script type=\"text/javascript\">document.location.href=\"edit-product.php\";</script>";
						}
						
						
						
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	

	<!-- Modal
	
	
						<td><a href"myModal" data-toggle="modal" data-target="#myModal">Delete
									Product</a></td>
	
	
	 -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Delete Product</h4>
				</div>
				<div class="modal-body">Are you sure you want to delete this
					product? This cannot be undone.</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger">Delete Product</button>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>