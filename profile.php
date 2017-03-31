<?php
require_once("user_conf.php");
session_start();
include_once('templates/'.$theme.'/header.php');
if (isset($_SESSION[ 'valid_user' ])) {
	$db_conn = new mysqli( $hostname, $database_username, $database_password, $database_name);

	if ($mysqli_connect_errno) {
		echo $mysqli_connect_errno;
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}
	echo '<center>';
	echo '<h1>select result</h1>';
	$valid_user_query = 'select * from users_info '
		.'where nickname= "'.$_SESSION[ 'valid_user' ].'"';
	$valid_user_results = $db_conn->query($valid_user_query);
	$valid_user_row = $valid_user_results->fetch_assoc();
	// custom user info show , nickname is read only
	if (stripslashes($valid_user_row[ 'is_admin' ])) {
	// admin user info show, can remove user, modify user as admin, remove
	}
	$db_conn->close();
}
include_once('templates/'.$theme.'/footer.php');
?>
