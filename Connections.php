<?php 
$hostname_localhost ="localhost";
$database_localhost ="traffic_map";
$username_localhost ="root";
$password_localhost ="cyber";
$localhost = mysql_connect($hostname_localhost,$username_localhost,$password_localhost)
or
trigger_error(mysql_error(),E_USER_ERROR);
//echo $localhost;
?>