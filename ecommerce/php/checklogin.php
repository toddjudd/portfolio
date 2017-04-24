<?php 

require_once 'db_functions.php';
session_start();

$date = db_date();
$ucheck = $_POST['username'];
$pcheck = $_POST['password'];

$ucheck = stripcslashes($ucheck);
$ucheck = mysql_real_escape_string($ucheck);

$pcheck = stripcslashes($pcheck);
$pcheck = mysql_real_escape_string($pcheck);

$user = db_select("SELECT * FROM users WHERE username = $ucheck");

if (count($user) == 1) {
	$row = $user[1];
	if (password_verify($upass, $row['password'])) {
		$_SESSION['usersession'] = $row['user_id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['name'] = $row['firstName']." ".$row['lastName'];
		$_SESSION['userpass'] = $row['password'];
		$_SESSION['userrow'] = $row;
		header("location: store");
	} else{
		echo "Password didn't verify";
	}
} elseif (count($user) > 1) {
	echo "multiple usere pulled";
} else {
	echo "no user pulled";
}
?>