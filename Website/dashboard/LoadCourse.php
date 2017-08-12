<?php
//Load course name for the first drop down box
include_once('connect.php');

$sql = "SELECT distinct `CourseName` from event
where CourseName is not NULL";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'CourseName'=> $row['CourseName'],
	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"CourseName":"Distributed system"},{"CourseName":"Specialised programming"}]
?>