<?php
require_once("user_conf.php");
session_start();
include_once('templates/'.$theme.'/header.php');
if (isset($_SESSION[ 'valid_user' ])) {
	echo '<h1>add dns record</h1>';
	echo '<form method="post" action="dns_add_result.php">';
	echo '<div class="form-group">';
	echo '<label for="zone">zone</label><input type="text" class="form-control" id="zone" name="zone" placeholder="chinafreebsd.cn" value="chinafreebsd.cn" />';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="host">host</label><input type="text" class="form-control" id="host" name="host" placeholder="@" value="@">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="type">type</label><input type="text" class="form-control" id="type" name="type" placeholder="" value="">';
	echo '<div class="form-group">';
	echo '<label for="type">type</label>
                                <select id="type" name="type" class="selectpicker show-tick form-control" data-live-search="false">
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
	echo '<label for="data">data</label><input data="text" class="form-control" id="data" name="data" placeholder="" value="">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="ttl">ttl</label><input ttl="text" class="form-control" id="ttl" name="ttl" placeholder="800" value="800">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="mx_priority">mx_priority</label><input mx_priority="text" class="form-control" id="mx_priority" name="mx_priority" placeholder="" value="">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="refresh">refresh</label><input refresh="text" class="form-control" id="refresh" name="refresh" placeholder="3600" value="3600">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="retry">retry</label><input retry="text" class="form-control" id="retry" name="retry" placeholder="3600" value="3600">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="expire">expire</label><input expire="text" class="form-control" id="expire" name="expire" placeholder="86400" value="86400">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="minimum">minimum</label><input minimum="text" class="form-control" id="minimum" name="minimum" placeholder="3600" value="3600">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="serial">serial</label><input serial="text" class="form-control" id="serial" name="serial" placeholder="2008082700" value="2008082700">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="resp_person">resp_person</label><input resp_person="text" class="form-control" id="resp_person" name="resp_person" placeholder="root.chinafreebsd.cn" value="root.chinafreebsd.cn">';
	echo '</div>';
	echo '<div class="form-group">';
	echo '<label for="primary_ns">primary_ns</label><input primary_ns="text" class="form-control" id="primary_ns" name="primary_ns" placeholder="ns1.chinafreebsd.cn" value="ns1.chinafreebsd.cn">';
	echo '</div>';
	echo '&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Add</button>';
	echo '</form>';
} else {
	echo 'Please login in.';
}
include_once('templates/'.$theme.'/footer.php');
?>
