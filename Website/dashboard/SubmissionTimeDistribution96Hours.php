<?php
include_once('../one_connection.php');

//get the data in ajax request
$SelectCourse = $_POST['SelectCourse'];
$SelectYear = $_POST['SelectYear'];
$SelectSemester = $_POST['SelectSemester'];
$SelectAssignment = $_POST['SelectAssignment'];

//get assignment deadline
$sql = "SELECT distinct DATE_FORMAT(  `DueDate` ,  '%Y-%m-%d %H:%m:%s' ) dueHour 
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2";

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$DueHour = $row['dueHour'];//yyyy-mm-dd hh:mm:ss
	
	
}
$timeDueHour= strtotime($DueHour);


//the 96th hour before deadline
$DueHourMinus96=date('Y-m-d H:i:s',strtotime("$DueHour -96 hours"));
//the 97th hour after deadline
$DueHourPlus97=date('Y-m-d H:i:s',strtotime("$DueHour +97 hours"));


$sql = "SELECT DATE_FORMAT(  `EventTime` ,  '%Y-%m-%d %H:%m:%s' ) days, COUNT(  `Id` ) count
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5
GROUP BY days
having days between '{$DueHourMinus96}' and '{$DueHourPlus97}'";

//arrCount array to store how many submissions per hour
$arrCount=array();
for ($x=-96; $x<=96; $x++) {
  $arrCount[$x]=0;
} 
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){

	$tmpDays=(int)ceil((strtotime($row['days'])-$timeDueHour)/3600);
	$arrCount[$tmpDays]++;
}

//convert arrCount array to another array that is in JSON format
for ($x=-96; $x<=96; $x++) {
  		$arr[] = array(
			'days'=> $x,
			'count' => $arrCount[$x]
		);
} 


mysql_close($link);
echo json_encode($arr);
//[{"days":-96,"count":0},{"days":-95,"count":1},{"days":-94,"count":0}]
?>