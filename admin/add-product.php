<?php
session_start ();

include ("../includes/sanitation.php");

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
include ("../includes/nav.php");
?>
<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="jumbotron">
					<h2>
						Add Product<small> Add a new product to the site for sale.</small>
					</h2>
					<br>
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
								placeholder="Enter product name" 
								<?php if(!empty($_POST["newProductName"])){ echo " value='".$_POST["newProductName"]."'"; }?>>
					</div>
					<div class="form-group">
							<label for="newProductPrice">Price (£)</label> <input
								type="text" class="form-control" size="20"
								id="newProductPRice" name="newProductPrice" placeholder="Enter product price"
								 <?php if(!empty($_POST["newProductPrice"])){ echo " value='".$_POST["newProductPrice"]."'"; }?>>
					</div>

					<div class="form-group">
							<label for="newProductDiscount">Select discount (optional):</label>
							<select class="form-control" name="newProductDiscount"  <?php if(!empty($_POST["newProductDiscount"])){ echo " value='".$_POST["newProductDiscount"]."'"; }?>>
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
						<textarea class="form-control" rows="5" name="newProductDescription"></textarea>
					</div>
                    
					<div class="form-group">
						<label for="newProductImage">Product Image</label> <input
							type="file" id="newProductImage">
						<p class="help-block">Please upload an image of the product here.</p>
					</div>

					<div class="checkbox">
						<label> <input type="checkbox" name="newProductList" value="list"> List product immediately
						</label>
					</div>
					<button type="submit" name="newProduct" class="btn btn-default">Add Product</button>
				</form>
				
				<div id="print_errors"></div> 
				
				<?php 
				
				$error_array = array();
				
				if(isset($_POST['newProduct'])){
										
					$name = $_POST['newProductName'];
					$price = $_POST['newProductPrice'];
					$discount = $_POST['newProductDiscount'];
					$description = $_POST['newProductDescription'];
					$list = $_POST['newProductList'];
					
					
					
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
					

					if($list == 'list'){
						$list == true;
						echo "checked";
					}else{
						$list == false;
						echo "not checked ";
					}
					
					
					$error = implode("<br>", $error_array);
					echo "<script> $('#print_errors').bs_alert('$error', 'ERROR'); </script>";
					
					
				}
			
				
				?>
				
			</div>
		</div>
	</div>
											 
<script type="text/javascript"> //needs reference here please 
                (function($){
                    $.fn.extend({
                        bs_alert: function(message, title){
                            var cls='alert-danger';
                            var html='<div class="alert '+cls+' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                            if(typeof title!=='undefined' &&  title!==''){
                             html+='<h4>'+title+'</h4>';
                      }
                     html+='<span>'+message+'</span></div>';
                     $(this).html(html);
                  }
              });
          })(jQuery);

 </script>      
	
</body>
</html>