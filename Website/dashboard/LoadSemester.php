<?php
//Load semester for the third drop down box
include_once('../one_connection.php');

//the course user chooses
$SelectCourseId = $_POST['SelectCourseId'];
$SelectYearId = $_POST['SelectYearId'];

$sql = "SELECT distinct `Semester` 
from event
where CourseName='{$SelectCourseId}' and SchoolYear= '{$SelectYearId}'
order by Semester asc";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'Semester'=> $row['Semester'],
	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"Semester":"S1"},{"CourseYear":"2014"}]
?>