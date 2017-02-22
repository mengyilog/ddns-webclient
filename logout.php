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
<h1>Log out</h1>
<?php
if (!empty($old_user)) {
	echo 'Logged out.<br />';
} else {
	echo 'You were not logged in, and so have not been logged out.<br />';
}
?>
<a href="login.php">Back to main page</a>
<br />
<?php
	include_once('templates/'.$theme.'/footer.php');
?>
