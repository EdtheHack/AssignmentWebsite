<?php
session_start ();

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
<title>View Orders - Web Programming Assignment 2</title>
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
        <h2>View All Orders <small> A complete list of all orders placed.</small> </h2>
        <p></p>
      </div>
    </div>
    </div>
    <?php
include ("admin-nav.php");
?>
    <div class="col-md-9">
		<?php									
				include ("admin-includes/admin-order-functions.php");

				$orders = listOrders($user->getId());
				$count = 0;
						
				foreach ($orders as $order){
			?>
			<div class="row">
			<h4><?php echo "Order Id: ".$order[0]." - User Id: ".$order[1]; if($order[2] == 0){ echo " - Purchased: NO";} else { echo " - Purchased: YES - Purchase Date - ".$order[3]." 
			- <a href\"myModal\" data-toggle=\"modal\" data-target=\"#myModal".$order[0]."\">Delete Order</a>";}?></h4>
				<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<th>Product</th>
							<th>Description</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$products = getOrderProducts($order[0]);
						
						foreach ($products as $product){
					?>
						<tr>
							<td><?php echo $product[1]?></td>
							<td><?php echo $product[3]?></td>
							<td><?php echo $product[9]?></td>
						</tr>
					<?php
						}
					?>
					</tbody>
				</table>
				  	<!-- Modal -->
				<div class="modal fade" id="myModal<?php  echo $order[0];?>" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel">Delete Order</h4>
							</div>
							<div class="modal-body">Are you sure you want to delete this
								order? This cannot be undone.</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<a href="admin-includes/admin-order-functions.php?delOrder=<?php echo $order[0]; ?>" class="btn btn-danger">Delete Order</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<?php

			
			$count++;
			}
			

			?>
</div>
</body>
</html>