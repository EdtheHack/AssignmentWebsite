<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>jQuery UI Spinner functionality</title>
      <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	  <script src="/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
  
  <style type="text/css">
	#prodQtySpinner input {width: 100px}
	</style>
  <script>
  
  $(function() {
   $( "#prodQtySpinner" ).spinner({
		//icons:{down:"ui-icon-arrowthickstop-1-s" , up:"ui-icon-arrowthickstop-1-n"}
		//incremental:false
		min: 1,
		max: "<?php echo $product->getStock(); ?>"
		}); 
	})
	
</script>
<body>
<div id="test">
	<input type=text" id="prodQtySpinner" value="1"/>
</div>
</body>
</html>