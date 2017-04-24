<?php 
	
	require_once('php/db_functions.php');

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phoneNumber = $_POST['phoneNumber'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$birthdate = $_POST['birthdate'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$gender = $_POST['gender'];
	$relation = $_POST['relation'];
	$switch = $_POST['switch'];

	if ($switch == "false") {
		$existingUser = mysqli_fetch_array(db_query("SELECT `username` FROM `users` WHERE `username`='$username'"));
		if ($existingUser[0] == $username) {
			header("Location: myform.php?q=ae");
		} else {
			db_query("INSERT INTO `users`(`user_id`, `firstName`, `lastName`, `phoneNumber`, `address`, `city`, `state`, `zip`, `birthdate`, `username`, `password`, `gender`, `relation`)	VALUES 	( NULL, '$firstName', '$lastName', '$phoneNumber', '$address', '$city', '$state', '$zip', '$birthdate', '$username', '$password', '$gender', '$relation')");
			echo "INSERT INTO `users`(`user_id`, `firstName`, `lastName`, `phoneNumber`, `address`, `city`, `state`, `zip`, `birthdate`, `username`, `password`, `gender`, `relation`)	VALUES 	( NULL, '$firstName', '$lastName', '$phoneNumber', '$address', '$city', '$state', '$zip', '$birthdate', '$username', '$password', '$gender', '$relation')";
			header("Location: myform.php?q=ss");
		}
	} else {
		$checkPass = mysqli_fetch_array(db_query("SELECT `password` FROM `users` WHERE `username`='$username'"));
		print_r($checkPass);

		if ($checkPass[0] == $password) {
			$user_id = mysqli_fetch_array(db_query("SELECT `user_id` FROM `users` WHERE `username`='$username' AND `password`='$password'"));
			db_query("UPDATE `users` SET `firstName`= '$firstName',`lastName`='$lastName',`phoneNumber`= '$phoneNumber',`address`= '$address',`city`='$city',`state`= '$state',`zip`= '$zip',`birthdate`= '$birthdate',`username`= '$username',`password`= '$password',`gender`= '$gender',`relation`= '$relation' WHERE `user_id`='$user_id[0]'");
			echo "UPDATE `users` SET `firstName`= '$firstName',`lastName`='$lastName',`phoneNumber`= '$phoneNumber',`address`= '$address',`city`='$city',`state`= '$state',`zip`= '$zip',`birthdate`= '$birthdate',`username`= '$username',`password`= '$password',`gender`= '$gender',`relation`= '$relation' WHERE `user_id`='$user_id[0]'";
				header("Location: myform.php?q=ss");
		} else {
			header("Location: myform.php?q=ip");
		}
	}
 ?>