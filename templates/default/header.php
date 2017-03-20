<?php
echo "<!DOCTYPE html>";
echo '<html lang="en">';
echo '<head>';
echo '<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"></link>';
echo '<title>';
echo '</title>';
echo '</head>';
echo '<body>';
echo '<div class="container-fluid">';
echo '<header>';
echo '<div class="row">';
echo '<center>';
if (isset($_SESSION[ 'valid_user' ])) {
	echo 'You are logged in as: '.$_SESSION[ 'valid_user' ].'&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a href="logout.php">Log out</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="dns_select.php">Home</a><br />';
	echo '<br />';
} else {
	echo '<center>';
	echo 'You are not logged in.';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="login.php">Login</a>';
	echo '</center>';
}
echo '</center>';
echo '</div>';
echo '</header>';
echo '<div class="row">';
echo '<div class="col-md-2">';
echo '</div>';
echo '<div class="col-md-8">';
?>
