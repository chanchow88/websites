<?php 
// This is for reading the data from the database
require_once('Connections.php'); 
mysql_select_db($database_localhost,$localhost);

$resultset = array();
//$result = mysql_query("SELECT * FROM gpsdata_past where device_id = ".'110');
$result = mysql_query("SELECT Link_Id FROM gpslinkspeed_avg where Time_inserted > (now() - interval 200 minute)");
while($row = mysql_fetch_assoc($result)){
	$resultset[] = $row;
	}
//print_r($resultset); //if there are multiple rows we can set the value to the particular row


//json encoding
$resultencoded = json_encode($resultset);
print($resultencoded);

mysql_close();
?>