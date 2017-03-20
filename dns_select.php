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
	if (stripslashes($valid_user_row[ 'is_admin' ])) {
		echo '<table class="table table-bordered">';
		echo '<tr><th class="hidden">id</th>';
		echo '<th>user</th>';
		echo '<th>zone</th>';
		echo '<th>host</th>';
		echo '<th>type</th>';
		echo '<th>data</th>';
		echo '<th>ttl</th>';
		echo '<th>mx_priority</th>';
		echo '<th>refresh</th>';
		echo '<th class="hidden">retry</th>';
		echo '<th class="hidden">expire</th>';
		echo '<th class="hidden">minimum</th>';
		echo '<th class="hidden">serial</th>';
		echo '<th>resp_person</th>';
		echo '<th>primary_ns</th>';
		echo '<th>Modify</th>';
		echo '<th>Delete</th></tr>';
		$user_query = 'select * from users_info';
		$user_result = $db_conn->query($user_query);
		$user_num_results = $user_result->num_rows;
		if ($user_num_results) {
			for ($i=0; $i<$user_num_results; $i++) {
				$user_row = $user_result->fetch_assoc();
				$dns_record_query = 'select * from dns_records '
					.'where user_id= "'.$user_row[ 'id' ].'"';
				$dns_record_results = $db_conn->query($dns_record_query);
				$dns_record_num_results = $dns_record_results->num_rows;
				if ($dns_record_num_results) {
					for ($j=0; $j < $dns_record_num_results; $j++) {
						$dns_record_row = $dns_record_results->fetch_assoc();
						//echo '<tr><form acion="post" script="dns_delete.php"><td class="hidden"><input name="dns_id" value="'.stripslashes($dns_record_row[ 'id' ]).'" readonly></td>';
						echo '<tr><td class="hidden"><input name="dns_id" value="'.stripslashes($dns_record_row[ 'id' ]).'" readonly></td>';
						echo '<td>'.stripslashes($user_row[ 'nickname' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'zone' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'host' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'type' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'data' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'ttl' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'mx_priority' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'refresh' ]).'</td>';
						echo '<td class="hidden">'.stripslashes($dns_record_row[ 'retry' ]).'</td>';
						echo '<td class="hidden">'.stripslashes($dns_record_row[ 'expire' ]).'</td>';
						echo '<td class="hidden">'.stripslashes($dns_record_row[ 'minimum' ]).'</td>';
						echo '<td class="hidden">'.stripslashes($dns_record_row[ 'serial' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'resp_person' ]).'</td>';
						echo '<td>'.stripslashes($dns_record_row[ 'primary_ns' ]).'</td>';
						echo '<td><form method="post" action="dns_update.php"><input name="dns_id" value="'.stripslashes($dns_record_row[ 'id' ]).'" hidden><button type="submit" class="btn btn-warning">Modify</button></form></td>';
						echo '<td><form method="post" action="dns_delete.php"><input name="dns_id" value="'.stripslashes($dns_record_row[ 'id' ]).'" hidden><button type="submit" class="btn btn-warning">Delete</button></form></td></tr>';
					}
				}
			}
		}
		echo '</table>';
	} else {
		$userid = stripslashes($valid_user_row[ 'id' ]);
		echo '<table class="table table-bordered">';
		echo '<tr><th class="hidden">id</th>';
		echo '<th>zone</th>';
		echo '<th>host</th>';
		echo '<th>type</th>';
		echo '<th>data</th>';
		echo '<th>ttl</th>';
		echo '<th>mx_priority</th>';
		echo '<th>refresh</th>';
		echo '<th class="hidden">retry</th>';
		echo '<th class="hidden">expire</th>';
		echo '<th class="hidden">minimum</th>';
		echo '<th class="hidden">serial</th>';
		echo '<th>resp_person</th>';
		echo '<th>primary_ns</th>';
		echo '<th>Modify</th>';
		echo '<th>Delete</th></tr>';
		$query = 'select * from dns_records '
			.'where user_id= "'.$userid.'"';
		$result = $db_conn->query($query);
		$num_results = $result->num_rows;
		if ($num_results) {
			for ($i=0; $i < $num_results; $i++) {
				$row = $result->fetch_assoc();
				echo '<tr><td class="hidden">'.stripslashes($row[ 'id' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'zone' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'host' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'type' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'data' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'ttl' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'mx_priority' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'refresh' ]).'</td>';
				echo '<td class="hidden">'.stripslashes($row[ 'retry' ]).'</td>';
				echo '<td class="hidden">'.stripslashes($row[ 'expire' ]).'</td>';
				echo '<td class="hidden">'.stripslashes($row[ 'minimum' ]).'</td>';
				echo '<td class="hidden">'.stripslashes($row[ 'serial' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'resp_person' ]).'</td>';
				echo '<td>'.stripslashes($row[ 'primary_ns' ]).'</td>';
				echo '<td><form method="post" action="dns_update.php"><input name="dns_id" value="'.stripslashes($row[ 'id' ]).'" hidden><button type="submit" class="btn btn-warning">Modify</button></form></td>';
				echo '<td><form method="post" action="dns_delete.php"><input name="dns_id" value="'.stripslashes($row[ 'id' ]).'" hidden><button type="submit" class="btn btn-warning">Delete</button></form></td></tr>';
			}
		}
		echo '</table>';

	}
	echo '<p><a href="dns_add.php" class="btn btn-success btn-lg">add</a>';
	$db_conn->close();
}
include_once('templates/'.$theme.'/footer.php');
?>
