<?php
	session_start();
	
	function connect(){				// code reuse for cdatabase connection
	$con = mysqli_connect('127.0.0.1', 'i7212753', '06d77cdf96b02e48d430d7c908149aef', 'i7212753');
		if (!$con){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			die(mysqli_connect_error());
		}
		return $con;
	}
	
	function validateUser($email, $password){
		$con = connect();
		
		$email = mysqli_real_escape_string($con, $email);
		$password = mysqli_real_escape_string($con, $password);
		
		$password = hash("sha256", $password);		//hash user entered password
		
		$query = "SELECT * FROM user WHERE username = '".$email."' AND password = '".$password."';";
		
		$checkAttemptsQuery = "SELECT loginAttempts FROM user WHERE username = '".$email."';";
		
		$checkBlockQuery = "SELECT blocked FROM user WHERE username = '".$email."';";
		
		$blockQuery = "UPDATE user									
							SET blocked = '1'
							WHERE username = '".$email."';"; 
							
		$loginQuery = "UPDATE user
				SET loginAttempts = '0', blocked = '0'
				WHERE username = '".$email."' AND password = '".$password."';";
		
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
						$_SESSION["password"] = "$row[2]";
						$_SESSION["firstName"] = "$row[3]";
						$_SESSION["lastName"] = "$row[4]";
						$_SESSION["addressLine1"] = "$row[5]";
						$_SESSION["addressLine2"] = "$row[6]";
						$_SESSION["mobileNumber"] = "$row[7]";
						$_SESSION["homeNumber"] = "$row[8]";
						return 1;
					} else {
						if (checkEmail($email) == 1){											//check if username exists but wrong password entered
							if ($result = mysqli_query($con, $checkAttemptsQuery)) {			//check how many times user has previously tried
								$row = mysqli_fetch_row($result);								
								if ($row[0] < 4){
									$attempt = ($row[0] + 1);
									
									$addAttemptQuery = "UPDATE user									
									SET loginAttempts = '".$attempt."'
									WHERE username = '".$email."';";  								//query only works when placed here
							
									if ($result = mysqli_query($con, $addAttemptQuery)) {		//add a failed attempt
										echo (5 - $attempt)." login attempts left.";
										return 0;
									}
								} else {
									if ($result = mysqli_query($con, $blockQuery)){
										echo "Account blocked - Please reset password.";
										return 0;
									}
								}
							} 
						} else {
							echo "Email not found";
						}
					}
				} else {
					echo "Account blocked - Please reset password.";
				}
			}
		} 
		return 0;
	}
	
	function createUser(){
		$con = connect();
				
		$query = "INSERT INTO user (username, password, firstName, lastName, addressLine1, addressLine2, mobileNo, homeNo)
		VALUES ('".$_SESSION['email']."', '".$_SESSION['password']."', '".$_SESSION['firstName']."', '".$_SESSION['lastName']."', '".$_SESSION['addressLine1']."', '".$_SESSION['addressLine2']."', '".$_SESSION['mobileNumber']."', '".$_SESSION['homeNumber']."');";
				
		if ($result = mysqli_query($con, $query)) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function updateUser($firstName, $lastName, $addressLine1, $addressLine2, $mobileNumber, $homeNumber){
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
				SET firstName = '".$_SESSION['firstName']."', lastName = '".$_SESSION['lastName']."', addressLine1 = '".$_SESSION['addressLine1']."', addressLine2 = '".$_SESSION['addressLine2']."', mobileNo = '".$_SESSION['mobileNumber']."', homeNo = '".$_SESSION['homeNumber']."'
				WHERE userID = '".$_SESSION['userID']."';";
				
		if ($result = mysqli_query($con, $query)) {
			return 1;
		} else {
			echo $_SESSION['userID'];
			return 0;
		}
	}

	function validateDetails($email, $password, $firstName, $lastName, $addressLine1, $addressLine2, $mobileNumber, $homeNumber){
		$con = connect();
		
		$_SESSION["email"] = mysqli_real_escape_string($con, "$email");
		$_SESSION["password"] = mysqli_real_escape_string($con, "$password");
		
		$query = "SELECT * FROM user WHERE username = '".$_SESSION['email']."';";
		
		if ($result=mysqli_query($con,$query)) {
			$numRows = mysqli_num_rows($result);						
			if ($numRows > 0){
				echo "email: ".$_SESSION["email"]." is already used";
				return 0;
			}
		}
		
		if ($_SESSION['email'] == null){
			echo "please set an email";
			return 0;
		} else if (strlen($_SESSION['email']) <= 3){
			echo "email must be longer than 3 characters";
			return 0;
		} else if (strlen($_SESSION['email']) > 50) {
			echo "email must be shorter than 20 characters";
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
		if(validateMobileNumber($mobileNumber) != 1){
			return 0;
		}
		if(validateHomeNumber($homeNumber) != 1){
			return 0;
		}
		
		$_SESSION["password"] = hash("sha256", $_SESSION['password']);
		
		return 1;
	}
	
	function validatePassword($password){									//These validation functions allow code reuse between registration and editing details		
		$con = connect();
			
		if (preg_match( '/^[A-Z 0-9 \'!@#$%&*_]{2,30}$/i', $password)) {
			$_SESSION["password"] = mysqli_escape_string($con, $password);
			return 1;
		} else {
			echo "Password cannot contain illegal characters and must be longer than 2 characters";
			return 0;
		}
	}
	
	function validateFirstName($firstName){											
		$con = connect();
			
		if (preg_match( '/^[A-Z \'.-]{2,30}$/i', $firstName)) {
			$_SESSION["firstName"] = mysqli_escape_string ($con, $firstName);
			return 1;
		} else {
			echo "First name cannot contain numbers and must be longer than 2 characters";
			return 0;
		}
	}
	
	function validateLastName($lastName){											
		$con = connect();
			
		if (preg_match( '/^[A-Z \'.-]{2,30}$/i', $lastName)) {
			$_SESSION["lastName"] = mysqli_escape_string ($con, $lastName);
			return 1;
		} else {
			echo "Last name cannot contain numbers and must must be longer than 2 characters";
			return 0;
		}
	}
	
	function validateAddressLine1($addressLine1){									
		$con = connect();
			
		if (preg_match( '/^[A-Z 0-9\'\,.-]{2,100}$/i', $addressLine1)) {
			$_SESSION["addressLine1"] = mysqli_escape_string ($con, $addressLine1);
			return 1;
		} else {
			echo "Address line 1 must be longer than 2 characters";
			return 0;
		}
	}
	
	function validateAddressLine2($addressLine2){									
		$con = connect();
			
		if (preg_match( '/^[A-Z 0-9 \'\,.-]{2,100}$/i', $addressLine2)) {
			$_SESSION["addressLine2"] = mysqli_escape_string ($con, $addressLine2);
			return 1;
		} else {
			echo "Address line 2 must be longer than 2 characters";
			return 0;
		}
	}
	
	function validateMobileNumber($mobileNumber){
		$con = connect();
			
		if (preg_match( '/^[0-9 \'.-]{2,15}$/i', $mobileNumber)) {
			$_SESSION["mobileNumber"] = mysqli_escape_string ($con, $mobileNumber);
			return 1;
		} else {
			echo "Mobile number cannot contain letters and must be longer than 2 characters";
			return 0;
		}
	}
	
	function validateHomeNumber($homeNumber){
		$con = connect();
			
		if (preg_match( '/^[0-9 \'.-]{2,15}$/i', $homeNumber)) {
			$_SESSION["homeNumber"] = mysqli_escape_string ($con, $homeNumber);
			return 1;
		} else {
			echo "Home number cannot contain letters and must be longer than 2 characters";
			return 0;
		}
	}
	
	function checkEmail($email){
		$con = connect();
		$email = mysqli_real_escape_string($con, $email);
	
		$query = "SELECT * FROM user WHERE username = '".$email."';";
		
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
				SET username = '".$newEmail."'
				WHERE username = '".$oldEmail."';";
				
		if ($password == $_SESSION['password']){							//check current password is the same
			if ($oldEmail == $_SESSION['email']){							//check entered email matches current email
				if ($newEmail != null){										//make sure email is not null
					if (checkEmail($newEmail) == 0){						//check if email exists
						if ($result = mysqli_query($con, $query)) {			//if query executes
							$_SESSION['email'] = $newEmail;
							echo "Email changed successfully";
							return 1;
						} else {
							echo "Problem changing email";
						}
					} else {
						echo "New email already exists";
					}
				} else {
					echo "New email must not be null";
				}
			} else {
				echo "Old email incorrect";
			}
		} else {
			echo "Password is incorrect";
		}
		return 0;
	}
	
	function forgottenPassword($email, $password){							//password changing functions
		$con = connect();
		
		$email = mysqli_real_escape_string($con, $email);
		$password = hash("sha256", $password);
		
		$query = "UPDATE user
				SET password = '".$password."', loginAttempts = '0', blocked = '0'
				WHERE username = '".$email."';";
		
		if ($result = mysqli_query($con, $query)) {
			$_SESSION["suggestReset"] = true;
			echo "Password reset successfully -";
		} else {
			echo "Problem resetting password -";
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
				
		$checkQuery = "SELECT * FROM user WHERE userID = '".$_SESSION['userID']."' AND password = '".$oldPassword."';";
				
		$query = "UPDATE user
				SET password = '".$password."'
				WHERE userID = '".$_SESSION['userID']."';";
		
		if ($result = mysqli_query($con, $checkQuery)) {
			$numRows = mysqli_num_rows($result);						
			if ($numRows > 0){
				if ($password == $passwordCheck){
					if ($result = mysqli_query($con, $query)) {
						return 1;
					} else {
						echo "Problem setting new password";
						return 0;
					}
				} else {
					echo "New passwords don't match";
					return 0;
				}
			} else {
				echo "Old password incorrect";
				return 0;
			}
		} 
			
	}
?>