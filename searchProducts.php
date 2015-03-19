<?php
session_start();
ini_set ( 'display_errors', 1 );
ini_set ( 'display_startup_errors', 1 );
error_reporting ( - 1 );

if (isset($_POST['searchItem'])){$_SESSION['searchItem'] = $_POST['searchItem'];}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Search Results - Web Programming Assignment 2</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>
<body>
	
	<?php
		include ("includes/nav.php");
	?>
	<div class="container"> 

	  <?php include ("includes/just-added.php"); ?>
    <div class="col-md-9">
	<?php		
		$currentPage = $_GET['currentPage'];
		$rows = getSearchItems($_SESSION['searchItem'], (($currentPage-1)*5));
		$pages = ceil((getAllSearchItems($_SESSION['searchItem']))/5);  //rounds up
		echo getAllSearchItems($_SESSION['searchItem']);
		foreach ($rows as $row) {
			
		$product = new product($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
	?>
	
		<div class="well">
			<div class="row">
				<div class="col-md-3">
                <a href="viewProduct.php?<?php echo $product->getId(); ?>">
					<img src="includes/<?php echo $product->getImg(); ?>" alt="Image of a product found from your search query" height="150" width="auto">
                    </a>
				</div>
				<div class="col-md-9">
					<h4 class="pull-right">£<?php echo $product->getPrice(); ?></h4>
					<h4>
						<a href="viewProduct.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a>
					</h4>
					<p> <?php echo $product->getDescription(); ?></p>
				
					<div class="col-md-6">
						<!-- <form method="POST" action="viewProduct.php"> -->
							<a href="viewProduct.php?<?php echo $product->getId(); ?>"><button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default left-margin"><i class="fa fa-eye"></i> <b> View </b> </button></a>	
						<!--</form>-->
					</div>
					<div class="col-md-6">
						<form method="POST" action="viewProduct.php">  
						
							<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b> </button>	
						</form>
					</div>
				</div>
				<br>
			</div>
		</div>
	
	<br>
		
	<?php
		}
	?>
	
		<ul class="pagination">
			<?php 
				if ($currentPage > 1) {
					echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=".$currentPage-1 ."'>&laquo;</a> </li>"; 
				}
				for ($i = 1; $i <= $pages; $i++) {
					echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$i'>".$i."</a> </li>"; 
				}
				if ($currentPage < $pages) {
					echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=".$currentPage+1 ."'>&raquo;</a> </li>";
				}
			?>
			<!-- <li><a href="#">&raquo;</a></li> -->
		</ul>
	</div>
    </div>
	</body>
</html>