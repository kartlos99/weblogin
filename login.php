<?php
require_once('load.php');
$act = $_GET["action"];
if( $act == 'logout'){
	$loggedout = $myop->logout();
}

$logged = $myop->login('index.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
		<style type="text/css">
		body { background : #c7c7c7 }
	</style>
</head>
<body>

<div style="width: 960px; background: #fff; border: 1px solid #e4e4e4; padding: 20px; margin: 10px auto;">
	<h3>login page</h3>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<table>
				
				<tr>
					<td>Username</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"></td>
				</tr>
				<input type="hidden" name="regdate" value="54545454">
				<tr>
					<td></td>
					<td><input type="submit" value="login"/></td>
				</tr>
			</table>
			
		</form>
		<p>arsebuli momxmareblistvis <a href="login.php">login</a></p>

</body>
</html>