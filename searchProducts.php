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
	} else {
		$rows = getSearchItems($_SESSION['searchItem'], (($currentPage-1)*5));
	}
	$pages = ceil((count($rows))/5);  //rounds up
	?>
	  
	<div class="col-md-9">
		<div class="well">
			<div class="row">
				<div class="col-md-9">
					<h4><?php if(isset($_GET['category'])){echo "'".$_GET['category'];} else {echo "'".$_SESSION['searchItem']; }echo "' - ".count($rows)." Items";?></h4>
				</div>
				<div class="col-md-3">
					<h4><?php echo "Page ".$currentPage;?></h4>
				</div>
			</div>
		</div>
		
	<?php		
		foreach ($rows as $row) {
		$product = new product($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
		$salePriceTmp = number_format(($product->getPrice() * $product->getPercentage() / 100), 2, '.', '');
		$salePrice =  number_format(($product->getPrice() - $salePriceTmp), 2, '.', '');
	?>
		
		<div class="well">
			<div class="row">
				<div class="col-md-3">
                <a href="viewProduct.php?<?php echo $product->getId(); ?>">
					<img src="includes/<?php echo $product->getImg(); ?>" alt="Image of a product found from your search query" height="150" width="auto">
                    </a>
				</div>
				<div class="col-md-9">
					<h5 class="pull-right"><?php if ($product->getPercentage() == 0){
						echo "<strong> &pound;".$product->getPrice()."</strong>";
					} else {
						echo "<strong> Our Price: &pound;".$salePrice."</strong> RRP: <strike>&pound;".$product->getPrice() ."</strike><br>";
					} ?> </h5> <!-- PLEASE IGNORE HTML ERRORS -->
					<h4><a href="viewProduct.php?<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></a></h4>
					<p> <?php echo $product->getDescription(); ?></p>
					<a href="viewProduct.php?<?php echo $product->getId(); ?>"><button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default right-margin"><i class="fa fa-eye"></i> <b> View </b> </button></a>	
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
				$prevPage = $currentPage-1;
				$nextPage = $currentPage+1;
				if ($currentPage > 1) {
					echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$prevPage'>&laquo;</a> </li>"; 
				}
				for ($i = 1; $i <= $pages; $i++) {
					echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$i'>".$i."</a> </li>"; 
				}
				if ($currentPage < $pages) {
					echo " <li><a href='{$_SERVER['PHP_SELF']}?currentPage=$nextPage'>&raquo;</a> </li>";
				}
			?>
			<!-- <li><a href="#">&raquo;</a></li> -->
		</ul>
	</div>
    </div>
	</body>
</html>