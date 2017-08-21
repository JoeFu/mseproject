<<<<<<< HEAD
<?php
//Load course name for the first drop down box
include_once('../one_connection.php');

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
=======
<?php
//Load course name for the first drop down box
include_once('../one_connection.php');

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
>>>>>>> 2eb7366c01376b015e8a81896c102552bc1da07d
?>