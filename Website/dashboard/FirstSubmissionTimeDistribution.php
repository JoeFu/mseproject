<?php
include_once('../one_connection.php');

//get the data in ajax request
$SelectCourse = $_POST['SelectCourse'];
$SelectYear = $_POST['SelectYear'];
$SelectSemester = $_POST['SelectSemester'];
$SelectAssignment = $_POST['SelectAssignment'];

//get assignment start date and end date
$sql = "SELECT distinct DATE_FORMAT(  `StartDate` ,  '%Y%m%d' ) startDate, DATE_FORMAT(  `DueDate` ,  '%Y%m%d' ) dueDate 
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5";

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$StartDate = $row['startDate'];//yyyymmdd
	$DueDate = $row['dueDate'];//yyyymmdd
}

//Convert $StartDate,$DueDate to time
$timeStartDate= strtotime($StartDate);
$timeDueDate= strtotime($DueDate);

//the start date
$StartDateMinus0=date('Ymd',strtotime("$StartDate"));
//the 6th day after deadline
$DueDatePlus6=date('Ymd',strtotime("$DueDate +6 day"));

//minimum repository version stands for the first submission
//we get the first submission of each user 
$sql = "select min(RepositoryVersion) rv,FKUserId
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5
group by FKUserId";
$query = mysql_query($sql);

//get the Id of each user's first submission record
$i=1;
while($row=mysql_fetch_array($query)){
	$arrRv[$i]=$row['rv'];
	$arrFKUserId[$i]=$row['FKUserId'];
	$i++;
}

//build the condition for "where in" query, example value of $IdInCondition is (27975,27979,27977), 
$IdInCondition="(";
for ($x=1; $x<=sizeof($arrRv); $x++) {
	$sql = "select Id
	from event
	where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5 and RepositoryVersion='{$arrRv[$x]}' and FKUserId='{$arrFKUserId[$x]}'
	";
	$query = mysql_query($sql);
	while($row=mysql_fetch_array($query)){
		$IdInCondition=$IdInCondition.$row['Id'].",";
	}


}
//remove the last redundant comma
$IdInCondition = substr($IdInCondition,0,strlen($IdInCondition)-1);
$IdInCondition=$IdInCondition.")";

//select DATE_FORMAT(  `EventTime` ,  '%Y%m%d' ) days,Id
//from event
//where Id in (27975,27979,27977,.....)
$sql = "select DATE_FORMAT(  `EventTime` ,  '%Y%m%d' ) days,Id
from event
where Id in {$IdInCondition}";

//the main purpose of the following code is to add those days with 0
//submission to array, since the query result will not include them

//the difference between start date and due date
$i=(int)round(($timeStartDate-$timeDueDate)/3600/24);

//arrCount array to store how many first submissions per day
$arrCount=array();
for ($x=$i; $x<=200; $x++) {
  $arrCount[$x]=0;
} 

$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){

	$tmpDays=(int)round((strtotime($row['days'])-$timeDueDate)/3600/24);
	$arrCount[$tmpDays]++;
}

//convert arrCount array to another array that is in JSON format
for ($x=$i; $x<=5; $x++) {
  		$arr[] = array(
			'days'=> $x,
			'count' => $arrCount[$x]
		);
} 


mysql_close($link);
echo json_encode($arr);
//[{"day":"-5","count":"5"},{"day":"-4","count":"5"}]
?>