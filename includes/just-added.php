<?php
	include ("itemFunctions.php");	
	include ("product.php");

?>

<div class="col-md-3">
	<div class="well">
		<h3>Just added</h3>
		
		<?php
		for ($i = 0; $i < 3; $i++) {
			$row = getNewestItem($i);
			
			$product = new product($row[1], $row[2], $row[3]);
			$product->html();
		}
		?>
	</div>
</div>