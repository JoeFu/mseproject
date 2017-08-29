<?php
include_once('../one_connection.php');

$SelectCourse = $_POST['SelectCourse'];
$SelectYear = $_POST['SelectYear'];
$SelectSemester = $_POST['SelectSemester'];
$SelectAssignment = $_POST['SelectAssignment'];

//get assignment deadline
$sql = "SELECT distinct DATE_FORMAT(  `DueDate` ,  '%Y%m%d%H' ) dueDate 
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2";

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$DueDate = $row['dueDate'];//yyyymmdd

	
}
//Convert $DueDate to time
$timeDueDate= strtotime($DueDate);

//the 5th day before deadline
$DueDateMinus5=date('Ymd',strtotime("$DueDate -5 day"));
//the 6th day after deadline
$DueDatePlus6=date('Ymd',strtotime("$DueDate +6 day"));


$sql = "SELECT DATE_FORMAT(  `EventTime` ,  '%Y%m%d' ) days, COUNT(  `Id` ) count
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5
GROUP BY days
having days between '{$DueDateMinus5}' and '{$DueDatePlus6}'";

//the main purpose of the following code is to add those days with 0
//submission to array, since the query result will not include them
$i=-5;
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	//difference between 2 dates
	$tmpDays=(int)round((strtotime($row['days'])-$timeDueDate)/3600/24);
	if($i==$tmpDays)
	{
		$arr[] = array(
			'days'=> $tmpDays,
			'count' => $row['count'],
			'dueDate' => 0
		);
	}
	else
	{
		$arr[] = array(
			'days'=> $i,
			'count' => 0,
			'dueDate' => 0
		);
	}
	$i++;
}
while($i<=5)
{
	$arr[] = array(
			'days'=> $i,
			'count' => 0,
			'dueDate' => 0
	);

	$i++;
}



mysql_close($link);
echo json_encode($arr);
//[{"day":"-5","count":"5","dueDate":"0"},{"day":"-4","count":"5","dueDate":"0"}]
?>