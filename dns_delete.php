<?php
require_once("user_conf.php");
session_start();
include_once('templates/'.$theme.'/header.php');
if (isset($_SESSION[ 'valid_user' ])) {
	if (isset($_POST[ 'dns_id' ])) {
		$db_conn = new mysqli( $hostname, $database_username, $database_password, $database_name);

		if ($mysqli_connect_errno) {
			echo $mysqli_connect_errno;
			echo 'Connection to database failed:'.mysqli_connect_error();
			exit();
		}
		$delete_query = 'delete from dns_records where id="'.$_POST[ "dns_id" ].'"';
		$delete_result = $db_conn->query($delete_query);
		if ($delete_result) {
			require('dns_select.php');
		} else {
			echo '<html><body>add failed!</body></html>';
		}
	}
}
?>
