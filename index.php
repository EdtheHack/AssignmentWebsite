<?php
session_start ();
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
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>
					
					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="img/man_looking.jpg" alt="Image of one of our recently added products." height="300" width="735">
							<div class="carousel-caption">Slide 1</div>
						</div>
						<div class="item">
							<img src="img/onlooking.jpg" alt="Image of one of our recently added products." height="300" width="auto">
							<div class="carousel-caption">Slide 2</div>
						</div>
                        <div class="item">
							<img src="img/big_ben.jpg" alt="Image of one of our recently added products." height="300" width="auto">
							<div class="carousel-caption">Slide 3</div>
						</div>
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
			</div>
		</div>
    <?php include ("includes/newest-products.php")?>
		</div>
	</div>
	</div>
</body>
</html>