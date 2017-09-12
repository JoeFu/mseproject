<?php
class Service
{	
	//Load course name for the first drop down box
	public function loadCourse()
	{
		include('../one_connection.php');
		$sql = "SELECT distinct `CourseName` from event where CourseName is not NULL";
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$arr[] = array(
				'CourseName'=> $row['CourseName'],
			);
		}
		mysql_close($link);
		return json_encode($arr);
	}

	//Load year for the second drop down box
	public function loadYear($SelectCourseId = "")
	{
		include('../one_connection.php');
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
		mysql_close($link);
		return json_encode($arr);
	}

	//Load semester for the third drop down box
	public function loadSemester($SelectCourseId = "", $SelectYearId="")
	{
		include('../one_connection.php');
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
		mysql_close($link);
		return json_encode($arr);
	}

	//Load assignment for the fourth drop down box
	public function loadAssignment($SelectCourseId = "", $SelectYearId="", $SelectSemesterId="")
	{
		include('../one_connection.php');
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
		return json_encode($arr);
	}

	//Load data for the chart Submission Time Distribution 5 Days
	public function submissionTimeDistribution5Days($SelectCourse = "", $SelectYear="", $SelectSemester="", $SelectAssignment="")
	{
		include('../one_connection.php');

		//get assignment deadline
		$sql = "SELECT distinct DATE_FORMAT(  `DueDate` ,  '%Y%m%d' ) dueDate 
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

		//the main purpose of the following code is to add those days with 
		//0 submission to array, since the query result will not include them
		$i=-5;
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			//difference between 2 dates
			$tmpDays=(int)round((strtotime($row['days'])-$timeDueDate)/3600/24);
			if($i==$tmpDays){
				$arr[] = array(
					'days'=> $tmpDays,
					'count' => $row['count'],
					'dueDate' => 0
				);
			}else{
				$arr[] = array(
					'days'=> $i,
					'count' => 0,
					'dueDate' => 0
				);
			}
			$i++;
		}
		while($i<=5){
			$arr[] = array(
					'days'=> $i,
					'count' => 0,
					'dueDate' => 0
			);
			$i++;
		}
		mysql_close($link);
		return json_encode($arr);
		//[{"day":"-5","count":"5","dueDate":"0"},{"day":"-4","count":"5","dueDate":"0"}]
	}
}
?>