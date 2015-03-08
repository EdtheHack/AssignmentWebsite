<nav role="navigation" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse"
				data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a href="index.php" class="navbar-brand"> eShop </a>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php"><i class="fa fa-home"></i> Home </a></li>
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
					
					<?php if(isset($_SESSION['loggedIn']) == true){ //IF A USER IS LOGGED IN SHOW THESE UI FEATURES
						$fn = $_SESSION["firstName"];
						
						//PHP INJECT HTML TO THE PAGE
						echo"<li class=\"dropdown\"><a data-toggle=\"dropdown\"
						class=\"dropdown-toggle\" href=\"#\"><i class=\"fa fa-wrench\"></i> " .$fn ."'s   
						 Account <b class=\"caret\"></b></a>
						<ul role=\"menu\" class=\"dropdown-menu\">
						<li><a href=\"#\">Orders</a></li>
						<li><a href=\"changePassword.php\">Change Password</a></li>
						<li><a href=\"editDetails.php\">Change Details</a></li>
						<li><a href=\"#\">Basket</a></li>
						</ul></li> 
					
						
						<ul class=\"nav navbar-nav navbar-right\"><li><a href=\"?logout\" ><i class=\"fa fa-sign-out\"></i> <b> Logout </b></a></li></ul>";	
						
						
						if(isset($_GET['logout'])){
							$_SESSION["loggedIn"] = false;
							unset($_SESSION);
							session_destroy();
							echo "<script type=\"text/javascript\">document.location.href=\"index.php\";</script>"; //dirty stinking refresh 
						}
					}else{
						echo"<li><a href=\"login-page.php\"><i class=\"fa fa-sign-in\"></i> <b> Login </b></a></li>"; //if a user is not logged in show the login button
						
					}
					
					?>
				
			</ul>
		</div>
	</div>
</nav>