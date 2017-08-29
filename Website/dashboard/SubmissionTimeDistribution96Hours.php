<?php
include_once('../one_connection.php');



//get assignment deadline
$sql = "SELECT distinct DATE_FORMAT(  `DueDate` ,  '%Y-%m-%d %H:%m:%s' ) dueHour 
from event
where `CourseName`='MSE' and `SchoolYear`='2012' and `Semester`='Semester 2' and `AssignmentName`='Assignment 2' and `DataSourceType`=2";

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$DueHour = $row['dueHour'];//yyyy-mm-dd hh:mm:ss
	
	
}
$timeDueHour= strtotime($DueHour);



$DueHourMinus96=date('Y-m-d H:i:s',strtotime("$DueHour -96 hours"));

$DueHourPlus97=date('Y-m-d H:i:s',strtotime("$DueHour +97 hours"));


$sql = "SELECT DATE_FORMAT(  `EventTime` ,  '%Y-%m-%d %H:%m:%s' ) days, COUNT(  `Id` ) count
from event
where `CourseName`='MSE' and `SchoolYear`='2012' and `Semester`='Semester 2' and `AssignmentName`='Assignment 2' and `DataSourceType`=2 and `FKEventTypeId`=5
GROUP BY days
having days between '2012-09-18 17:09:00' and '2012-09-26 18:09:00'";

$arrCount=array();
for ($x=-96; $x<=96; $x++) {
  $arrCount[$x]=0;
} 

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){

	$tmpDays=(int)ceil((strtotime($row['days'])-$timeDueHour)/3600);
	$arrCount[$tmpDays]++;
}


mysql_close($link);
echo json_encode($arrCount);
//{"-96":0,"-95":1,"-94":0}
?>