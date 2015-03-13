<?php
$upload_folder = "img/";
$file = $dest.basename($_FILES['photo']['name']);

if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
	if(move_uploaded_file($_FILES['photo']['tmp_name'], $file)) {
		echo "The file ". basename( $_FILES['photo']['name'])." has been uploaded";
	} else {
		echo "Error, please try again!";
	}
} else { 
	echo"something happened";
}
?>