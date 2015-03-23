<?php
session_start ();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>All Products - Web Programming Assignment 2</title>
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
		<?php include ("includes/biggest-deals.php");?>
		<div class="col-md-9">
			<div class="well">
				<h3>All Products</h3>
				<?php
				if(isset($_GET['deals'])){
					$rows = getDealProducts();
				} else {
					$rows = getAllProducts();
				}			
	    		
				foreach ($rows as $row) {
					$product = new product ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
				?>
				<div class="col-md-4">
					<?php include ("includes/block-item.php"); ?> 
				</div>
				<?php
				} 
				?>
			</div>
		</div>
	</div>
</body>
</html>