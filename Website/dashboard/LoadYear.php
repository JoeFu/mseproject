<?php
//Load year for the second drop down box
include_once('../one_connection.php');

//the course user chooses
$SelectCourseId = $_POST['SelectCourseId'];

$sql = "SELECT distinct `SchoolYear` 
from event
where CourseName='{$SelectCourseId}'
order by SchoolYear asc";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'SchoolYear'=> $row['SchoolYear'],
	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"CourseYear":"2013"},{"CourseYear":"2014"}]
?>