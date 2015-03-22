<div class="col-md-3">
	<div class="well">
		<h3>Biggest Deals</h3>
		<br>
		<?php	
		$rows = getMostDiscounted();
		
		foreach ($rows as $row) {  //loop through most discounted items		
			$product = new product($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);	
		?>	
			<div class="row">
				<?php include ("includes/block-item.php"); ?>
			</div>
		<?php
		}
		?>
	</div>
</div>