<?php
require_once('load.php');
$act = $_GET['action'];
if( $act == 'logout'){
	$loggedout = $myop->logout();
}

//$logged = $myop->login('index.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>
<h3>login page</h3>
</body>
</html>