<?php 

require_once 'db_functions.php';
session_start();

$date = db_date();
$link = db_connect();

$ucheck = mysqli_escape_string($link, stripcslashes($_POST['username']));
$pcheck = mysqli_escape_string($link, stripcslashes($_POST['password']));

$pcheck = hash(ripemd160, "saltdat".$pcheck."saltadded");

$user = db_select("SELECT * FROM user2 WHERE username = '$ucheck' AND password = '$pcheck'");
// print_r($user);
if (count($user) == 1) {
	$_SESSION['usersession'] = $user[0]['user_id'];
	$_SESSION['username'] = $user[0]['username'];
	$_SESSION['name'] = ucfirst("{$user[0]['firstname']} {$user[0]['lastname']}");
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['email'] = $user[0]['email'];
	$_SESSION['userrow'] = $user[0];
	print_r($_SESSION);
	header("location: http://toddjudd.com/ecommerce/store");
} else {
	header("location: http://toddjudd.com/ecommerce/login?f=t");
}

?>