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
	<?php include ("includes/nav.php"); ?>
	<div class="container">
	<!--Include the biggest deals sidebar -->	
	<?php include ("includes/biggest-deals.php")?>
		<div class="col-md-9">
			<div class="row">
				<div class="jumbotron">
					<div id="carousel-example-generic" class="carousel slide"
						data-ride="carousel">
						
						<!-- Indicators for slider-->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						</ol>
						
						<!-- Slider Images -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="banner/banner1.png" alt="Image slider 1." style="width:735px;height:515px">
							</div>
							<div class="item">
								<img src="banner/banner2.png" alt="Image slider 2." style="width:735px;height:515px">
							</div>
							<div class="item">
								<img src="banner/banner4.png" alt="Image slider 3." style="width:735px;height:515px">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="well">
					<h3>Our Newest Products</h3>
					<div class="row">
						<br>
						<!-- Include the bottom product bar-->
						<?php 
						$rows = getNewest ();
						include ("includes/product-bar.php")?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include ("includes/footer.php")?>
</body>
</html>