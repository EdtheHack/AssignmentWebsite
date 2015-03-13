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
						Add Product <small> Add a new product to the site for sale.</small>
					</h2>
					<br>
					<p></p>
				</div>
			</div>
    <?php
				include ("admin-nav.php");
				?>
    <div class="col-md-9">
    			<br>
    			<div id="print_errors"></div> 
    			<br>
    			
    			
    									
				<!-- <form action="" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="newProductImage">Product Image</label> 
						<input type="file" name="photo">
						<p class="help-block">Please upload an image of the product here.</p>
						<button type="submit" name="newProduct" class="btn btn-default">Upload Image</button>
					</div>
				</form>-->
	
    			
				<form method="POST" action="" enctype="multipart/form-data">
				
				
				  <select multiple  id="e19">
				      <option value="January">January</option>
				      <option value="February">February</option>
				      <option value="March">March</option>
				      <option value="April">April</option>
				      <option value="May">May</option>
				      <option value="June">June</option>
				      <option value="July">July</option>
				      <option value="August">August</option>
				      <option value="September">September</option>
				      <option value="October">October</option>
				      <option value="November">November</option>
				      <option value="December">December</option>
				</select>
				
				
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
						<textarea class="form-control" rows="5" name="newProductDescription"><?php if(!empty($_POST["newProductDescription"])){ echo "".$_POST["newProductDescription"].""; }?></textarea>
					</div>
                    
                    <div class="form-group">
						<label for="newProductImage">Product Image</label> 
						<input type="file" name="photo">
						<p class="help-block">Please upload an image of the product here.</p>
					</div>
					
					
						<div class="checkbox">
							<label> <input type="checkbox" name="newProductList" value="true"> List product immediately
							</label>
						</div>
						<button type="submit" name="newProduct" class="btn btn-default">Add Product</button>
					
					</form>
					<br>
					<br>
					<br>
				
				
				
				<?php 
				
				include ("../includes/add-product-functions.php");
				?>
				
			</div>
		</div>
	</div>
											 

	
</body>
</html>