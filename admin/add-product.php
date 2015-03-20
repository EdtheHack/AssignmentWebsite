<?php
session_start ();

include ("../includes/sanitation.php");

include ("../includes/common-functions.php");

if (($_SESSION["loggedIn"] == true) && checkAdmin() == 1){
	if (($_SESSION["loggedIn"] == true) && ($_SESSION["adminChecked"] == true)){
			
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"confirm-admin.php\";</script>";
	}
}else{
	echo "<script type=\"text/javascript\">document.location.href=\"../index.php\";</script>";
}

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
 
<!-- <style>
 .borderless tbody tr td, .borderless tbody tr th, .borderless thead tr th {
    border: none;
}
 
 </style> -->

</head>
<body>
<?php
include ("nav.php");
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
				<br>
				<div id="print_errors"></div>
				<br>
				<form method="POST" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label for="newProductName">Product Name</label> <input
							type="text" class="form-control" name="newProductName"
							placeholder="Enter product name"
							<?php if(!empty($_POST["newProductName"])){ echo " value='".$_POST["newProductName"]."'"; }?>>
					</div>
					<div class="form-group col-md-6">
						<label for="newProductPrice">Price (£)</label> <input type="text"
							class="form-control" size="20" id="newProductPRice"
							name="newProductPrice" placeholder="Enter product price"
							<?php if(!empty($_POST["newProductPrice"])){ echo " value='".$_POST["newProductPrice"]."'"; }?>>
					</div>
					<div class="form-group col-md-6">
						<label for="newProductDiscount">Select discount (optional):</label>
						<select class="form-control" name="newProductDiscount"
							id="newProductDiscount"
							<?php if(!empty($_POST["newProductDiscount"])){ echo " value='".$_POST["newProductDiscount"]."'"; }?>>
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
						<script type="text/javascript">
  								document.getElementById('newProductDiscount').value = "<?php echo $_POST['newProductDiscount'];?>";
							</script>
					</div>
					<div class="form-group">
						<label for="productDescription">Description</label>
						<textarea class="form-control" rows="5"
							name="newProductDescription"><?php if(!empty($_POST["newProductDescription"])){ echo "".$_POST["newProductDescription"].""; }?>
</textarea>
					</div>
					<div class="form-group">
						<hr>
						<label for="productCategories">Associated Product Categories</label>
						<div class="table-responsive">
							<table class="table borderless">
								<tbody>
									<tr>
          <?php
			include ($_SERVER ['DOCUMENT_ROOT'] . '/dbconn.php');
																			
				if ($stmt = $db_con->prepare ( "SELECT category_id, name FROM categories ORDER BY category_id ASC" )) {
					$stmt->execute ();
					$stmt->bind_result ($category_id, $category_name );
					$tr_count = 0;
					while ( $stmt->fetch () ) {
																			
					if ($tr_count == 5) {
					echo '</tr>';
					echo '<tr>';
					$tr_count = 0;
				}
																					
				echo ' <td><div class="checkbox"><label><input type="checkbox" name="categories[]" value="' . $category_id . '"/>' . $category_name . '</label></div</td>' . "";
																					
				$tr_count ++;
			}
			$stmt->close ();
		}
		$db_con->close ();
		?>
               
								
								
								
								
								
								</tbody>
							</table>
						</div>
						<hr>
					</div>
					<div class="form-group">
						<label for="newProductImage">Product Image</label> <br> <input
							type="file" name="photo">
						<p class="help-block">Please upload an image of the product here.</p>
						<hr>
					</div>
					<div class="form-group">
						<label for="newStockQuantity">Stock</label> <input type="text"
							class="form-control" size="20" id="newStockQuantity"
							name="newStockQuantity" placeholder="Enter Stock Quantity" value="0"
							<?php if(!empty($_POST["newStockQuantity"])){ echo " value='".$_POST["newStockQuantity"]."'"; }?>>
					</div>
					<div class="form-group">
						<label for="listProduct">Product Visibility Settings:</label> <select
							class="form-control" name="listProduct" id="listProduct"
							<?php if(!empty($_POST["listProduct"])){ echo " value='".$_POST["listProduct"]."'"; }?>>
							<option value="0">List Product (Not on sale)</option>
							<option value="1">List Product (On sale)</option>
							<option value="2">Save but do not list the product</option>
						</select>
					</div>
					<script type="text/javascript">
  								document.getElementById('listProduct').value = "<?php echo $_POST['listProduct'];?>";
							</script>
					<button type="submit" name="newProduct" class="btn btn-default">Add Product</button>
				</form>
				<br> <br> <br>
       <?php
       
       	$edit = false; //edit is false as we're adding a product not editing
       
		include ("admin-includes/admin-product-functions.php");
		?>
		
		    </div>
            </div>
      </div> <!-- CONTAINER DIV -->
            
            
            <div class="modal fade" id="CompletedAdd" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"
                                          aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                    </button>
                              <h4 class="modal-title" id="myModalLabel">Product Added Successfully</h4>
                        </div>
                        <div class="modal-body">The product has now been added to the product catalogue, add another or go back to Admin Home
                        </div>
                        <div class="modal-footer">
                              <button type="button" class="btn btn-default" onClick="location.href='add-product.php'" VALUE="Refresh">Add Another</button>
                              <button type="button" class="btn btn-default" onClick="location.href='index.php'" >Admin Home</button>
                        </div>
                  </div>
              </div>
            </div>
            


</body>
</html>
		