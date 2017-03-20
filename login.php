<?php
	require_once("user_conf.php");
?>
<?php
session_start();

if (!isset($_SESSION[ 'valid_user' ])) {
	if (isset($_POST[ 'nickname' ]) && isset($_POST[ 'password' ])) {
		$nickname = $_POST[ 'nickname' ];
		$password = $_POST[ 'password' ];
	
		$db_conn = new mysqli( $hostname, $database_username, $database_password, $database_name);
	
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
}
?>
<?php
	include_once('templates/'.$theme.'/header.php');
?>
<center><h1>HOME</h1></center>
<?php
if (isset($_SESSION[ 'valid_user' ])) {
	include("dns_select.php");
} else {
	echo '<center>';
	if (isset($nickname)) {
		echo 'Could not log you in.<br />';
	}

	echo '<form method="post" action="login.php">';
	echo '<div class="form-group">';
	echo '<label for="username">Username</label><input type="text" class="form-control" id="username" name="nickname" placeholder="Username">';
	echo '</div>';
	echo '<div class="form-group">';
    	echo '<label for="password">Password</label><input type="password" class="form-control" id="password" name="password" placeholder="Password">';
  	echo '</div>';
	echo '<a class="btn btn-info" href="register.php" role="button">Register</a>';
	echo '&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Login</button>';
	echo '</form>';
	echo '</center>';
}
include_once('templates/'.$theme.'/footer.php');
?>
