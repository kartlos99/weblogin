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

			if( !empty( $_POST )){
				
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

					header("Location: $url?reg=true");
					
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
echo $url;
					header("Location: $url?");
				} else {
					return 'invalid';
				}


			} else {
					return 'empty';
			}

		}

	}


}

// insantiate the class
$myop = new Webop;

?>