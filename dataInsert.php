<?php 
require_once('Connections.php'); 
mysql_select_db($database_localhost,$localhost);

/* This is for reading the data

$resultset = array();
$result = mysql_query("SELECT * FROM gpsdata_past where device_id = ".'110');
while($row = mysql_fetch_assoc($result)){
	$resultset[] = $row;
	}
print_r($resultset[0]); //if there are multiple rows we can set the value to the particular row
*/

// This is for inserting data to database we created

$idv = $_POST['id']; // Here we are going to fetch the data from server
//echo $idv;
$latitude = $_POST['lat'];
//echo $latitude;
$longitude = $_POST['long'];
//echo $longitude;
 
 $query_insert = "insert into gpsdata_past values (".'null'.",".$idv.",".'current_timestamp'.",".$latitude.",".$longitude.")";
 $query_exec_insert = mysql_query($query_insert);

if($query_exec_insert)
 echo "successfully inserted";
else 
 echo "data not inserted";

mysql_close();
 ?>