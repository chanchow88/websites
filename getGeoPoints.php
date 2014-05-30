<?php 
// This is for reading the data from the database
require_once('Connections.php'); 
mysql_select_db($database_localhost,$localhost);
$resultset = array();
//$size1 = array();
//$result = mysql_query("SELECT Point_Id,X,Y FROM monongalia where Polyline_Id < ".'11');
//$result = mysql_query("SELECT Point_Id,X,Y FROM monongalia where Polyline_Id < ".$_REQUEST['Polyline_Id']);
//$Polyline_Id = '100';
//$X1 = '-80.223982';
//$Y1 = '40.01';
//$X2 = '-78.75';
//$Y2 = '39.56';
$result = mysql_query("SELECT Polyline_Id,Point_Id,X,Y FROM monongalia where Polyline_Id < ".$_REQUEST['Polyline_Id']." and X >=".$_REQUEST['X1']." and X<=".$_REQUEST['X2']." and Y>=".$_REQUEST['Y2']." and Y<=".$_REQUEST['Y1']." limit 10000");
while($row = mysql_fetch_assoc($result)){
	$resultset[] = $row;
	}
	
	//Iterate on result set and send X,Y.
	//system.out.println(X+":"+Y+":");
//print_r($resultset); //if there are multiple rows we can set the value to the particular row
$corrds ='';
$syn = Null;
foreach($resultset  as $a) {
	if($corrds != '')
	$corrds= $corrds.'%'.$a[Polyline_Id].':'.$a[Point_Id].':'.$a[X].':'.$a[Y];
	else
	$corrds= $corrds.$a[Polyline_Id].':'.$a[Point_Id].':'.$a[X].':'.$a[Y];
}
print_r($corrds);
//json encoding
//$resultencoded = json_encode($resultset[0]);
//print($resultencoded);

mysql_close();
?>