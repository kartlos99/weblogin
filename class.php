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

					header("Location: http://localhost/weblogin/login.php");
					
				}else{
					die('ver xerxdeba registracia, chawera');
				}
					
			}
				
		}

	}


}

// insantiate the class
$myop = new Webop;

?>