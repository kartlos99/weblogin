<?php 

require_once('load.php');

$current = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

// $link = mysqli_connect('localhost', 'root', '12312', 'test');
// 			if(!$link){
// 				die('canNot connect db'.mysql_error());
// 			}

// $sql= "insert into users (id, name, username, pass, email, regdate) values ('', 'mee', 'me2', '7442a2bcdfa74b86285ed7607c07b3d76db9462c76b8943757f9e9794ac34889de11192e727f8c52510b8cb569efd42833b00ff15b2187a263dfb9363f416f19', 'm----22', '1519383516')";

// $result = $link->query($sql);
// $result = mysqli_query($link, $sql);
// // $result = false;
    
// while($rs = mysqli_fetch_assoc($result)) {
//     $arr[] = $rs;
//       echo implode(" * ",$rs);
//       echo "\n";
//     $id_arr[] = $rs['id'];
// }

 // echo $_SERVER['PHP_SELF'];;

$ll = $db_f->delta();

//echo $ll;
header("Location: $ll");



?>