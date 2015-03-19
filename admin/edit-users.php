<?php
session_start ();

//include ("../includes/order.php");
//include ("../includes/product.php");
/*
 * include ("includes/common-functions.php");
 *
 * if (($_SESSION["loggedIn"] == true) && checkAdmin() == 1){
 * //admin is logged in
 * }else{
 * echo "<script type=\"text/javascript\">document.location.href=\"login-page.php\";</script>";
 * //FORCE USER TO LOG IN OR NOT ADMIN, IF LOGGED IN AND NOT ADMIN THEN THE LOGIN PAGE WILL SEND TO INDEX
 * //(bit scrubby)
 * }
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>View/Edit Products - Web Programming Assignment 2</title>
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

include ("admin-includes/admin-common.php");

if(isset ($_GET['user'])){
	$user_id = $_GET['user'];

	$row = getUser($user_id);

	$user = new user($row[0][0], $row[0][2], $row[0][0], $row[0][10]);
	$user->additionalConstruct($row[0][1], $row[0][4], $row[0][5], $row[0][6], $row[0][7], $row[0][8], $row[0][9], $row[0][3]);
		
?>
<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="jumbotron">
					<h2>Editing the User <?php echo $user->getName()." ".$user->getLastName(); ?>. <small> Edit a users settings for them as an administrator.</small>
					</h2>
				</div>
			</div>
  <?php
	include ("admin-nav.php");

?>

    <div class="col-md-9">

    <div id="print_errors"></div>
    
    <div class="well">
    	<br>
    	<a href="#"  class="btn btn-default">Reset Password</a>
    	<p class="help-block">Force a password reset and send the user a new passwword via thier account email.</p>
    	<br>
    	<a href="#"  class="btn btn-default">Block User</a>
    	<p class="help-block">Block the users account.</p>
    	<br>
    </div>
    <br>
    
    	<form method="POST" action="">
			<div class="form-group">
		        <label for="email">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="Enter email" name="email"  
				<?php if(!empty($_POST["emailRegister"])){ echo " value='".$_POST["emailRegister"]."'"; }else{ echo " value='".$user->getEmail()."'";}?>>
			</div>
			<div class="form-group">
		        <label for="firstName">First Name:</label>			
				<input type="text" name="firstName" class="form-control" placeholder="Enter First Name" 
				<?php if(!empty($_POST["firstName"])){ echo " value='".$_POST["firstName"]."'"; } else { echo " value='".$user->getName()."'"; } ?>>
			</div>
			<div class="form-group">
		        <label for="lastName">Last Name:</label>			
				<input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" 
				<?php if(!empty($_POST["lastName"])){ echo " value='".$_POST["lastName"]."'"; }else {echo " value='".$user->getLastName()."'"; } ?>>
			</div>
			<div class="form-group">
		        <label for="addressLine1">Address Line 1:</label>	
				<input type="text" name="addressLine1" class="form-control" placeholder="Enter Address Line 1" 
				<?php if(!empty($_POST["addressLine1"])){ echo " value='".$_POST["addressLine1"]."'"; } else {echo " value='".$user->getAddr1()."'";}?>>
			</div>
			<div class="form-group">
		        <label for="addressLine2">Address Line 2:</label>	
				<input type="text" name="addressLine2" class="form-control" placeholder="Enter Address Line 2" 
				<?php if(!empty($_POST["addressLine2"])){ echo " value='".$_POST["addressLine2"]."'"; } else { echo " value='".$user->getAddr2()."'"; }?>>
			</div>
			<div class="form-group">
		        <label for="postcode">Postcode :</label>	
				<input type="text" name="postcode" class="form-control" placeholder="Enter postcode" 
				<?php if(!empty($_POST["postcode"])){ echo " value='".$_POST["postcode"]."'"; } else { echo " value='".$user->getPostcode()."'"; }?>>
			</div>
			<div class="form-group">
		        <label for="mobileNumber">Mobile Number:</label>	
				<input type="text" name="mobileNumber" class="form-control" placeholder="Enter Mobile Number " 
				<?php if(!empty($_POST["mobileNumber"])){ echo " value='".$_POST["mobileNumber"]."'"; } else { echo " value='".$user->getMobile()."'"; } ?>>
			</div>
			<div class="form-group">
		        <label for="homeNumber">Home Number:</label>	
				<input type="text" name="homeNumber" class="form-control" placeholder="Enter Home Number "  
				<?php if(!empty($_POST["homeNumber"])){ echo " value='".$_POST["homeNumber"]."'"; } else { echo " value='".$user->getHome()."'"; }?>>
			</div>			
			<div class="form-group">
						<label for="isAdmin">Product Visibility Settings:</label> <select
							class="form-control" name="isAdmin" id="isAdmin">
							<option value="0">Not admin</option>
							<option value="1">Is an Admin</option>
						</select>
					</div>
					<script type="text/javascript">
  								document.getElementById('isAdmin').value = "<?php  if(!empty($_POST["isAdmin"])){ echo $_POST["isAdmin"]; } else { echo $user->getAdmin();}?>";
					</script>			
			<br>
			<input type="submit" name="editUser" class="btn btn-default" value="Edit User">
		</form>
    </div>
</div>

<?php 
	}else{
		echo "<script type=\"text/javascript\">document.location.href=\"view-users.php\";</script>";
	}
?>
</body>
</html>