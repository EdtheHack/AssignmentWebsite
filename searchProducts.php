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
		<?php  include ("includes/nav.php"); ?>

		<div class="container"> 
		
			<?php 
			include ("includes/just-added.php"); 
			
			if(isset($_GET['currentPage'])){$currentPage = $_GET['currentPage'];}
			if(isset($_GET['category'])){
				$rows = getCategoryItems($_GET['category'], (($currentPage-1)*5));
				$noOfItems = getNoOfCategoryItems($_GET['category']);
				unset($_SESSION['searchItem']);
			} else {
				$rows = getSearchItems($_SESSION['searchItem'], (($currentPage-1)*5));
				$noOfItems = getNoOfSearchItems($_SESSION['searchItem']);
			}
			
			$pages = ceil(($noOfItems)/5);  //rounds up
			?>
			  
			<div class="col-md-9">
				<div class="well">
					<div class="row">
						<div class="col-md-9">
							<h4><?php if(isset($_GET['category'])){echo "'".$_GET['category'];} else {echo "'".$_SESSION['searchItem']; }echo "' - ".$noOfItems." Items";?></h4>
						</div>		
						<div class="col-md-3">
							<h4><?php echo "Page ".$currentPage;?></h4>
						</div>
					</div>
					<div class="row" align="center">
						<h4><?php include ("includes/search-pagination.php");?></h4>
					</div>
				</div>
				
			<?php		
				foreach ($rows as $row) {
					$product = new product($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
					include ("includes/horizontal-item.php");
				}
				include ("includes/search-pagination.php");
			?>
			
				
			</div>
		</div>
	</body>
</html>