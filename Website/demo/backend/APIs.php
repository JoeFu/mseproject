<?php
//Load course name for the first drop down box
// Load Activity Number function
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
// Load Students Number function
function LoadStudentsNumber()
{
    include_once('one_connection.php');
    $sql = "select count(*) from event  where  FKUserId";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
    echo $result[0];
    mysql_close($link);
}
//Load Load Courses Number function
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


//function selection
if($_GET['option'] == "LoadActivityNumber")
{
    LoadActivityNumber();
}
elseif ($_GET['option'] == "LoadStudentsNumber")
{
    LoadStudentsNumber();
}
elseif ($_GET['option'] == "LoadCoursesNumber")
{
    LoadCoursesNumber();
}
elseif($_GET['option'] == "LoadCoursesDetail")
{
    LoadCoursesDetail();
}
else
{
    echo "Error";
}

?>