<?php
session_start();
if (isset($_SESSION[ 'valid_user' ])) {
	$db_conn = new mysqli( 'localhost', 'root', '123456', 'DNS');

	if ($mysqli_connect_errno) {
		echo $mysqli_connect_errno;
		echo 'Connection to database failed:'.mysqli_connect_error();
		exit();
	}
	$valid_user_query = 'select * from users_info '
		.'where nickname= "'.$_SESSION[ 'valid_user' ].'"';
	$valid_user_results = $db_conn->query($valid_user_query);
	$valid_user_row = $valid_user_results->fetch_assoc();
	$dns_query = 'select * from dns_records '
		.'where id= "'.$_POST[ 'id' ].'"';
	$dns_results = $db_conn->query($dns_query);
	$dns_row = $dns_results->fetch_assoc();
	if ($valid_user_row[ 'is_admin' ] || ($valid_user_row[ 'id' ] == $dns_row[ 'user_id' ])) {
		$update_query = 'update dns_records set ';
		if (stripslashes($_POST[ 'zone' ]) != $dns_row[ 'zone' ])
			$update_query .= ' zone="'.$_POST["zone"].'", ';
		if (stripslashes($_POST[ 'host' ]) != $dns_row[ 'host' ])
			$update_query .= ' host="'.$_POST["host"].'", ';
		if (stripslashes($_POST[ 'type' ]) != $dns_row[ 'type' ])
			$update_query .= ' type="'.$_POST["type"].'", ';
		if (stripslashes($_POST[ 'data' ]) != $dns_row[ 'data' ]) {
			if ($_POST["data"] !='')
				$update_query .= ' data="'.$_POST["data"].'", ';
			else
				$update_query .= ' data=NULL, ';
		}
		if (stripslashes($_POST[ 'ttl' ]) != $dns_row[ 'ttl' ])
			$update_query .= ' ttl="'.$_POST["ttl"].'", ';
		if (stripslashes($_POST[ 'ttl' ]) != $dns_row[ 'ttl' ])
			$update_query .= ' ttl="'.$_POST["ttl"].'", ';
		if (stripslashes($_POST[ 'mx_priority' ]) != $dns_row[ 'mx_priority' ]) {
			if ($_POST[ 'mx_priority' ] != '')
				$update_query .= ' mx_priority="'.$_POST["mx_priority"].'", ';
			else
				$update_query .= ' mx_priority=NULL, ';

		}
		if (stripslashes($_POST[ 'refresh' ]) != $dns_row[ 'refresh' ])
			$update_query .= ' refresh="'.$_POST["refresh"].'", ';
		if (stripslashes($_POST[ 'retry' ]) != $dns_row[ 'retry' ])
			$update_query .= ' retry="'.$_POST["retry"].'", ';
		if (stripslashes($_POST[ 'expire' ]) != $dns_row[ 'expire' ])
			$update_query .= ' expire="'.$_POST["expire"].'", ';
		if (stripslashes($_POST[ 'minimum' ]) != $dns_row[ 'minimum' ])
			$update_query .= ' minimum="'.$_POST["minimum"].'", ';
		if (stripslashes($_POST[ 'serial' ]) != $dns_row[ 'serial' ])
			$update_query .= ' serial="'.$_POST["serial"].'", ';
		if (stripslashes($_POST[ 'resp_person' ]) != $dns_row[ 'resp_person' ])
			$update_query .= ' resp_person="'.$_POST["resp_person"].'", ';
		if (stripslashes($_POST[ 'primary_ns' ]) != $dns_row[ 'primary_ns' ])
			$update_query .= ' primary_ns="'.$_POST["primary_ns"].'", ';
		if ($update_query != 'update dns_records set ') {
			$update_query = substr($update_query, 0, -2);
			$update_query .= ' where id="'.$_POST[ 'id' ].'";';
			$update_results = $db_conn->query($update_query);
			$db_conn->close();
			require('dns_select.php');
		} else {
			echo '<html><body>update failed!</body></html>';
		}
	} else {
			$db_conn->close();
	}
}
?>
