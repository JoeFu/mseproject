<?php
/** AService is supporting APIs **/
// Load Activity Numbers function
class Service
{
    function LoadActivityNumber()
    {
        include_once('one_connection.php');
        $sql = "SELECT count(*) FROM studentdata.event;";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
        echo $result[0];
        
        mysql_close($link);
        //echo json_encode($result[0]);
    }
    // Load Students Numbers function
    function LoadStudentsNumber()
    {
        include_once('one_connection.php');
        $sql = "select count(*) from event  where  FKUserId";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
        echo $result[0];
        mysql_close($link);
    }
    //Load Load Courses Numbers function
    function LoadCoursesNumber()
    {
        include_once('one_connection.php');
        $sql = "select count(DISTINCT CourseName) from event";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
        echo $result[0];
    
        mysql_close($link);
    }
    function GPAdistribute()
    {
        include_once('one_connection.php');
        
    
    }
    function LoadCoursesDetail()
    {
    //Load course name for the first drop down box
        include_once('one_connection.php');
        $sql = "SELECT distinct `CourseName` from event
        where CourseName is not NULL";
        $query = mysql_query($sql);
        while($row=mysql_fetch_array($query)){
        $arr[] = array(
            'CourseName'=> $row['CourseName'],
        );}
        mysql_close($link);
        echo json_encode($arr);
    }
    function postName()
    {
        $username="";
        if($_SESSION['username']!= NULL)
        {
            $html = '<i class="fa fa-user fa-fw"></i> ';
            $username = $_SESSION['username'];
            echo $html,$username;
        }
        else
        {
            $html = '<i class="fa fa-user fa-fw"></i> ';
            $username ='<a href="../../login/login.html">Please Login</a>';
            echo $html,$username;
        }
    }
    function Name()
    {
        $username="";
        if($_SESSION['username']!= NULL)
        {
            $username = $_SESSION['username'];
            echo $username;
        }
        else
        {
            $username ='<a href="../../login/login.html">Please Login</a>';
            echo $username;
        }
    }
    function LoadCourse()
	{
		include('one_connection.php');
		$sql = "SELECT distinct `CourseName` from event where CourseName is not NULL";
		$query = mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$arr[] = array(
				'CourseName'=> $row['CourseName'],
			);
		}
		mysql_close($link);
		echo json_encode($arr);
    }
    function LoadYear($SelectCourseId="")
    {
        include('one_connection.php');
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
		echo json_encode($arr);
    }
    function LoadSemester($SelectCourseId="",$SelectYearId="")
    {
        include('one_connection.php');
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
		echo json_encode($arr);
    }
    function LoadAssignment($SelectCourseId="",$SelectYearId="",$SelectSemesterId="")
    {
        include('one_connection.php');
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

    }
}



?>