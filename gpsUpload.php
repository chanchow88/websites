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
//echo 	$file_rmDate;
$obj = json_decode($file_rmDate);
//print_r($obj->{'device_Id'});
$count = count($obj->{'gpstraces'});
//echo $count;
print_r($obj->{'gpstraces'});
//print_r($obj->{'Link speed'});
$str = str_replace(array("[", "]", "(", ")"), "", $obj->{'gpstraces'});
//print_r($str);

$op = array(); 
$pairs = explode(",", $str); 
$numParts = count($pairs);
//echo $numParts;

for($i = 0;$i< $numParts;){
	$pairs[$i];
	$geoPoints[$i] = $pairs[$i]/1E6;
	$geoPoints[$i+1] = $pairs[$i+1]/1E6;
	$query_insert = "insert into gpstraces_old values (".'null'.",".$obj->{'device_Id'}.",".$geoPoints[$i].",".$geoPoints[$i+1].",".'current_timestamp'.")";
	$query_exec_insert = mysql_query($query_insert);
	if($query_exec_insert)
		echo "successfully inserted";
	else 
		echo "data not inserted";
			 $i = $i+2;	
	}	
mysql_close();
?>