<?php

	include ("includes/databaseValidation.php");

	if(isset($_SESSION['loggedIn']) && $_SESSION["stayLoggedIn"] == true){
			echo "<script>window.location.replace(index.php)</script>";
	}
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
	<nav role="navigation" class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" data-target="#navbarCollapse"
					data-toggle="collapse" class="navbar-toggle">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand"> eShop </a>
			</div>
			<div id="navbarCollapse" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#"><i class="fa fa-home"></i> Home </a></li>
					<li><a href="#"> Products </a></li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">
						<i class="fa fa-search"></i>
					</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><i class="fa fa-shopping-cart fa-1x"></i> Basket <b>0</b></a></li>
					<li class="dropdown"><a data-toggle="dropdown"
						class="dropdown-toggle" href="#"><i class="fa fa-wrench"></i> Your
							Account <b class="caret"></b></a>
						<ul role="menu" class="dropdown-menu">
							<li><a href="#">Orders</a></li>
							<li><a href="#">Change Password</a></li>
							<li><a href="#">Change Details</a></li>
							<li><a href="#">Basket</a></li>
						</ul></li>
					<li><a href="login.php"><i class="fa fa-sign-in"></i> <b> Login </b></a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="well">
					<h3>Just added</h3>
					<div class="row">
						<br>
						<div class="thumbnail">
							<img src="http://placehold.it/320x150" alt="">
							<div class="caption">
								<h4 class="pull-right">PRICE</h4>
								<h4>
									<a href="#">Product</a>
								</h4>
								<p>DESCRIPTION</p>
							</div>
							<div>
								<button type="submit" class="btn btn-default">
									<i class="fa fa-eye"></i> <b> View </b>
								</button>
								<button type="submit" class="btn btn-default pull-right">
									<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
								</button>
							</div>
						</div>
					</div>
					<div class="row">
						<br>
						<div class="thumbnail">
							<img src="http://placehold.it/320x150" alt="">
							<div class="caption">
								<h4 class="pull-right">PRICE</h4>
								<h4>
									<a href="#">Product</a>
								</h4>
								<p>DESCRIPTION</p>
							</div>
							<div>
								<button type="submit" class="btn btn-default">
									<i class="fa fa-eye"></i> <b> View </b>
								</button>
								<button type="submit" class="btn btn-default pull-right">
									<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
								</button>
							</div>
						</div>
					</div>
					<div class="row">
						<br>
						<div class="thumbnail">
							<img src="http://placehold.it/320x150" alt="">
							<div class="caption">
								<h4 class="pull-right">PRICE</h4>
								<h4>
									<a href="#">Product</a>
								</h4>
								<p>DESCRIPTION</p>
							</div>
							<div>
								<button type="submit" class="btn btn-default">
									<i class="fa fa-eye"></i> <b> View </b>
								</button>
								<button type="submit" class="btn btn-default pull-right">
									<i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>



			<div class="col-md-9">
				<div class="well">
					
					<h3>Sign in</h3>
					<br>
					<form method="POST" action="">
						<div class="form-group">
							<input type="email" name="email" class="form-control"
								placeholder="Email"
								<?php if(!empty($_POST["email"])){ echo " value='".$_POST["email"]."'"; }?>>
								
							<br> <input type="password" name="password" class="form-control"
							placeholder="Password"
								<?php if(!empty($_POST["password"])){ echo " value='".$_POST["password"]."'"; }?>>
						
							<br>
								<p id="p1" style="float: left" ><input type="checkbox" name="stayLoggedIn"> Remember Me</p>		
								<p style="float: right"> <input type="submit" name="attemptLogin" class="btn btn-default" value="Login"> <a href ="resetPassword.php"><input class="btn btn-default" value="Forgotten Password"></a></p>
	
						</div>
                        <br>
						<button type="submit" name="attemptLogin"  class="btn btn-default">
							<i class="fa fa-sign-in"></i> <b> Login </b>
						</button>
					</form>
					
					<?php
					include ("includes/login.php");
					?>
                    </div>
                   

				</div>
			</div>
		</div>
	</div>
	</div>
</body>
</html>