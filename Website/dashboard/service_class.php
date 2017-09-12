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

	//Load data for the chart Submission Time Distribution 96 Hours
	public function submissionTimeDistribution96Hours($SelectCourse = "", $SelectYear="", $SelectSemester="", $SelectAssignment="")
	{
		include('../one_connection.php');

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
		mysql_close($link);

		//convert arrCount array to another array that is in JSON format
		for ($x=-96; $x<=96; $x++) {
				$arr[] = array(
					'days'=> $x,
					'count' => $arrCount[$x]
				);
		} 
		return json_encode($arr);
		//[{"days":-96,"count":0},{"days":-95,"count":1},{"days":-94,"count":0}]
	}
}
?>