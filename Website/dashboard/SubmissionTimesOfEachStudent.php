<?php
include_once('../one_connection.php');

//get the data in ajax request
$SelectCourse = $_POST['SelectCourse'];
$SelectYear = $_POST['SelectYear'];
$SelectSemester = $_POST['SelectSemester'];
$SelectAssignment = $_POST['SelectAssignment'];
$order = intval($_POST['order']);
//$OrderBy records the order: alphabetical, descending, ascending
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
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=6
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