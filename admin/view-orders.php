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
<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<th>#</th>
							<th>Customer ID</th>
							<th>Order Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Customer 1</td>
							<th>£0.00</th>
							<td>Edit Order</td>
							<td><a href"myModal" data-toggle="modal" data-target="#myModal">Delete
									Order</a></td>
						</tr>
						<tr>
							<td>2</td>
							<td>Customer 2 2</td>
							<th>£0.00</th>
							<td>Edit Order</td>
							<td>Delete Order</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Customer 3</td>
							<th>£0.00</th>
							<td>Edit Order</td>
							<td>Delete Order</td>
						</tr>
					</tbody>
				</table>
    </div>
  </div>
  
  	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
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
					<button type="button" class="btn btn-danger">Delete Order</button>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>