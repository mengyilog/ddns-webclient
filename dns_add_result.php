<?php
require_once("user_conf.php");
session_start();
if (isset($_SESSION[ 'valid_user' ])) {
	$db_conn = new mysqli( $hostname, $database_username, $database_password, $database_name);

	if ($mysqli_connect_errno) {
		echo $mysqli_connect_errno;
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}
	$valid_user_query = 'select * from users_info '
		.'where nickname= "'.$_SESSION[ 'valid_user' ].'"';
	$valid_user_results = $db_conn->query($valid_user_query);
	$valid_user_row = $valid_user_results->fetch_assoc();
	if ( stripslashes($_POST[ 'zone' ]) && stripslashes($_POST[ 'host' ]) && stripslashes($_POST[ 'type' ]) && stripslashes($_POST[ 'ttl' ]) && stripslashes($_POST[ 'refresh' ]) && stripslashes($_POST[ 'retry' ]) && stripslashes($_POST[ 'expire' ]) && stripslashes($_POST[ 'minimum' ]) && stripslashes($_POST[ 'serial' ]) && stripslashes($_POST[ 'resp_person' ]) && stripslashes($_POST[ 'primary_ns' ]) ) {
		$insert_query = 'insert into dns_records(zone, host, type, data, ttl, mx_priority, refresh, retry, expire, minimum, serial, resp_person, primary_ns, user_id) values ("'.stripslashes($_POST[ 'zone' ]).'","'.stripslashes($_POST[ 'host' ]).'","'.stripslashes($_POST[ 'type' ]).'","'.stripslashes($_POST[ 'data' ]).'",'.stripslashes($_POST[ 'ttl' ]).',';
		if (!$_POST[ 'mx_priority' ]) {
			$insert_query .= 'NULL,'.stripslashes($_POST[ 'refresh' ]).','.stripslashes($_POST[ 'retry' ]).','.stripslashes($_POST[ 'expire' ]).','.stripslashes($_POST[ 'minimum' ]).','.stripslashes($_POST[ 'serial' ]).',"'.stripslashes($_POST[ 'resp_person' ]).'","'.stripslashes($_POST[ 'primary_ns' ]).'",'.stripslashes($valid_user_row[ 'id' ]).')';
		} else {
			$insert_query .= stripslashes($_POST[ 'mx_priority' ]).','.stripslashes($_POST[ 'refresh' ]).','.stripslashes($_POST[ 'retry' ]).','.stripslashes($_POST[ 'expire' ]).','.stripslashes($_POST[ 'minimum' ]).','.stripslashes($_POST[ 'serial' ]).',"'.stripslashes($_POST[ 'resp_person' ]).'","'.stripslashes($_POST[ 'primary_ns' ]).'",'.stripslashes($valid_user_row[ 'id' ]).')';
		}
		$insert_results = $db_conn->query($insert_query);
		$db_conn->close();
		if ($insert_results) {
			require('dns_select.php');
		} else {
			echo '<html><body>add failed!</body></html>';
		}
	} else {
		$db_conn->close();
		echo '<html><body>it has null value!</body></html>';
	}
}
?>
