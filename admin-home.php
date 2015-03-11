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
<title>Admin - Web Programming Assignment 2</title>
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
include ("includes/nav.php");
?>
<div class="container">
  <div class="col-md-12">
    <div class="row">
      <div class="jumbotron">
        <h2> Hi, [name here pls]. <small>What would you like to do today?</small> </h2>
        <br>
        <p>Welcome to the administration pages. From here, you can add,
          edit, and remove products, plus much more.</p>
      </div>
    </div>
    <div class="col-md-2">
      <div class="row">
        <ul class="nav nav-sidebar nav-pills nav-stacked">
          <li class="active"><a href="#">Admin Home</a></li>
          <li><a href="#">View All Orders</a></li>
          <li><a href="#">Add New Product</a></li>
          <li><a href="#">Edit Existing Product</a></li>
          <li><a href="#">Remove Product</a></li>
          <li><a href="#">Edit Customer Account Details</a></li>
          <li><a href="#">Edit Your Account Details</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-1"> </div>
    <div class="col-md-9">
      <div class="page-header">
        <h1>Statistics <small>At a glance..</small></h1>
      </div>
      <div class="row">
        <div class="row placeholders">
          <div class="col-xs-6 col-sm-3 placeholder"> <img data-src="js/holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4 class="text-center">Listed Products</h4>
            <p class="text-muted text-center">Number of products listed.</p>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder"> <img data-src="js/holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4 class="text-center">Accounts</h4>
            <p class="text-muted text-center">Number of customer accounts opened.</p>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder"> <img data-src="js/holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4 class="text-center">Unlisted Products</h4>
            <p class="text-muted text-center">Number of products unlisted.</p>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder"> <img data-src="js/holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4 class="text-center">Label</h4>
            <p class="text-muted text-center">Something else</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>