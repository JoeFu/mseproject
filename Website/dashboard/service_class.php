<?php
class Service
{	
	//Load course name for the first drop down box
	public function loadCourse()
	{
		include_once('../one_connection.php');
		$sql = "SELECT distinct `CourseName` from event where CourseName is not NULL";
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$arr[] = array(
				'CourseName'=> $row['CourseName'],
			);
		}
		mysql_close($link);
		echo json_encode($arr);
		//[{"CourseName":"Distributed system"},{"CourseName":"Specialised programming"}]
	}
}
?>