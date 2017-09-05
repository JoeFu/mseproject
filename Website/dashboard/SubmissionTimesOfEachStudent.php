<?php
include_once('../one_connection.php');

//$OrderBy records the order: alphabetical, descending, ascending
$order =2;
$OrderBy='';
switch ($order)
{
case 1:
  $OrderBy='';
  break;
case 2:
  $OrderBy='ORDER BY count desc';
  break;
case 3:
  $OrderBy='ORDER BY count asc';
  break;
}

$sql = "SELECT FKUserId, COUNT(  `Id` ) count
from event
where `CourseName`='MSE' and `SchoolYear`='2012' and `Semester`='Semester 2' and `AssignmentName`='Assignment 2' and `DataSourceType`=2 and `FKEventTypeId`=6
GROUP BY FKUserId
HAVING count {$OrderBy}";

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'FKUserId'=> $row['FKUserId'],
		'count' => $row['count']
	);
}

mysql_close($link);
echo json_encode($arr);
//[{"FKUserId":"21685","count":"5"},{"FKUserId":"21687","count":"6"}]
?>