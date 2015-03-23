<?php	
	foreach ($rows as $row) {
		$product = new product ($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
?> 
	<div class="col-md-4">
		 <?php include ("includes/block-item.php"); ?> 
	</div>			
<?php
	}
?>