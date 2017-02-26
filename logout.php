<?php
	require_once("user_conf.php");
?>
<?php
session_start();
$old_user = $_SESSION[ 'valid_user' ];
unset($_SESSION[ 'valid_user' ]);
session_destroy();
?>
<?php
	include_once('templates/'.$theme.'/header.php');
?>
<?php
if (!empty($old_user)) {
	echo '<center>';
	echo 'Logged out.<br />';
	echo '</center>';
} else {
	echo '<center>';
	echo 'Warning: You were not logged in, and so have not been logged out.<br />';
	echo '</center>';
}
	include_once('templates/'.$theme.'/footer.php');
?>
