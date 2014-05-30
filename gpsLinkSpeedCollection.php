<?php 
require_once('Connections.php'); 
mysql_select_db($database_localhost,$localhost);
// JSON decode doesn't work for the the array string we are passing. So we have to use this way
$input = file_get_contents('php://input');
echo $input;
logToFile("linkId.txt",$input);
//date_default_timezone_set('America/New_York');
function logToFile($filename,$msg)
{
      $fd=fopen($filename,"w");
      $str="[".date("Y/m/d h:i:s")."]".$msg;
      fwrite($fd,$str."\n");
      fclose($fd);
}
$file = file_get_contents('./linkId.txt', true);
//echo $file;
$file_rmDate = substr($file,21);
//echo $file_rmDate;
$obj = json_decode($file_rmDate);
//print_r($obj->{'LinkID'});
$count = count($obj->{'LinkID'});
//print_r($obj->{'device_ID'});
//print_r($obj->{'Link speed'});
$str = str_replace(array("[", "]", "(", ")"), "", $obj->{'Link speed'});
print_r($str);

$op = array(); 
$pairs = explode(",", $str); 
$numParts = count($pairs);
echo $numParts;


$x = array();
$x = $obj->{'LinkID'};
//print_r($x);
//echo $obj->{'device_ID'};
$y = array();
$y = $obj->{'device_ID'};

for($i = 0;$i< $count;$i++){
	//echo $xt = strlen($x[$i]);
	//echo $x[$i];
	$query_insert = "insert into gpslinkspeed values (".'null'.",".$y[0].",".$x[$i].",".$pairs[$i].",".'current_timestamp'.")";
	$query_exec_insert = mysql_query($query_insert);
	//if($query_exec_insert)
		//echo "successfully inserted";
	//else 
		//echo "data not inserted";
	}
mysql_close();
?>