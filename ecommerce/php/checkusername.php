<?php 

require_once 'db_functions.php';
$username = $_GET['username'];
$query = db_select("SELECT username FROM user2 WHERE username = '$username'");
if ($query[0] != "") {
	echo "<br><span style='color:red; font-size:8pt;'>Username Taken!</span>";
} elseif ($username == "") {
	echo "<br><span style='color:#D78A76; font-size:8pt;'>Username Required</span>";
} else {
	echo "<br><span style='color:green; font-size:8pt;'>Username Avaliable</span>";
}

?>