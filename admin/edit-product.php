<?php
session_start ();

include ("../includes/sanitation.php");

$row = getItem ($_POST['itemId']);
$product = new product ( $row [0], $row [1], $row [2], $row [3], $row[4], $row[5], $row[6] );
$_SESSION['product'] = serialize($product);


echo $row [1];

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
<title>Add Product - Web Programming Assignment 2</title>
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
include (".nav.php");
?>
<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="jumbotron">
					<h2>
						Add Product <small> Add a new product to the site for sale.</small>
					</h2>
					<p></p>
				</div>
			</div>
    <?php
				include ("admin-nav.php");
				?>
    <div class="col-md-9">
				<form method="POST" action="">
					<div class="form-group">
							<label for="newProductName">Product Name</label> <input
								type="text" class="form-control" name="newProductName"
								placeholder="Enter product name" <?php if(!empty($_POST["newProductName"])){ echo " value='".$_POST["newProductName"]."'"; }?>>
					</div>
					<div class="form-group">
							<label for="newProductPrice">Price (£)</label> <input
								type="number" class="form-control" size="20"
								id="newProductPRice" placeholder="Enter product price">
					</div>

					<div class="form-group">
							<label for="newProductDiscount">Select discount (optional):</label>
							<select class="form-control" id="newProductDiscount">
								<option>0</option>
                                <option>5</option>
								<option>10</option>
								<option>15</option>
								<option>20</option>
								<option>25</option>
								<option>40</option>
								<option>50</option>
								<option>75</option>
							</select>
					</div>


					<div class="form-group">
						<label for="productDescription">Description</label>
						<textarea class="form-control" rows="5" id="newProductDescription"></textarea>
					</div>
                    
					<div class="form-group">
						<label for="newProductImage">Product Imaget</label> <input
							type="file" id="newProductImage">
						<p class="help-block">Please upload an image of the product here.</p>
					</div>

					<div class="checkbox">
						<label> <input type="checkbox"> List product immediately
						</label>
					</div>
					<button type="submit" name="newProduct" class="btn btn-default">Add Product</button>
				</form>
				
				<?php 
				
				if(isset($_POST['newProduct'])){
					
					echo "echo me something please";
					
					$name = $_POST['newProductName'];
					$name = sanitiseString($name, $name, 1, 100);
					echo name;
					
				}
			
				
				?>
				
			</div>
		</div>
	</div>
</body>
</html>