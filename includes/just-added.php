<?php
	include ("itemFunctions.php");	
	include ("product.php");

?>

<div class="col-md-3">
	<div class="well">
		<h3>Just added</h3>
		
		<?php
		$product1 = new product(0);
		$product1->html();
		$product2 = new product(1);
		$product2->html();
		$product3 = new product(2);
		$product3->html();
		?>
	</div>
</div>