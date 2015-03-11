<?php
	include ("product.php");
	//include ("common-functions.php");		
	//include ("itemFunctions.php");
	?>

<div class="col-md-3">
	<div class="well">
		<h3>Just added</h3>
		
		<?php
		
		//getMostDiscounted(); 
		
		//for ($i = 0; $i < 3; $i++) {  //highest price items code
			//$row = getNewestItem($i);
			//$product = new product($row[0], $row[1], $row[2], $row[3]);	
			
		$row = getMostDiscounted();
		$arr_length = count($row);  //most dicounted products code
		
		for ($i = 0; $i < $arr_length; $i++) {
			
			if ($i == 0){
				$a = 0; $b = 1; $c = 2; $d = 3;
			}else if ($i == 1){
				$a = 4; $b = 5; $c = 6; $d = 7;
			}else if ($i == 2){
				$a = 8; $b = 9; $c = 10; $d = 11;
			}else{
				echo "something has gone very wrong indeed";
			}
			
			$product = new product($row[$a], $row[$b], $row[$c] , $row[$d]);
		?>
		
			<div class="row">
				<br>
				<div class="thumbnail">
					<img src="http://placehold.it/320x150" alt="">
					<div class="caption">
						<h4 class="pull-right"><?php echo "&pound;".round($product->getPrice(), 2); ?></h4>
						<h4>
							<a href="#"><?php echo $product->getName(); ?></a>
						</h4>
						<p> <?php echo $product->getDescription(); ?></p>
						
						<div class="col-md-6">
							<form method="POST" action="viewProduct.php">
								<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default left-margin"><i class="fa fa-eye"></i> <b> View </b> </button>	
							</form>
						</div>
						<div class="col-md-6">
							<form method="POST" action="viewProduct.php">  
								<button type="submit" name='itemId' value='<?php echo $product->getId(); ?>' class="btn btn-default pull-right"><i class="fa fa-shopping-cart fa-1x"></i> <b> Add </b> </button>	
							</form>
						</div>
					</div>
					<br>
					<br>
				</div>
			</div>
		
		<?php
		
			if(isset($_POST['viewProduct'])){   //serialization does not work
				$_SESSION["serializedProduct"] = serialize($product);
				$_SESSION["name"] = $this->getName();
				echo "<script type=\"text/javascript\">document.location.href=\"viewProduct.php\";</script>";
			}
		}
		?>
	</div>
</div>