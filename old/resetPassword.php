<?php
	include 'functions/databaseValidation.php';	
	require 'PHPMailer/PHPMailerAutoload.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Reset Password </title>
		<!-- Bootstrap CSS -->
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
		
		<style>
			p#p1 {
				margin-top: 5px;
			}
			
			div#d1 {
				background-color: #BBBBBB;
				margin-left: auto;
				margin-right: auto;
				width: 500px;
			}
		</style>
	</head>

	<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="nav navbar-text">
				<b> i7212753 Web Assignment </b>
			</div>
			<ul class="nav navbar-text">
				<li class="active">Reset Password</li>
			</ul>
		</div>
	</nav>
	
	<h1 class ="text-center"> Reset Password </h1>
	
	<br>
		
	<div id="d1" class="panel panel-default">
		<div style="padding-top: 12px" class="panel-body">
		<p style="text-align: center"> Input email to get new password </p>
			<form method="POST" action="">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-2 col-sm-2">
							<p id="p1" class="text-left"><span class="label label-default">Email</span></p>
						</div>
						<div class="col-xs-10 col-sm-10">
							<div class="center">
								<span class="input-group"></span>
								<input type="email" name="email" class="form-control" placeholder="Email">
							</div>
						</div>
					</div>
				</div>
				
				<br>
				
				<p style="text-align: center"> <input type="submit" name="back" class="btn btn-default" value="Back"> <input type="submit" name="sendMail" class="btn btn-default" value="Get New Password"> </p>
			</form>
			<?php
				if(isset($_POST['sendMail'])){
					$email = $_POST['email'];
					$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
					$password = substr(str_shuffle($characters), 0, 8);  //generate new password
					if ($email != null){
						if (checkEmail($email) == 1){
							$mail = new PHPMailer;
							$mail->IsSMTP();
							$mail->Host = "localhost";

							$mail->setFrom('doNotReply@password.com', 'i7212753 Password Reset');
							$mail->addAddress($email, '');
							$mail->Subject = "i7212753 - New Password";
							$mail->isHTML(true);
							$mail->Body = ('Your new password: '.$password.'.');
							
							if(!$mail->Send()) {
								echo " Mailer Error: " . $mail->ErrorInfo;
							} else {
								forgottenPassword($email, $password);
								echo " Message sent!";
							}
						} else {
							echo "Email does not exist";
						}
					} else {
						echo "Email can not be null";
					}
				}
				if(isset($_POST['back'])){
					echo "<script>window.location.replace(\"http://student20261.201415.uk/i7212753WebAssignment/index.php\")</script>";
				}
			?>
		</div>
	</div>

	<!-- Bootstrap -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>
