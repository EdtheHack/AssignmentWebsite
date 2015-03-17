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
				

?>
    <div class="col-md-9">
    
    <table class="table table-hover table-responsive">
   		<tbody>
		    <?php 
		    
		    $alphabet  = array();
		    $alphabet  = range('A', 'Z');
		    
		    foreach ($alphabet as $letter ){
		 		echo "<tr><a href=\"view-users.php\">".$letter."</a></tr>";
		    }
		    ?>
    	</tbody>
    </table>
				<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<th>ID</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Discount</th>
                            <th>Stock</th>
							<th>Visbility</th>
							<th>Edit</th>
							<th>Delete</th>
							
						</tr>
					</thead>
					<tbody>
		
					</tbody>
				</table>
			</div>
		</div>
			<div class="modal fade" id="cannotDel" tabindex="-1" role="dialog"
				aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						<h4 class="modal-title" id="myModalLabel">You Cannot Delete This Product</h4>
						</div>
						<div class="modal-body">It is not possible to delete this product as the product has been previously ordered, you can however prevent this product from being listed but editing it's settings</div>
						<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
				</div>
				</div>
			</div>

	
</div>
</body>
</html>