<?php
/**
 * Database functions for a MySQL with PHP tutorial
 * 
 * @copyright Eran Galperin
 * @license MIT License
 */

/**
 * Connect to the database
 * 
 * @return bool false on failure / mysqli MySQLi object instance on success
 */
function db_connect() {
	

	// Define connection as a static variable, to avoid connecting more than once 
	static $connection;

	// Try and connect to the database, if a connection has not been established yet
	if(!isset($connection)) {
		// Load configuration as an array. Use the actual location of your configuration file
		// Put the configuration file outside of the document root
		$config = parse_ini_file('config.ini'); 
		$connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
	}

	// If connection was not successful, handle the error
	if($connection === false) {
		// Handle error - notify administrator, log to a file, show an error screen, etc.
		return mysqli_connect_error(); 
	}
	return $connection;
}

/**
 * Query the database
 *
 * @param $query The query string
 * @return mixed The result of the mysqli::query() function
 */
function db_query($query) {
	// Connect to the database
	$connection = db_connect();

	// Query the database
	$result = mysqli_query($connection,$query);

	return $result;
}

/**
 * Fetch rows from the database (SELECT query)
 *
 * @param $query The query string
 * @return bool False on failure / array Database rows on success
 */
function db_select($query) {
	$rows = array();
	$result = db_query($query);

	// If query failed, return `false`
	if($result === false) {
		return false;
	}

	// If query was successful, retrieve all the rows into an array
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

/**
 * Fetch the last error from the database
 * 
 * @return string Database error message
 */
function db_error() {
	$connection = db_connect();
	return mysqli_error($connection);
}

/**
 * Quote and escape value for use in a database query
 *
 * @param string $value The value to be quoted and escaped
 * @return string The quoted and escaped string
 */
function db_quote($value) {
	$connection = db_connect();
	return "'" . mysqli_real_escape_string($connection,$value) . "'";
}

function db_table_keys($table) {
	$sql = "SELECT * FROM $table";
	$result = db_query($sql);
	if ($result->num_rows > 0) {
		$rows = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
	} else {
		break;
	}
	while (list($key, $value) = each($rows[0])) {
		$keys[] = $key;
	}
	return $keys;
}

function db_secure() {

	$MySQLi_CON = db_connect();
	if(!isset($_SESSION['userSession']))
	{
	  header("Location: http://ouconstruct.com/login.php");
	}

	$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
	$userRow=$query->fetch_array();
	$user = $userRow['user_name'];
	$userId = $_SESSION['userSession'];
}

function db_date() {
	//Creates date
		date_default_timezone_set('America/Denver');
		$date = date_create();
		$today = date_format($date, 'Y-m-d');
		return $today;
}

function db_ip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
	  $ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
 * Quote and escape value for use in a database query
 *
 * @param string $clearanceLevel The int to compare to the users clearance level.
 * @param string $errMsg string contaning an error message.
*/
function db_clearnce_check($clearanceLevel, $errMsg) {
	//get user CL
	$userRow = db_select("SELECT * FROM users WHERE user_id='{$_SESSION['userSession']}'");
	$userClearanceLevel = $userRow[0]['clearance_level'];
	if ($userClearanceLevel < $clearanceLevel) {
		$ip = db_ip();
		$errorMsg = '{"ip":"'.$ip.'}","user_id":'.$_SESSION['userSession'].',"error_msg_given":"'.$errMsg.'","url_attempt":"'.$_SERVER['HTTP_REFERER'].'"},';
		$querry = db_query("INSERT INTO errors (error_id, error_msg) VALUES (NULL, '$errorMsg')");
		die($errMsg);
	}
}
?>