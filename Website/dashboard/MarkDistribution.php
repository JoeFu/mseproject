<?php
include_once('../one_connection.php');


//get the data in ajax request
$SelectCourse = $_POST['SelectCourse'];
$SelectYear = $_POST['SelectYear'];
$SelectSemester = $_POST['SelectSemester'];
$SelectAssignment = $_POST['SelectAssignment'];
//1: by GPA 2: by 10% step
$MarkDistributionSelect= $_POST['MarkDistributionSelect'];


//get the max mark of all submissions of an assignment for each user
$sql = "select floor(max(Grade)*100/MaxGrade) TopGrade,FKUserId
from event
where `CourseName`='{$SelectCourse}' and `SchoolYear`='{$SelectYear}' and `Semester`='{$SelectSemester}' and `AssignmentName`='{$SelectAssignment}' and `DataSourceType`=2 and FKEventTypeId=5
group by FKUserId";
$query = mysql_query($sql);

//initialize array
$arrGPA=array();
$arrGPA[1]="F";
$arrGPA[2]="P";
$arrGPA[3]="C";
$arrGPA[4]="D";
$arrGPA[5]="HD";

$arrGPACount=array();
for ($x=1; $x<=5; $x++) {
  $arrGPACount[$x]=0;
} 

$arrStep=array();
$arrStep[1]="0-10%";
$arrStep[2]="11-20%";
$arrStep[3]="21-30%";
$arrStep[4]="31-40%";
$arrStep[5]="41-50%";
$arrStep[6]="51-60%";
$arrStep[7]="61-70%";
$arrStep[8]="71-80%";
$arrStep[9]="81-90%";
$arrStep[10]="91-100%";

$arrStepCount=array();
for ($x=1; $x<=10; $x++) {
  $arrStepCount[$x]=0;
} 

while($row=mysql_fetch_array($query)){


	if ($MarkDistributionSelect==1)// by GPA
	{	//convert string to int
		$tmp=(int)$row['TopGrade'];
		if($tmp>=0&&$tmp<=49)
		{

			$arrGPACount[1]++;
		}
		else if($tmp>=50&&$tmp<=64)
		{

			$arrGPACount[2]++;
		}
		else if($tmp>=65&&$tmp<=74)
		{

			$arrGPACount[3]++;
		}
		else if($tmp>=75&&$tmp<=84)
		{

			$arrGPACount[4]++;
		}
		else if($tmp>=85&&$tmp<=100)
		{

			$arrGPACount[5]++;
		}
	

	}
	else if($MarkDistributionSelect==2)// by 10% step
	{	//convert string to int
		$tmp=(int)$row['TopGrade'];
		if($tmp>=0&&$tmp<=10)
		{

			$arrStepCount[1]++;
		}
		else if($tmp>=11&&$tmp<=20)
		{

			$arrStepCount[2]++;
		}
		else if($tmp>=21&&$tmp<=30)
		{

			$arrStepCount[3]++;
		}
		else if($tmp>=31&&$tmp<=40)
		{

			$arrStepCount[4]++;
		}
		else if($tmp>=41&&$tmp<=50)
		{

			$arrStepCount[5]++;
		}
		else if($tmp>=51&&$tmp<=60)
		{

			$arrStepCount[6]++;
		}
		else if($tmp>=61&&$tmp<=70)
		{

			$arrStepCount[7]++;
		}
		else if($tmp>=71&&$tmp<=80)
		{

			$arrStepCount[8]++;
		}
		else if($tmp>=81&&$tmp<=90)
		{

			$arrStepCount[9]++;
		}
		else if($tmp>=91&&$tmp<=100)
		{

			$arrStepCount[10]++;
		}
	}
}
mysql_close($link);

//convert to another array that is in JSON format
if($MarkDistributionSelect==1)// by GPA
{
	for ($x=1; $x<=5; $x++) {
  		$arr[] = array(
			'grade'=> $arrGPA[$x],
			'count' => $arrGPACount[$x]
		);
	} 
}
else if($MarkDistributionSelect==2)// by 10% step
{
	for ($x=1; $x<=10; $x++) {
  		$arr[] = array(
			'grade'=> $arrStep[$x],
			'count' => $arrStepCount[$x]
		);
	} 
}

echo json_encode($arr);

?>