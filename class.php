<?php 

if(!class_exists('Webop')){

	/**
	*  main class , web operation
	*/
	class Webop
	{
	
		function __construct()
		{
			# code...
		}

		function register($redirect){
			global $db_f;

			$current = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

			//$referrer = $_SERVER['HTTP_REFERER'];

			if( !empty( $_POST['username'] ) && !empty( $_POST['password'] )){
				
				require_once('db.php');
				$link = mysqli_connect('localhost', 'root', '12312', 'test');
				$table = 'users';
				$fields = array('name', 'username', 'pass', 'email', 'regdate');

				$name = $_POST['name'];
				$username = $_POST['username'];
				$pass = $_POST['password'];
				$email = $_POST['email'];
				$regdate = $_POST['regdate'];

				$hashedPass = $db_f->hash_password($pass);

				$values = array($name, $username, $hashedPass, $email, $regdate );

				$chawera = $db_f->insert($link, $table, $fields, $values);

				if($chawera == true){
					$url = "http". ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
					
					$url = str_replace('register.php', $redirect, $url);

					header("Location: $url?action=regtrue");
					
				}else{
					die('ver xerxdeba registracia, chawera');
				}
					
			}
				
		}


		function login($redirect){
			global $db_f;

			if( !empty( $_POST )){
				
				$subname = $_POST['username'];
				$subpass = $_POST['password'];

				$link = mysqli_connect('localhost', 'root', '12312', 'test');
				$table = 'users';

				$sql = "SELECT * FROM $table WHERE username = '".$subname."'";

				$results = $link->query($sql);
				if(!$results){
					die('aseti momxmarebeli ar arsebobs!');
				}

				$results = mysqli_fetch_assoc($results);

				$stordate = $results['regdate'];
				$storpass = $results['pass'];

				$subpass = $db_f->hash_password($subpass);

				if($subpass == $storpass){

					$authnonce = md5('cookie-'.$subname);
					$authID = hash_hmac('sha512', $subpass, $authnonce);

					setcookie('k_user', $subname, 0, '', '', '', true);
					setcookie('k_authID', $authID, 0, '', '', '', true);

					$url = "http". ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
					
					$url = str_replace('login.php', $redirect, $url);
	
					header("Location: $url");
				} else {
					return 'invalid';
				}

			} else {
				return 'empty';
			}

		}


		function logout(){
			$user_out = setcookie('k_user', '', -3600, '', '', '', true);
			$id_out = setcookie('k_authID', '', -3600, '', '', '', true);

			if( $user_out == true && $id_out == true){
				return true;
			} else {
				return false;
			}
		}

		function checklogin(){
			global $db_f;

			$username = $_COOKIE['k_user'];
			$authID = $_COOKIE['k_authID'];

			if( !empty($username)){
				$table = 'users';
				$link = mysqli_connect('localhost', 'root', '12312', 'test');
				$sql = "SELECT * FROM $table WHERE username = '".$username."'";

				$results = $link->query($sql);

				if(!$results){
					die('aseti momxmarebeli ar arsebobs!');
				}

				$results = mysqli_fetch_assoc($results);

				$storpass = $results['pass'];

				$authnonce = md5('cookie-'.$username);
				$storpass = hash_hmac('sha512', $storpass, $authnonce);

				if( $storpass == $authID ){
					return true;
				} else {
					return false;
				}
			} else {
				$url = "http". ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				$redirect = str_replace('index.php', 'login.php', $url);
				header("Location: $redirect?action=login");
				exit;
			}
		}

	}


}

// insantiate the class
$myop = new Webop;

?>