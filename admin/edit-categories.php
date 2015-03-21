<?php
session_start ();

include ("../includes/sanitation.php");

include ("../includes/common-functions.php");

if (($_SESSION["loggedIn"] == true) && checkAdmin() == 1){
	if (($_SESSION["loggedIn"] == true) && ($_SESSION["adminChecked"] == true)){
			
	} else {
		echo "<script type=\"text/javascript\">document.location.href=\"confirm-admin.php\";</script>";
	}
}else{
	echo "<script type=\"text/javascript\">document.location.href=\"../index.php\";</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Product - Web Programming Assignment 2</title>
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
<script type="text/javascript"> //needs reference here please 
                (function($){
                    $.fn.extend({
                        bs_alert: function(message, title){
                            var cls='alert-danger';
                            var html='<div class="alert '+cls+' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                            if(typeof title!=='undefined' &&  title!==''){
                             html+='<h4>'+title+'</h4>';
                      }
                     html+='<span>'+message+'</span></div>';
                     $(this).html(html);
                  }
              });
          })(jQuery);
 </script>


</head>
<body>
<?php
include ("nav.php");

include ("admin-includes/admin-category-functions.php");
?>
<div class="container">

		<div class="col-md-12">
			<div class="row">
				<div class="jumbotron">
					<h2>
						Edit Categories <small> Create and remove categories</small>
					</h2>
					<p></p>
				</div>
			</div>

     <?php
					include ("admin-nav.php");
					
					?>
     <div class="col-md-9">
				<br>
				<div id="print_errors"></div>
				<br>
				<ul class="nav nav-tabs" id="myTab">
					<li  class="active"><a data-toggle="tab" href="#sectionA">Create a Category</a></li>
					<li><a data-toggle="tab" href="#sectionB">Remove Categories</a></li>
				</ul>
				<div class="tab-content">
					<div id="sectionA" class="tab-pane fade in active">
						<div>
							<h3>Add a Category</h3>

							<form method="POST" action="" enctype="multipart/form-data">
								<div class="form-group">
									<label for="newProductName">Category Name</label> <input
										type="text" class="form-control" name="newCategoryName"
										placeholder="Enter category name"
										<?php if(!empty($_POST["newCategoryName"])){ echo " value='".$_POST["newCategoryName"]."'"; } ?>>
								</div>
								<button type="submit" name="newCategory" class="btn btn-default">Create Cetegory</button>
							</form>
							<br>
						</div>
					</div>
					<div id="sectionB" class="tab-pane fade">
						<h3>Remove Categories</h3>
						<br>
						<table class="table table-hover table-responsive">
							<thead>
								<tr>
									<th>Category ID</th>
									<th>Category Name</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Memory</td>
									<td><a href"myModal" data-toggle="modal" data-target="#myModal">Delete</a></td>
								</tr>
							</tbody>
						</table>
						
					</div>
				</div>
				</div>
				</div>
				</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
											 
<script>				//-----#-----#-----#---- REFERENCE FOR THIS CODE http://stackoverflow.com/questions/18999501/bootstrap-3-keep-selected-tab-on-page-refresh
						//include this code in all tabbed sections 
													
       $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTab a[href="' + hash + '"]').tab('show');
</script>
				-->

 
</body>
</html>
