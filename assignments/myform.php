<!DOCTYPE html>
<html>
<head>
	<title>My Form</title>
	<style type="text/css">
		body {
			background-color: #A23E48; 
			color: #E8F0F7;
			padding: 24px;
		}
		ul {
			list-style-type: none;
		}
		li {
			padding: 4px;
		}
		input {
			margin-left: 8px;
		}
		table, th, td {
			border-collapse: collapse;
			border: 2px solid #E8F0F7;
			padding: 4px;
		}
		h4 {
			display: inline;
		}
	</style>
</head>
<body>
<center>
<?php 
	switch ($_GET['q']) {
		case 'ae':
			echo "<h1>Hi welcome to the form for people who know Todd! (That's me!)</h1><h2 style='color:red;'>Error! that username already existes please pick a new one or select update!</h2>";
			break;
		case 'ip':
			echo "<h1>Hi welcome to the form for people who know Todd! (That's me!)</h1><h2 style='color:red;'>Error! Incorrect Password!</h2>";
			break;
		case 'ss':
			echo "<h1>Hi welcome to the form for people who know Todd! (That's me!)</h1><h2 style='color:green;'>Sucess! Entry creates/updated!</h2>";
			break;
		default:
			echo "<h1>Hi welcome to the form for people who know Todd! (That's me!)</h1><h2>Please fill out the info below!</h2>";
			break;
	}
 ?>
 <hr>
<div class="input">
	<form  class="myform" onsubmit="return validate()" action="mysubmit.php" method="post">	
	<ul>
		<li>would you like to Update? or Create a new relation?</li>
		<li>please note you will need the proper username and password to update your record</li> 
		<li>
			<input type="radio" name="switch" value="true">Update
			<input type="radio" name="switch" value="false" checked>Create
		</li>
	</ul>
	<ul>
		<li><label for="firstName" >First Name</label><input type="text" name="firstName"><h4 for="firstName"></h4></li>
		<li><label for="lastName" >Last Name</label><input type="text" name="lastName"><h4 for="lastName"></h4></li>
		<li><label for="phoneNumber" >Phone Number</label><input type="tel" name="phoneNumber"><h4 for="phoneNumber"></h4></li>
		<li><label for="address" >Address</label><input type="text" name="address"><h4 for="address"></h4></li>
		<li><label for="city" >City</label><input type="text" name="city"><h4 for="city"></h4></li>
		<li><label for="state" >State</label><input type="text" name="state"><h4 for="state"></h4></li>
		<li><label for="zip" >Zip</label><input type="text" name="zip"><h4 for="zip"></h4></li>
		<li><label for="birthdate" >Birthdate</label><input type="date" name="birthdate"><h4 for="birthdate"></h4></li>
		<li><label for="username" >Username</label><input type="username" name="username"><h4 for="username"></h4></li>
		<li><label for="password" >Password</label><input type="password" name="password"><h4 for="password"></h4></li>
		<li><label for="gender">Gender</label>
			<input type="radio" name="gender" value="M"> Male
			<input type="radio" name="gender" value="F"> Female
		<h4 for="gender"></h4></li>
		<li><label for="relation">Relation to Me!</label>
			<select name="relation">
			  <option value="family">Family</option>
			  <option value="friend">Friend</option>
			  <option value="m8">m8</option>
			  <option value="thatoneguy">That One Guy</option>
			</select>
		<h4 for="relation"></h4></li>
	</ul>
	<input type="submit" name="submit" value="submit">
	</form>
	<hr>
	<form  class="search" action="myform.php" method="post">
		<h3>Search via First or Last name here!</h3>
		<ul>
			<li>Search by First Name: <input type="search" name="searchFirst"></li>
			<li>search by Last Name: <input type="search" name="searchLast"></li>
		</ul>
		<input type="submit" name="search" value="Search">
	</form>
</div>
<div class="output">
<br>
	<table>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Phone Number</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th>Birthdate</th>
			<th>Username</th>
			<th>Password</th>
			<th>Gender</th>
			<th>Relation to Me</th>
		</tr>
