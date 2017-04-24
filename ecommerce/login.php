<?php 
require_once 'php/db_functions.php';
session_start();
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
		margin: auto auto;
		background-color: white;
		box-shadow: 2px 2px 2px #888888;
		height: 25vh;
		width: 50vw;
		position: absolute;
		top: 25%;
		left: 25%;
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
	<form class="login-container" method="post" action="php/checklogin.php">
		<table>
			<tbody><tr><th>
				</th><td colspan="2"><h2>Sign In</h2></td>   				
			</tr><tr>
				<td><label><b>Username: </b></label></td>
				<td><input type="text" placeholder="Username" name="text" required></td>
			</tr>
			<tr>
				<td><label><b>Password: </b></label></td>
				<td><input type="password" placeholder="Enter Password" name="pass" required=""></td>
			</tr>
		</tbody></table>
		<center>
			<button type="submit" name="btn-login">Login</button>
			<button type="reset">Reset</button>
			<br><br><br>
			<a href=""></a>
		</center>
	</form>
</div>

</div>
</body>
<script type="text/javascript">
	let navHeight = document.querySelector('nav').offsetHeight;
	console.log(navHeight);
	document.body.style.paddingTop = navHeight + 'px';
</script>
</html>

