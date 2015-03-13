<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Spinner - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="/resources/demos/external/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <style type="text/css">
	#prodQtySpinner input {width: 100px}
	</style>
  <script>
  
  $(function() {
    var spinner = $( "#prodQtySpinner" ).spinner({
		//icons:{down:"ui-icon-arrowthickstop-1-s" , up:"ui-icon-arrowthickstop-1-n"}
		//incremental:false
		min: 1
		max: 15
		}); 
	})
	
</script>
<body>
<div id="test">
	<input type=text" id="prodQtySpinner" value="1"/>
</div>
</body>
</html>
	