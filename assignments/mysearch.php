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
	</style>
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
	
	require_once('php/db_functions.php');

	$searchFirst = $_POST['searchFirst'];
	$searchLast = $_POST['searchLast'];
	// echo "First: $searchFirst Last: $searchLast querry:";

	require_once('php/db_functions.php');
	$results = db_query("SELECT * FROM users WHERE firstName LIKE '%$searchFirst%' AND lastName LIKE'%$searchLast%'");
	for ($i=0; $i < $results->num_rows; $i++) { 
		$row=(mysqli_fetch_array($results));
		echo "<tr><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["phoneNumber"] . "</td><td>" . $row["address"] . "</td><td>" . $row["city"] . "</td><td>" . $row["state"] . "</td><td>" . $row["zip"] . "</td><td>" . $row["birthdate"] . "</td><td>" . $row["username"] . "</td><td> ********** </td><td>" . $row["gender"] . "</td><td>" . $row["relation"] . "</td></tr>";
	}
 ?>

 </table>