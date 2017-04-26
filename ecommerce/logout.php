<?php
session_start();

if(!isset($_SESSION['userSession']))
{
	header("Location: login");
}
else if(isset($_SESSION['userSession'])!="")
{
	header("Location: store");
}

if(isset($_GET['logout']))
{
	$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
	header("Location: https://toddjudd.com/ecommerce/login");
}

?>