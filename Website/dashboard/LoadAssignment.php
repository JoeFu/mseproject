<?php
//Load assignment for the fourth drop down box
include_once('../one_connection.php');

//the course, year, semester user chooses
$SelectCourseId = $_POST['SelectCourseId'];
$SelectYearId = $_POST['SelectYearId'];
$SelectSemesterId= $_POST['SelectSemesterId'];

$sql = "SELECT distinct `AssignmentName` 
from event
where CourseName='{$SelectCourseId}' and SchoolYear= '{$SelectYearId}' and Semester='{$SelectSemesterId}'
order by AssignmentName asc";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'AssignmentName'=> $row['AssignmentName'],
	);
}



mysql_close($link);
echo json_encode($arr);
//[{"AssignmentName":"Assignment 1"},{"AssignmentName":"Assignment 2"}]
?>