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
$file_rem_quotes = str_replace('"',"",$file);
	//echo str_replace('"',"",$file);
$file_geoPoints = substr($file_rem_quotes,22);
$file_geoPoints_1 = str_replace("]","",$file_geoPoints);
	echo $file_geoPoints_1;
//$len_file = strlen(trim(substr($file,23)));// this is the length of date we inserted. we are trimming it off in lines 16 and 17
//echo $len_file;
//echo substr($file,23);
//$sb_file= substr(trim(substr($file,23)),0,$len_file-3);
//echo $sb_file;
$geoPoints = array();
$geoPoints = preg_split('/,/',$file_geoPoints_1,-1);
print_r($geoPoints);
//echo sizeof($geoPoints);

for ($i=0; $i <sizeof($geoPoints)-2;)
{
	//$Device_Id = '12.122';
	$Device_Id = $geoPoints[sizeof($geoPoints)-1];
	$geoPoints[$i] = $geoPoints[$i]/1E6;
	$geoPoints[$i+1] = $geoPoints[$i+1]/1E6;
	$query_insert = "insert into gpstraces_old values (".'null'.",".$Device_Id.",".$geoPoints[$i].",".$geoPoints[$i+1].",".'current_timestamp'.")";
	$query_exec_insert = mysql_query($query_insert);
	if($query_exec_insert)
		echo "successfully inserted".$i;
	else 
		echo "data not inserted".$i;
	$i = $i+2;	
}
mysql_close();
?>