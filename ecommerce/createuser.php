<?php 
require_once 'php/db_functions.php';
session_start();

if (isset($_SESSION['username'])) {
	header('location: store');
}

$link = db_connect();

$firstName = ucfirst(mysqli_escape_string($link, stripcslashes($_POST['firstName'])));
$lastName = ucfirst(mysqli_escape_string($link, stripcslashes($_POST['lastName'])));
$email = mysqli_escape_string($link, stripcslashes($_POST['email']));
$username = mysqli_escape_string($link, stripcslashes($_POST['username']));
$password = mysqli_escape_string($link, stripcslashes($_POST['password']));

if ($username != "" && $password != "") {
	//hash and salt password
	$password = hash(ripemd160, "saltdat".$password."saltadded");
	//add row to user2
	echo"INSERT INTO user2 (user_id, username, firstname, lastname, email, password) VALUES (NULL, '$username', '$firstName', '$lastName', '$email', '$password')";
	db_query("INSERT INTO user2 (user_id, username, firstname, lastname, email, password) VALUES (NULL, '$username', '$firstName', '$lastName', '$email', '$password')");
	//redirect to login page
	header("location: login");
}
?>

<style type="text/css">

	body {
		height: 100%;
  		position: relative;
	}

	button {
		background:none;
		border:none;
		font-size:1em;
		color:blue;
		-webkit-border-radius: 4;
		-moz-border-radius: 4;
		border-radius: 4px;
		font-family: Arial;
		color: #ffffff;
		font-size: 14px;
		background: #F08A4B;
		padding: 8px 12px 8px 12px;
		text-decoration: none;
		margin: 12px 2px;
	}

	button:hover {
		background: #D78A76;
		text-decoration: none;
	}

	.login-wrapper {
		margin: 25px auto;
		background-color: white;
		box-shadow: 2px 2px 2px #888888;
		height: 40vh;
		width: 75vw;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}

</style>


<!DOCTYPE html>
<html>
<head>
	<title>ToddJudd - Assignments</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<!-- Header -->
<nav>
	<span></span>
	<h1>Acme Co.</h1>
	<span></span>
</nav>

<!-- login Form -->
<div class="login-wrapper">
	<form class="create-user-container" method="post" onsubmit="return validate()" action="createuser.php">
		<table>
			<tbody>
			<tr>
				<th colspan="2"><h2>Create User</h2></th>   				
			</tr>
			<tr>
				<td><label><b>First Name: </b></label></td>
				<td><input type="text" placeholder="John" name="firstName" required></td>
			</tr>
			<tr>
				<td><label><b>Last Name: </b></label></td>
				<td><input type="text" placeholder="Smith" name="lastName" required></td>
			</tr>
			<tr>
				<td><label><b>Email: </b></label></td>
				<td><input type="email" placeholder="Email" name="email" required></td>
			</tr>
			<tr>
				<td><label><b>Username: </b></label></td>
				<td><input type="text" placeholder="Username" name="username" required><span class="username-alert"></span></td>
			</tr>
			<tr>
				<td><label><b>Password: </b></label></td>
				<td><input type="password" placeholder="Enter Password" name="password" required=""></td>
			</tr>
			<tr>
				<td><label><b>Confirm Password: </b></label></td>
				<td><input type="password" placeholder="Confirm Password" name="passwordConfirm" required=""><br><span style="color: red; font-size: 8pt;" class="password-alert"></span></td>
			</tr>
		</tbody></table>
		<center>
			<button type="submit" name="btn-login">Create</button>
			<button type="reset">Reset</button>
		</center>
	</form>
</div>

</div>
</body>
<script type="text/javascript">
	// offset nav
	let navHeight = document.querySelector('nav').offsetHeight;
	console.log(navHeight);
	document.body.style.paddingTop = navHeight + 'px';

	//validation bool
	var isValid = true;

	//check username avaliablility
	const username = document.querySelector("input[name='username']");
	username.addEventListener('keyup', checkUsername);


	function checkUsername() {
		console.log("checkusername");
		var data_file = `php/checkusername.php?username=${username.value}`;
		//this is making the http request
		var http_request = new XMLHttpRequest();
		try {
			 // Opera 8.0+, Firefox, Chrome, Safari
			http_request = new XMLHttpRequest();
		} catch (e) {
			// Internet Explorer Browsers
			try {
				http_request = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					http_request = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
		http_request.onreadystatechange = function () {
			if (http_request.readyState == 4) {
				var text = http_request.responseText;
					//this is adding the elements to the HTML in the page
					document.querySelector('.username-alert').innerHTML = text;
				}
		 	}
		http_request.open("GET", data_file, true);
		http_request.send();
	}

	//confirm password
	const pass = document.querySelector("input[name='password']");
	const passconf = document.querySelector("input[name='passwordConfirm']");
	pass.addEventListener('keyup', confirmPassword);
	passconf.addEventListener('keyup', confirmPassword);

	function confirmPassword() {
		if (pass.value != passconf.value) {
			document.querySelector('.password-alert').innerHTML = 'Passwords Do Not Match';
			isValid = false;
		} else {
			document.querySelector('.password-alert').innerHTML = '';
			isValid = true;
		}
	}

	//validate form is filled out
	function validate() {
		let inputs = document.querySelectorAll('input').forEach(input => {
			if (input.value == '') {
				isValid = false;
				input.placeholder = 'please fill out';
				input.style.backgroundColor = '#CC6E57';
				input.addEventListener('click', function makewhite() {
					input.style.backgroundColor = '';
					input.placeholder = '';
				})
			}
		});
		return isValid;
	}

</script>
</html>