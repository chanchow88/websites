<?php 
require_once('Connections.php'); 
mysql_select_db($database_localhost,$localhost);
$resultset = array();
//HERE WE CAN CONFIGURE THE VALUES 200 WHICH IS TIME GAP FROM CURRENT TO PAST
//$result = mysql_query("SELECT Link_Id,avg(Link_Speed) FROM gpslinkspeed where Time_inserted > (now() - interval 10 minute) group by Link_Id");
$result = mysql_query("SELECT * FROM gpslinkspeed where Time_inserted > (now() - interval 120 minute) group by Link_Id");
while($row = mysql_fetch_assoc($result)){
	$resultset[] = $row;
	}
print_r($resultset);
foreach($resultset as $a){
	 //echo $a['Link_Id'].",".$a['avg(Link_Speed)'];
	 //$query_insert = "insert into gpslinkspeed_avg values (".'null'.",".$a['Link_Id'].",".$a['avg(Link_Speed)'].",".'current_timestamp'.")";
	 //$query_exec_insert = mysql_query($query_insert);
	 //if($query_exec_insert)
		// echo "successfully inserted";
	 //else 
		// echo "data not inserted";
}	
$query_insert = "insert into gpslinkspeed values (".'null'.",".'1'.",".'1'.",".'140'.",".'current_timestamp'.")";
$query_exec_insert = mysql_query($query_insert);

?>


mysql> select Link_Id,if(avgf2 = 0, maxf2, (maxf2+avgf2)/2) avgfun from (select
m.Link_Id Link_Id,max(if(Time_inserted = maxts, Link_Speed, null)) maxf2, coales
ce(avg(if(Time_inserted = maxts,null, Link_Speed)),0) avgf2 from gpslinkspeed m
join (select Link_Id, max(Time_inserted) maxts from gpslinkspeed where Time_inse
rted between date_sub(now(),interval 10 minute) and now() group by Link_Id) mm u
sing(Link_Id) where Time_inserted between date_sub(now(), interval 10 minute) an
d now() group by Link_Id) x;
+---------+----------------------+
| Link_Id | avgfun               |
+---------+----------------------+
|       1 | 130.0000000000000000 |
+---------+----------------------+