<?php
require_once("user_conf.php");
session_start();
include_once('templates/'.$theme.'/header.php');
if (isset($_POST[ 'nickname' ])) {
	$nickname = stripslashes($_POST[ 'nickname' ]);
	$fullname = stripslashes($_POST[ 'fullname' ]);
	$sex = stripslashes($_POST[ 'sex' ]);
	$email = stripslashes($_POST[ 'email' ]);
	$password = stripslashes($_POST[ 'password' ]);


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

	if ($nickname != '' && $fullname != '' && $sex != '' && $email != '' && $password != '') {
		$query = 'insert into users_info(nickname, fullname, email, hash, salt, sex) values ("'.$nickname.'", "'.$fullname.'", "'.$email.'", "'.$hash_value.'", "'.$salt_value.'", "'.$sex.'")';

		$result = $db_conn->query($query);
		if ($result) {
			echo '<a href="login.php">Register success, login please!</a>';
		} else {
			echo 'Register failed!<a href="register.php">Redo register!</a>';
		}
	} else {
		echo 'Please fill every item!&nbsp;&nbsp;&nbsp;&nbsp;<a href="register.php">regiter</a>';
	}
	$db_conn->close();
} else {
echo '<h1>Register</h1>';
echo '<form method="post" action="register.php">';
echo '<div class="form-group">';
echo '<label for="username">Username</label>
      <input type="text" id="username" class="form-control" name="nickname" placeholder="username">';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="fullname">Fullname</label>
      <input type="text" id="fullname" class="form-control" name="fullname" placeholder="fullname">';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="email">Email</label>
      <input type="email" id="email" class="form-control" name="email" placeholder="email">';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="password">Password</label>
      <input type="password" id="password" class="form-control" name="password" placeholder="password">';
echo '</div>';
echo '<div class="form-group">';
echo '<div class="radio-inline">';
echo '<label><input type="radio" name="sex" id="sex1" value="1" checked>man</label>';
echo '</div>';
echo '<div class="radio-inline">';
echo '<label><input type="radio" name="sex" id="sex2" value="2">woman</label>';
echo '</div>';
echo '<div class="radio-inline">';
echo '<label><input type="radio" name="sex" id="sex3" value="3">intersex</label>';
echo '</div>';
echo '</div>';
echo '<button type="submit" class="btn btn-success">register</button>';
echo '</form>';
}
include_once('templates/'.$theme.'/header.php');
?>
