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

	//Load data for the chart First Submission Time Distribution
	public function firstSubmissionTimeDistribution($SelectCourse = "", $SelectYear="", $SelectSemester="", $SelectAssignment="")
	{
		include('../one_connection.php');

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
			where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5 and RepositoryVersion='{$arrRv[$x]}' and FKUserId='{$arrFKUserId[$x]}'";
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
		return json_encode($arr);
		//[{"day":"-5","count":"5"},{"day":"-4","count":"5"}]
	}

	//Load data for the chart Last Submission Time Distribution
	public function lastSubmissionTimeDistribution($SelectCourse = "", $SelectYear="", $SelectSemester="", $SelectAssignment="")
	{
		include('../one_connection.php');

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

		//maximum repository version stands for the last submission
		//we get the last submission of each user 
		$sql = "select max(RepositoryVersion) rv,FKUserId
		from event
		where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5
		group by FKUserId";
		$query = mysql_query($sql);

		//get the Id of each user's last submission record
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
			where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=5 and RepositoryVersion='{$arrRv[$x]}' and FKUserId='{$arrFKUserId[$x]}'";
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
		//arrCount array to store how many last submissions per day
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
		return json_encode($arr);
		//example format of output: [{"day":"-5","count":"5"},{"day":"-4","count":"5"}]
	}

	//Load data for the chart Number Of Submissions Of Each Student
	public function numberOfSubmissionsOfEachStudent($SelectCourse = "", $SelectYear="", $SelectSemester="", $SelectAssignment="", $order="")
	{
		include('../one_connection.php');

		//$OrderBy records the order: alphabetical, descending, ascending
		$OrderBy='';
		switch ($order){
			case 1:
				$OrderBy='';
				break;
			case 2:
				$OrderBy='ORDER BY count desc';
				break;
			case 3:
				$OrderBy='ORDER BY count asc';
				break;
		}

		$sql = "SELECT FKUserId, COUNT(  `Id` ) count
		from event
		where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and `FKEventTypeId`=6
		GROUP BY FKUserId
		HAVING count {$OrderBy}";
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$arr[] = array(
				'FKUserId'=> $row['FKUserId'],
				'count' => $row['count']
			);
		}
		mysql_close($link);
		return json_encode($arr);
		//example format of output: [{"FKUserId":"21685","count":"5"},{"FKUserId":"21687","count":"6"}]
	}
}
?>