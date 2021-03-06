<?php
session_start ();
  
include '../includes/user-validation.php';
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
<title>Admin Home - Web Programming Assignment 2</title>
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
	<?php include ("nav.php"); ?>
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="jumbotron">
				<h2> Hi <?php echo $user->getName()?>. <small>  Add, edit, and remove products, plus much more.</small> </h2>
				<p></p>
			</div>
		</div>
	<?php include ("admin-nav.php"); ?>
    <div class="col-md-9">
		<div class="page-header">
			<h1>Statistics <small>At a glance..</small></h1>
		</div>
				<div class="row">
					<div class="row placeholders">
						<div class="col-xs-6 col-sm-3 placeholder"> <img src="http://placehold.it/200x150" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4 class="text-center"><?php echo getNoOfSearchItems("");?></h4>
							<p class="text-muted text-center">Number of products listed.</p>
						</div>
						<div class="col-xs-6 col-sm-3 placeholder"> <img src="http://placehold.it/200x150" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4 class="text-center"><?php echo getNoOfCustomers("");?></h4>
							<p class="text-muted text-center">Number of customer accounts opened.</p>
						</div>
						<div class="col-xs-6 col-sm-3 placeholder"> <img src="http://placehold.it/200x150" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4 class="text-center"><?php echo getNoOfUnlistedItems();?></h4>
							<p class="text-muted text-center">Number of products unlisted.</p>
						</div>
						<div class="col-xs-6 col-sm-3 placeholder"> <img src="http://placehold.it/200x150" class="img-responsive" alt="Generic placeholder thumbnail">
							<h4 class="text-center"><?php echo getNoOfOutOfStockItems();?></h4>
							<p class="text-muted text-center">Number of products out of stock</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include ("../includes/footer.php")?>
</body>
</html>