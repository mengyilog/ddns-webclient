<?php

$length=16;
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789./';
$salt = '';
for ( $i = 0; $i < $length; $i++ )
{
$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
}

echo $password;
echo "\n";
echo crypt('123456', '$6$'.$password.'$');
echo "\n";
?>
