<?php
require_once("user_conf.php");
session_start();
include_once('templates/'.$theme.'/header.php');

echo '<h1>Members only</h1>';

if (isset($_SESSION[ 'valid_user' ])) {
	echo '<p>You are logged in as '.$_SESSION[ 'valid_user' ].'</p>';
	echo '<p>Members only content goes here</p>';
} else {
	echo '<p>You are not logged in.</p>';
	echo '<p>Only logged in members may see this page.</p>';
}

echo '<a href="login.php">Backup to main page</a><br />';
	include_once('templates/'.$theme.'/footer.php');
?>