<?php 
	// require_once('php/db_functions.php');
	// for ($i=0; $i < $results->num_rows; $i++) { 
	// 	$row=(mysqli_fetch_array($results));
	// 	echo "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["phoneNumber"] . "</td><td>" . $row["address"] . "</td><td>" . $row["city"] . "</td><td>" . $row["state"] . "</td><td>" . $row["zip"] . "</td><td>" . $row["birthdate"] . "</td><td>" . $row["username"] . "</td><td> ********** </td><td>" . $row["gender"] . "</td><td>" . $row["relation"] . "</td></tr>";
	// } 
	
	require_once('php/db_functions.php');
	$searchFirst = $_POST['searchFirst'];
	$searchLast = $_POST['searchLast'];
	// echo "First: $searchFirst Last: $searchLast querry:";
	if (isset($searchFirst) && isset($searchLast)) {
	$results = db_query("SELECT * FROM users WHERE firstName LIKE '%$searchFirst%' AND lastName LIKE'%$searchLast%'");
	} else {
	$results = db_query("SELECT * FROM users");	
	}
	for ($i=0; $i < $results->num_rows; $i++) { 
		$row=(mysqli_fetch_array($results));
		echo "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["phoneNumber"] . "</td><td>" . $row["address"] . "</td><td>" . $row["city"] . "</td><td>" . $row["state"] . "</td><td>" . $row["zip"] . "</td><td>" . $row["birthdate"] . "</td><td>" . $row["username"] . "</td><td> ********** </td><td>" . $row["gender"] . "</td><td>" . $row["relation"] . "</td></tr>";
	}
?>
	</table>
</div>
</center>
</body>
<script type="text/javascript">
	var searchFirst = "<?php echo "$searchFirst"; ?>"
	var searchLast = "<?php echo "$searchLast"; ?>"
	document.querySelector("input[name='searchFirst']").value = searchFirst;
	document.querySelector("input[name='searchLast']").value = searchLast;

	function testValidate() {
		alert('test');
		return false;
	}

	function validate() {
		var nameRegex = new RegExp(/^[a-zA-Z]+$/,"ig");
		var phoneRegex = new RegExp(/^[0-9]+$/,"ig");
		const form = document.querySelector('.myform');
		const inputs = form.querySelectorAll('input');
		var isValid = true;
		inputs.forEach(input => {
			if (input.value == "") {
				let inputName = input.name;
				let label = document.querySelector(`h4[for='${inputName}']`);
				if (label.innerHTML == "") {
				label.innerHTML = "* Please Fill Out";
				}

				// alert(`${input.name} missing value`);
				isValid = false;
			} 
			else {
				console.log(input);
				let inputName = input.name;
				console.log(inputName);
				let label = document.querySelector(`h4[for='${inputName}']`);
				// console.log(label);
				if (label) {
					console.log(label);
					label.innerHTML = "";
				}
				// label.innerHTML = "";
			}
		})
		if (!document.querySelector("input[name='firstName']").value.match(nameRegex)) {
			// console.log(document.querySelector("input[name='firstName']"));
			// alert("FNAME ERROR");
			document.querySelector("h4[for='firstName']").innerHTML = "Not A Valid Name - Use only Upper or Lower Case Letters A-Z or a-z"
			isValid = false;
		}
		if (!document.querySelector("input[name='lastName']").value.match(nameRegex)) {
			// console.log(document.querySelector("input[name='lastName']"));
			// alert("LNAME ERROR");
			document.querySelector("h4[for='lastName']").innerHTML = "Not A Valid Name - Use only Upper or Lower Case Letters A-Z or a-z"
			isValid = false;
		}
		if (!document.querySelector("input[name='phoneNumber']").value.match(phoneRegex)) {
			// console.log(document.querySelector("input[name='phoneNumber']"));
			document.querySelector("h4[for='phoneNumber']").innerHTML = "Not A Valid Phone Number - Use only Number 0-9"
			isValid = false;
		}
		// alert(isValid);
		return isValid
	}
</script>
</html>