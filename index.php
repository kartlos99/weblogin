<?php
require_once('load.php');
$logged = $myop->checklogin();

if ($logged == false){
	$url = "http". ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	$redirect = str_replace('index.php', 'login.php', $url);
	header("Location: $redirect?action=login");
	exit;
} else {
	$username = $_COOKIE['k_user'];
	$authID = $_COOKIE['k_authID'];

	$table = 'users';
	$sql = "SELECT * FROM $table WHERE username = '".$username."'";

	$results = $link->query($sql);

	if(!$results){
		die('aseti momxmarebeli ar arsebobs!');
	}

	$results = mysqli_fetch_assoc($results);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>mtavari gverdi</title>
	<link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
 	<div class="rigthtext"><a href="login.php?action=logout">logout</a></div>
	<div style="width: 960px; background: #fff; border: 1px solid #e4e4e4; padding: 20px; margin: 10px auto;">
		<h3>mtavari gverdi</h3>
		<p><b>user info</b></p>
		<table>
				<tr>
					<td>Name: </td>
					<td><?php echo $results['name'] ?></td>
				</tr>
				<tr>
					<td>Username: </td>
					<td><?php echo $results['username'] ?></td>
				</tr>
				<tr>
					<td>Email: </td>
					<td><?php echo $results['email'] ?></td>
				</tr>
				<tr>
					<td>date: </td>
					<td><?php echo date('l, F j, Y',$results['regdate']) ?></td>
				</tr>
			</table>

	</div>


</body>
</html>
