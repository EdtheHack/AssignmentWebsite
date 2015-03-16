<?php
session_start ();

ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Home - Web Programming Assignment 2</title>
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
  <?php include ("includes/just-added.php")?>
  <div class="col-md-9">
			<div class="row">
				<div class="jumbotron">
					<div id="carousel-example-generic" class="carousel slide"
						data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0"
								class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="http://placehold.it/735x300" alt="">
								<div class="carousel-caption">Slide 1</div>
							</div>
							<div class="item">
								<img src="http://placehold.it/735x300" alt="">
								<div class="carousel-caption">Slide 2</div>
							</div>
                            <div class="item">
								<img src="http://placehold.it/735x300" alt="">
								<div class="carousel-caption">Slide 3</div>
							</div>
							Hi hello
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic"
							role="button" data-slide="prev"> <span
							class="glyphicon glyphicon-chevron-left" aria-hidden="true"> </span>
							<span class="sr-only">Previous</span>
						</a> <a class="right carousel-control"
							href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"
							aria-hidden="true"></span> <span class="sr-only">Next</span>
						</a>
					</div>


					<!--<h2>Guaranteed next day delivery...<br><small class="pull-right">(..or your next delivery is on us!)</small></h2>
	  		<br>
	  		<br>
	  		<img src="http://placehold.it/750x200" alt="">
	  		<br>
	 		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ut mi non urna pellentesque vulputate vel nec sem. Nulla feugiat facilisis ex non finibus.</p>
	  		<p><a class="btn btn-default btn-lg" href="#" role="button">Learn more</a></p> -->
				</div>
			</div>
    <?php
				include ("includes/newest-products.php")?> // WILL FIX THIS ISSUE-LOVE WILL
    
    <!-- 
<div class="row">
      <div class="well">
        <h3>Our Latest Deals</h3>
        <div class="row"> <br>
        <div class="col-md-4">
          <div class="thumbnail"> <img src="http://placehold.it/320x150" alt="">
            <div class="caption">
              <h4 class="pull-right">PRICE</h4>
              <h4><a href="#">Product</a> </h4>
              <p>DESCRIPTION</p>
            </div>
            <div>
              <button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> <b> View </b></button>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b></button>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail"> <img src="http://placehold.it/320x150" alt="">
            <div class="caption">
              <h4 class="pull-right">PRICE</h4>
              <h4><a href="#">Product</a> </h4>
              <p>DESCRIPTION</p>
            </div>
            <div>
              <button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> <b> View </b></button>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b></button>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail"> <img src="http://placehold.it/320x150" alt="">
            <div class="caption">
              <h4 class="pull-right">PRICE</h4>
              <h4><a href="#">Product</a> </h4>
              <p>DESCRIPTION</p>
            </div>
            <div>
              <button type="submit" class="btn btn-default"><i class="fa fa-eye"></i> <b> View </b></button>
              <button type="submit" class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b></button>
            </div>
          </div>
          </div>
          </div>
        </div>
      </div>
      
      -->

		</div>
	</div>
	</div>
</body>
</html>