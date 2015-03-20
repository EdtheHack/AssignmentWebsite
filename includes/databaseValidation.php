<?php
	session_start();
	
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	
	function DBconnect(){				// code reuse for cdatabase connection
		include ($_SERVER['DOCUMENT_ROOT'] . '/dbconn.php');
		
		$con = $db_con;
		return $con;
	}
	
	function validateUser($email, $password){
		$con = DBconnect();
		
		$email = mysqli_real_escape_string($con, $email);
		$password = mysqli_real_escape_string($con, $password);
		$password = hash("sha256", $password);		//hash user entered password
		
		$query = "SELECT * FROM user WHERE email = '".$email."' AND password = '".$password."';";
		
		$checkAttemptsQuery = "SELECT loginAttempts FROM user WHERE email = '".$email."';";
		
		$checkBlockQuery = "SELECT blocked FROM user WHERE email = '".$email."';";
		
		$blockQuery = "UPDATE user									
							SET blocked = '1'
							WHERE email = '".$email."';"; 
							
		$loginQuery = "UPDATE user
				SET loginAttempts = '0', blocked = '0'
				WHERE email = '".$email."' AND password = '".$password."';";
		
		if ($result = mysqli_query($con,$query)) {		//check if user and password match
			$numRows = mysqli_num_rows($result);	
			$row = mysqli_fetch_row($result);
			if ($result = mysqli_query($con,$checkBlockQuery)){
				$block = mysqli_fetch_row($result);								
				if ($block[0] == 0){
					if ($numRows > 0){
					if ($result = mysqli_query($con,$loginQuery)){
					}
						$_SESSION["userID"] = "$row[0]";
						$_SESSION["email"] = "$row[1]";
						//$_SESSION["password"] = "$row[2]";
						$_SESSION["firstName"] = "$row[3]";
						$_SESSION["lastName"] = "$row[4]";
						$_SESSION["addressLine1"] = "$row[5]";
						$_SESSION["addressLine2"] = "$row[6]";
						$_SESSION["postcode"] = "$row[7]";
						$_SESSION["mobileNumber"] = "$row[8]";
						$_SESSION["homeNumber"] = "$row[9]";
						$_SESSION["admin"] = "$row[12]";
						return 1;
					} else {
						if (checkEmail($email) == 1){											//check if email exists but wrong password entered
							if ($result = mysqli_query($con, $checkAttemptsQuery)) {			//check how many times user has previously tried
								$row = mysqli_fetch_row($result);								
								if ($row[0] < 4){
									$attempt = ($row[0] + 1);
									
									$addAttemptQuery = "UPDATE user									
									SET loginAttempts = '".$attempt."'
									WHERE email = '".$email."';";  								//query only works when placed here
							
									if ($result = mysqli_query($con, $addAttemptQuery)) {		//add a failed attempt
										echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong>" .(5 - $attempt)." login attempts left.
						</div>";
										return 0;
									}
								} else {
									if ($result = mysqli_query($con, $blockQuery)){
														echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Account blocked. Please reset password.
						</div>";
										return 0;
									}
								}
							} 
						} else {
										echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Email not found.
						</div>";
						}
					}
				} else {
								echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Account blocked. Please reset password.
						</div>";
				}
			}
		} 
		return 0;
	}
	
	function createUser($password){
		$con = connect();
		
		$password = mysqli_real_escape_string($con, $password);
		$password = hash("sha256", $password);
				
		$query = "INSERT INTO user (email, password, firstName, lastName, addressLine1, addressLine2, postcode, mobileNo, homeNo)
		VALUES ('".$_SESSION['email']."', '".$password."', '".$_SESSION['firstName']."', '".$_SESSION['lastName']."', '".$_SESSION['addressLine1']."',
				 '".$_SESSION['addressLine2']."', '".$_SESSION['postcode']."', '".$_SESSION['mobileNumber']."', '".$_SESSION['homeNumber']."');";
				
		if ($result = mysqli_query($con, $query)) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function updateUser($firstName, $lastName, $addressLine1, $addressLine2, $postcode, $mobileNumber, $homeNumber){
		$con = connect();

		if($firstName != null){
			if(validateFirstName($firstName) != 1){
				return 0;
			}
		}
		if($lastName != null){
			if(validateLastName($lastName) != 1){
				return 0;
			}
		}
		if($addressLine1 != null){
			if(validateAddressLine1($addressLine1) != 1){
				return 0;
			}
		}
		if($addressLine2 != null){
			if(validateAddressLine2($addressLine2) != 1){
				return 0;
			}
		}
		if($postcode != null){
			if(validatePostcode($postcode) != 1){
				return 0;
			}
		}
		if($mobileNumber != null){
			if(validateMobileNumber($mobileNumber) != 1){
				return 0;
			}
		}
		if($homeNumber != null){
			if(validateHomeNumber($homeNumber) != 1){
				return 0;
			}
		}
				
		$query = "UPDATE user
				SET firstName = '".$_SESSION['firstName']."', lastName = '".$_SESSION['lastName']."', addressLine1 = '".$_SESSION['addressLine1']."', addressLine2 = '".$_SESSION['addressLine2']."',
				 postcode = '".$_SESSION['postcode']."', mobileNo = '".$_SESSION['mobileNumber']."', homeNo = '".$_SESSION['homeNumber']."'
				WHERE user_id = '".$_SESSION['userID']."';";
				
		if ($result = mysqli_query($con, $query)) {
			return 1;
		} else {
			echo $_SESSION['userID'];
			return 0;
		}
	}

	function validateDetails($email, $password, $firstName, $lastName, $addressLine1, $addressLine2, $postcode, $mobileNumber, $homeNumber){
		$con = connect();
		
		$_SESSION["email"] = mysqli_real_escape_string($con, "$email");
		//$password = mysqli_real_escape_string($con, "$password");
		
		$query = "SELECT * FROM user WHERE email = '".$_SESSION['email']."';";
		
		if ($result=mysqli_query($con,$query)) {
			$numRows = mysqli_num_rows($result);						
			if ($numRows > 0){
				echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> The email address ".$_SESSION["email"]." is already used.
						</div>";
				return 0;
			}
		}
		
		if ($_SESSION['email'] == null){
						echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Please set an email.
						</div>";
			return 0;
		} else if (strlen($_SESSION['email']) <= 3){
						echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Email must be longer than 3 characters.
						</div>";
			return 0;
		} else if (strlen($_SESSION['email']) > 50) {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Email must be shorter than 20 characters.
						</div>";
			return 0;
		}
		
		if(validatePassword($password) != 1){
			return 0;
		}
		if(validateFirstName($firstName) != 1){
			return 0;
		}
		if(validateLastName($lastName) != 1){
			return 0;
		}
		if(validateAddressLine1($addressLine1) != 1){
			return 0;
		}
		if(validateAddressLine2($addressLine2) != 1){
			return 0;
		}
		if(validatePostcode($postcode) != 1){
			return 0;
		}
		if(validateMobileNumber($mobileNumber) != 1){
			return 0;
		}
		if(validateHomeNumber($homeNumber) != 1){
			return 0;
		}		
		return 1;
	}
	
	function validatePassword($password){									//These validation functions allow code reuse between registration and editing details		
		$con = connect();
			
		if (preg_match( '/^[A-Z 0-9 \'!@#$%&*_]{2,30}$/i', $password)) {
			$password = mysqli_escape_string($con, $password);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Password must not contain illegal characters and be longer than 2 characters.
						</div>";
			return 0;
		}
	}
	
	function validateFirstName($firstName){											
		$con = connect();
			
		if (preg_match( '/^[A-Z \'.-]{2,30}$/i', $firstName)) {
			$_SESSION["firstName"] = mysqli_escape_string ($con, $firstName);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Frst name must not contain numbers and be longer than 2 characters.
						</div>";
			return 0;
		}
	}
	
	function validateLastName($lastName){											
		$con = connect();
			
		if (preg_match( '/^[A-Z \'.-]{2,30}$/i', $lastName)) {
			$_SESSION["lastName"] = mysqli_escape_string ($con, $lastName);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Last name must not contain numbers and be longer than 2 characters.
						</div>";
			return 0;
		}
	}
	
	function validateAddressLine1($addressLine1){									
		$con = connect();
			
		if (preg_match( '/^[A-Z 0-9\'\,.-]{2,100}$/i', $addressLine1)) {
			$_SESSION["addressLine1"] = mysqli_escape_string ($con, $addressLine1);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Address line 1 must be longer than 2 characters.!
						</div>";
			return 0;
		}
	}
	
	function validateAddressLine2($addressLine2){									
		$con = connect();
			
		if (preg_match( '/^[A-Z 0-9\'\,.-]{2,100}$/i', $addressLine2)) {
			$_SESSION["addressLine2"] = mysqli_escape_string ($con, $addressLine2);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Address line 2 must be longer than 2 characters.
						</div>";
			return 0;
		}
	}
	
	function validatePostcode($postcode){
		$con = connect();
			
		if (preg_match( '/^[A-Z 0-9\'\,.-]{6,8}$/i', $postcode)) {
			$_SESSION["postcode"] = mysqli_escape_string ($con, $postcode);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Postcode must be longer than 2 characters.
						</div>";
			return 0;
		}
	}
	
	function validateMobileNumber($mobileNumber){
		$con = connect();
			
		if (preg_match( '/^[0-9 \'.-]{11}$/i', $mobileNumber)) {
			$_SESSION["mobileNumber"] = mysqli_escape_string ($con, $mobileNumber);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Mobile number cannot contain letters and must 11 characters.
						</div>";
			return 0;
		}
	}
	
	function validateHomeNumber($homeNumber){
		$con = connect();
			
		if (preg_match( '/^[0-9 \'.-]{11}$/i', $homeNumber)) {
			$_SESSION["homeNumber"] = mysqli_escape_string ($con, $homeNumber);
			return 1;
		} else {
			echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Home number cannot contain letters and must be 11 characters.
						</div>";
			return 0;
		}
	}
	
	function checkEmail($email){
		$con = connect();
		$email = mysqli_real_escape_string($con, $email);
	
		$query = "SELECT * FROM user WHERE email = '".$email."';";
		
		if ($result=mysqli_query($con,$query)) {
			$numRows = mysqli_num_rows($result);						
			if ($numRows > 0){
				return 1;
			} 
		}
		return 0;
	}
	
	function updateEmail($password, $oldEmail, $newEmail){
		$con = connect();

		$oldEmail = mysqli_real_escape_string($con, $oldEmail);
		$newEmail = mysqli_real_escape_string($con, $newEmail);
		
		$password = hash("sha256", $password);
		
		$query = "UPDATE user
				SET email = '".$newEmail."'
				WHERE email = '".$oldEmail."';";
				
		if ($password == $_SESSION['password']){							//check current password is the same
			if ($oldEmail == $_SESSION['email']){							//check entered email matches current email
				if ($newEmail != null){										//make sure email is not null
					if (checkEmail($newEmail) == 0){						//check if email exists
						if ($result = mysqli_query($con, $query)) {			//if query executes
							$_SESSION['email'] = $newEmail;
							echo "<div class=\"alert alert-success\">
					   				<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   				<strong>Thankyou!</strong> Email changed successfully.
								</div>";
							return 1;
						} else {
							echo "<div class=\"alert alert-danger\">
					   				<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   				<strong>Error!</strong> Problem setting your email, contact admin!
								</div>";
						}
					} else {
						echo "<div class=\"alert alert-danger\">
					   				<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   				<strong>Error!</strong> That email already exists with us!
								</div>";
					}
				} else {
					echo "<div class=\"alert alert-danger\">
					   				<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   				<strong>Error!</strong> You must enter a new email!
								</div>";
				}
			} else {
				echo "<div class=\"alert alert-danger\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					<strong>Error!</strong> Email entered does not match!
				</div>";
			}
		} else {
				echo "<div class=\"alert alert-danger\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					<strong>Error!</strong> Incorrect password!
				</div>";
		}
		return 0;
	}
	
	function forgottenPassword($email, $password){							//password changing functions
		$con = connect();
		
		$email = mysqli_real_escape_string($con, $email);
		$password = hash("sha256", $password);
		
		$query = "UPDATE user
				SET password = '".$password."', loginAttempts = '0', blocked = '0'
				WHERE email = '".$email."';";
		
		if ($result = mysqli_query($con, $query)) {
			$_SESSION["suggestReset"] = true;
			echo "<div class=\"alert alert-sucess\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					<strong>Sucess!</strong> Password has been reset!
				</div>";
		} else {
			echo "<div class=\"alert alert-danger\">
					<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					<strong>Error!</strong> Problem resetting password!
				</div>";
		}
	}
	
	function updatePassword($oldPassword, $password, $passwordCheck){
		$con = connect();
		
		if (validatePassword($password) == 0){
			return 0;
		}
		
		$oldPassword = hash("sha256", $oldPassword);
		$password = hash("sha256", $password);
		$passwordCheck = hash("sha256", $passwordCheck);
				
		$checkQuery = "SELECT * FROM user WHERE user_id = '".$_SESSION['userID']."' AND password = '".$oldPassword."';";
				
		$query = "UPDATE user
				SET password = '".$password."'
				WHERE user_id = '".$_SESSION['userID']."';";
		
		if ($result = mysqli_query($con, $checkQuery)) {
			$numRows = mysqli_num_rows($result);						
			if ($numRows > 0){
				if ($password == $passwordCheck){
					if ($result = mysqli_query($con, $query)) {
						return 1;
					} else {
						echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Problem setting your new password, contact admin!
						</div>";
						return 0;
					}
				} else {
					echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> New passwords don't match!
						</div>";
					return 0;
				}
			} else {
					echo "<div class=\"alert alert-danger\">
					   		<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>
					   		<strong>Error!</strong> Incorrect old password!
						</div>";
				return 0;
			}
		} 
			
	}
?>