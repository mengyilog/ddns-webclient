<?php
	require_once("user_conf.php");
?>
<?php
session_start();

if (isset($_POST[ 'nickname' ]) && isset($_POST[ 'password' ])) {
	$nickname = $_POST[ 'nickname' ];
	$password = $_POST[ 'password' ];

	$db_conn = new mysqli( 'localhost', 'root', '123456', 'DNS');

	if ($mysqli_connect_errno) {
		echo $mysqli_connect_errno;
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}

	$query = 'select * from users_info '
		.'where nickname= "'.$nickname.'"';

	$result = $db_conn->query($query);
	$row = $result->fetch_assoc();
	$salt_value = stripslashes($row[ 'salt' ]);
	$hash = stripslashes($row[ 'hash' ]);
	$hash_value = crypt($password, '$6$'.$salt_value.'$');

	if ($hash == $hash_value) {
		$_SESSION[ 'valid_user' ] = $nickname;
	}
	$db_conn->close();
}
?>
<?php
	include_once('templates/'.$theme.'/header.php');
?>
<h1>Home page</h1>
<?php
if (isset($_SESSION[ 'valid_user' ])) {
	echo 'You are logged in as: '.$_SESSION[ 'valid_user' ].'<br />';
	echo '<a href="logout.php">Log out</a><br />';
} else {
	if (isset($nickname)) {
		echo 'Could not log you in.<br />';
	} else {
		echo 'You are not logged in.<br />';
	}

	echo '<form method="post" action="login.php">';
	echo '<table>';
	echo '<tr><td>User:</td>';
	echo '<td><input type="text" name="nickname"></td></tr>';
	echo '<tr><td>Password:</td>';
	echo '<td><input type="password" name="password"></td></tr>';
	echo '<tr><td colspan="2" align="center">';
	echo '<input type="submit" value="Log in"></td></tr>';
	echo '</table></form>';
}
?>
<br />
<a href="register.php">Register</a>
<br />
<a href="members_only.php">Members section</a>
<br />
<?php
	include_once('templates/'.$theme.'/footer.php');
?>
