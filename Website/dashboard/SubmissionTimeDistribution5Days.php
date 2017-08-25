<?php
include_once('../one_connection.php');

$SelectCourse = $_POST['SelectCourse'];
$SelectYear = $_POST['SelectYear'];
$SelectSemester = $_POST['SelectSemester'];
$SelectAssignment = $_POST['SelectAssignment'];

//get assignment deadline
$sql = "SELECT distinct DATE_FORMAT(  `DueDate` ,  '%Y%m%d' ) dueDate 
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2";

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$DueDate = $row['dueDate'];//yyyymmdd

	
}

$DueDateMinus5=date('Ymd',strtotime("$DueDate -5 day"));

$DueDatePlus6=date('Ymd',strtotime("$DueDate +6 day"));


$sql = "SELECT DATE_FORMAT(  `EventTime` ,  '%Y%m%d' ) days, COUNT(  `Id` ) count
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5
GROUP BY days
having days between '{$DueDateMinus5}' and '{$DueDatePlus6}'";


$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'days'=> $row['days'],
		'count' => $row['count'],
		'dueDate' => $DueDate
	);
}



mysql_close($link);
echo json_encode($arr);
//[{"day":"20170304","count":"5","dueDate":"20120123"},{"day":"20170305","count":"5","dueDate":"20120123"}]
?>