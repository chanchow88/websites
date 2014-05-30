<?php 
require_once('Connections.php'); 
mysql_select_db($database_localhost,$localhost);

// JSON decode doesn't work for the the array string we are passing. So we have to use this way
$input = file_get_contents('php://input');
logToFile("post.txt",$input);
//date_default_timezone_set('America/New_York');
function logToFile($filename,$msg)
{
      $fd=fopen($filename,"w");
      $str="[".date("Y/m/d h:i:s")."]".$msg;
      fwrite($fd,$str."\n");
      fclose($fd);
}

//PARSING THE DATA TO LOAD INTO gpstraces_old table
$file = file_get_contents('./post.txt', true);
	//echo $file;
$file_rmDate = substr($file,21);
echo $file_rmDate;
$obj = json_decode($file_rmDate);
print $obj->{''};
print $obj->{'device_ID'};
