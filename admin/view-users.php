<?php
session_start ();

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
		    	$user = new user($row[$i][0], $row[$i][2],$row[$i][1], $row[$i][0], $row[$i][10]);
		    	$user->additionalConstruct($row[$i][1], $row[$i][4], $row[$i][5], $row[$i][6], $row[$i][7], $row[$i][8], $row[$i][9], $row[$i][3]);

		    ?>	
		    	<tr>
		    		<td><?php echo $user->getId()?></td>
		    		<td><?php echo $user->getName()." ".$user->getLastName();?></td>
		    		<td><?php echo $user->getEmail()?></td>
		    		<td><?php echo $user->getPostcode()?></td>
		    		<td><?php echo $user->getBlocked()?></td>
		    		<td><?php echo $user->getAdmin()?></td>
		    		<td><a href="edit-users.php?user=<?php echo $user->getId() ?>">Edit</a></td>
		    		<td><a href="myModal<?php echo $user->getId();?>" data-toggle="modal" data-target="#myModal<?php echo $user->getId();?>">Delete</a></td>
		    	</tr>
		    	
						<div class="modal fade" id="myModal<?php echo $user->getId();?>" tabindex="-1" role="dialog"
							aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete User</h4>
									</div>
									<div class="modal-body">Are you sure you want to delete this
										user? This cannot be undone, all associated orders will also been removed.</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<form method="POST" action="admin-includes/admin-common.php?delUser=<?php echo $user->getId();?>">
											<button type="submit" name="del" class="btn btn-danger"  >Delete User</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						
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