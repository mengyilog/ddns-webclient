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
		$select_query = 'select * from dns_records where id="'.$_POST[ "dns_id" ].'"';
		$select_result = $db_conn->query($select_query);
		$select_row = $select_result->fetch_assoc();

		echo '<center>';
		echo '<h1>update dns record</h1>';
		echo '</center>';
		echo '<form method="post" action="dns_update_result.php">';
		echo '<div class="form-group">';
		echo '<label for="id">id</label><input type="text" class="form-control" id="id" name="id" value="'.$select_row[ 'id' ].'" placeholder="'.$select_row[ 'id' ].'" readonly>';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="zone">zone</label><input type="text" class="form-control" id="zone" name="zone" value="'.$select_row[ 'zone' ].'" placeholder="'.$select_row[ 'zone' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="host">host</label><input type="text" class="form-control" id="host" name="host" value="'.$select_row[ 'host' ].'" placeholder="'.$select_row[ 'host' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="type">type</label>';
                echo '<select id="type" name="type" class="selectpicker show-tick form-control" data-live-search="false">';
                echo '                  <option value="'.$select_row[ 'type' ].'">'.$select_row[ 'type' ].'</option>
                                        <option value="SOA">SOA</option>
                                        <option value="A">A</option>
                                        <option value="PTR">PTR</option>
                                        <option value="CNAME">CNAME</option>
                                        <option value="NS">NS</option>
                                        <option value="TEXT">TEXT</option>
                                        <option value="MX">MX</option>
                      </select>';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="data">data</label><input data="text" class="form-control" id="data" name="data" value="'.$select_row[ 'data' ].'" placeholder="'.$select_row[ 'data' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="ttl">ttl</label><input ttl="text" class="form-control" id="ttl" name="ttl" value="'.$select_row[ 'ttl' ].'" placeholder="'.$select_row[ 'ttl' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="mx_priority">mx_priority</label><input mx_priority="text" class="form-control" id="mx_priority" name="mx_priority" value="'.$select_row[ 'mx_priority' ].'" placeholder="'.$select_row[ 'mx_priority' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="refresh">refresh</label><input refresh="text" class="form-control" id="refresh" name="refresh" value="'.$select_row[ 'refresh' ].'" placeholder="'.$select_row[ 'refresh' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="retry">retry</label><input retry="text" class="form-control" id="retry" name="retry" value="'.$select_row[ 'retry' ].'" placeholder="'.$select_row[ 'retry' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="expire">expire</label><input expire="text" class="form-control" id="expire" name="expire" value="'.$select_row[ 'expire' ].'" placeholder="'.$select_row[ 'expire' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="minimum">minimum</label><input minimum="text" class="form-control" id="minimum" name="minimum" value="'.$select_row[ 'minimum' ].'" placeholder="'.$select_row[ 'minimum' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="serial">serial</label><input serial="text" class="form-control" id="serial" name="serial" value="'.$select_row[ 'serial' ].'" placeholder="'.$select_row[ 'serial' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="resp_person">resp_person</label><input resp_person="text" class="form-control" id="resp_person" name="resp_person" value="'.$select_row[ 'resp_person' ].'" placeholder="'.$select_row[ 'resp_person' ].'">';
  		echo '</div>';
		echo '<div class="form-group">';
		echo '<label for="primary_ns">primary_ns</label><input primary_ns="text" class="form-control" id="primary_ns" name="primary_ns" value="'.$select_row[ 'primary_ns' ].'" placeholder="'.$select_row[ 'primary_ns' ].'">';
  		echo '</div>';
		echo '<center>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Update</button></center>';
		echo '</form>';
	}
} else {
	echo 'Please login in.';
}
include_once('templates/'.$theme.'/footer.php');
?>
