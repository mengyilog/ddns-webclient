<?php
	require_once("user_conf.php");
session_start();
include_once('templates/'.$theme.'/header.php');
if (isset($_POST[ 'nickname' ])) {
	$nickname = $_POST[ 'nickname' ];
	$fullname = $_POST[ 'fullname' ];
	$sex = $_POST[ 'sex' ];
	$email = $_POST[ 'email' ];
	$password = $_POST[ 'password' ];


	$salt_length=16;
	$salt_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789./';
	$salt_value = '';
	for ( $i = 0; $i < $salt_length; $i++ )
	{
		$salt_value .= $salt_chars[ mt_rand(0, strlen($salt_chars) - 1) ];
	}
	$hash_value = crypt($password, '$6$'.$salt_value.'$');

	$db_conn = new mysqli( 'localhost', 'root', '123456', 'DNS');

	if ($mysqli_connect_errno) {
		echo $mysqli_connect_errno;
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}

	$query = 'insert into users_info(nickname, fullname, email, hash, salt, sex) values ("'.$nickname.'", "'.$fullname.'", "'.$email.'", "'.$hash_value.'", "'.$salt_value.'", "'.$sex.'")';

	$result = $db_conn->query($query);
	if ($result) {
		echo '<a href="login.php">Register success, login please!</a>';
	} else {
		echo 'Register failed!<a href="register.php">Redo register!</a>';
	}
	$db_conn->close();
} else {
echo '<h1>Register</h1>';
echo '<form method="post" action="register.php">';
echo '<table>';
echo '<tr><td>nickname:</td>';
echo '<td><input type="text" name="nickname"></td></tr>';
echo '<tr><td>fullname:</td>';
echo '<td><input type="text" name="fullname"></td></tr>';
echo '<tr><td>Sex:</td>';
echo '<td><input type="radio" name="sex" value="1" />man</td>';
echo '<td><input type="radio" name="sex" value="2" />woman</td>';
echo '<td><input type="radio" name="sex" value="3" />intersex</td></tr>';
echo '<tr><td>email:</td>';
echo '<td><input type="email" name="email"></td></tr>';
echo '<tr><td>Password:</td>';
echo '<td><input type="password" name="password"></td></tr>';
echo '<tr><td colspan="2" align="center">';
echo '<input type="submit" value="Log in"></td></tr>';
echo '</table></form>';
}
include_once('templates/'.$theme.'/header.php');
?>
