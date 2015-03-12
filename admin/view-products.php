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
include ("../includes/nav.php");
?>
<div class="container">
  <div class="col-md-12">
    <div class="row">
      <div class="jumbotron">
        <h2>View/Edit Products <small> A complete list of all produts, across the store.</small> </h2>
        <br>
        <p>Below is a complete list of all products.</p>
      </div>
    </div>
    <?php
include ("admin-nav.php");
?>
    <div class="col-md-9">
      <table class="table table-hover table-responsive">
       <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Product 1</td>
            <th>£0.00</th>
            <td>Edit Order</td>
            <td>Delete Order</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Product 2</td>
            <th>£0.00</th>
            <td>Edit Order</td>
            <td>Delete Order</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Product 3</td>
            <th>£0.00</th>
            <td>Edit Order</td>
            <td>Delete Order</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>