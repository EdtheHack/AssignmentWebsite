<?php
	include ("product.php");
	include ("itemFunctions.php");		
?>

<div class="col-md-3">
	<div class="well">
		<h3>Just added</h3>
		
		<?php
		for ($i = 0; $i < 3; $i++) {
			$row = getNewestItem($i);
			
			$product = new product($row[1], $row[2], $row[3]);
			$serialized = serialize($product);
			
			echo"
			<div class=\"row\">
				<br>
				<div class=\"thumbnail\">
					<img src=\"http://placehold.it/320x150\" alt=\"\">
					<div class=\"caption\">
						<h4 class=\"pull-right\">".$product->getPrice()."</h4>
						<h4>
							<a href=\"#\">".$product->getName()."</a>
						</h4>
						<p>".$product->getDescription()."</p>
					</div>
					<div>
						<form method=\"POST\" action=\"viewProduct.php\">
							<button type=\"submit\" name='product' value='$serialized' class='btn btn-default left-margin'><i class=\"fa fa-eye\"></i> <b> View </b> </button>	
						</form>
						<button type=\"submit\" class=\"btn btn-default pull-right\">
							<i class=\"fa fa-shopping-cart fa-1x\"></i> <b> Add </b>
						</button>
					</div>
				</div>
			</div>";
		
			if(isset($_POST['viewProduct'])){
				$_SESSION["serializedProduct"] = serialize($product);
				$_SESSION["name"] = $this->getName();
				echo "<script type=\"text/javascript\">document.location.href=\"viewProduct.php\";</script>";
			}
		}
		?>
	</div>
</div>