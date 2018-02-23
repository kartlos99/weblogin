<?php
require_once('load.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>mtavari gverdi</h3>
	<h1><?php
	include_once('config.php');
	echo $_SERVER['HTTP_HOST']. $_SERVER['PHP_SELF'];
	echo '<br>';
	echo $_SERVER['SERVER_NAME'];
	//echo dirname(__FILE__). '/config.php';

	//echo "ok mf";
	?></h1>

<p>kartlos</p>
</body>
</html>
