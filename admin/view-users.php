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
</head>
<body>
<?php
include ("nav.php");
?>
<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="jumbotron">
					<h2>View/Edit Customers <small> A collection of all users with accounts with the store.</small>
					</h2>
				</div>
			</div>
  <?php
	include ("admin-nav.php");
				

?>
    <div class="col-md-9">
    
    <table class="table table-hover table-responsive">
   		<thread>
	   		<tr>
	   			  <?php	    
			    $alphabet  = array();
			    $alphabet  = range('A', 'Z');
			    
			    foreach ($alphabet as $letter ){
			 		echo "<th><a href=\"view-users.php?name=".$letter."\"><strong>".$letter."</strong></a></th>";
			    }
			    
			   ?>
			 </tr>
		 </thread> 
		 <table class="table table-hover table-responsive">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
                        <th>Postcode</th>
						<th>Blocked</th>
						<th>Admin</th>
						<th>Edit</th>
						<th>Delete</th>
							
					</tr>
				</thead>
				<tbody>
		
		
		    <?php 
		    
		    include ("admin-includes/admin-common.php");
		    
		    if(isset ($_GET['name'])){
		    	$letter = $_GET['name']; 
		    	$row = listNames($letter);

		    for ($i = 0; $i < count($row); $i++){
		    	$user = new user($row[0][0], $row[0][2],$row[0][1], $row[0][0], $row[0][10]);
		    	$user->additionalConstruct($row[0][1], $row[0][4], $row[0][5], $row[0][6], $row[0][7], $row[0][8], $row[0][9], $row[0][3]);

		    ?>	
		    	<tr>
		    		<td><?php echo $user->getId()?></td>
		    		<td><?php echo $user->getName()." ".$user->getLastName();?></td>
		    		<td><?php echo $user->getEmail()?></td>
		    		<td><?php echo $user->getPostcode()?></td>
		    		<td><?php echo $user->getBlocked()?></td>
		    		<td><?php echo $user->getAdmin()?></td>
		    		<td><a href="edit-users.php?user=<?php echo $user->getId() ?>">Edit</a></td>
		    		<td>DELETE</td>
		    	</tr>
		    <?php 	
		    }
		    	
 
		    }else{
		    	echo "<script type=\"text/javascript\">document.location.href=\"view-users.php?name=A\";</script>";
		    }
		  
		    ?>


					</tbody>
				</table>
			</div>
		</div>
</div>
</body>
</html>