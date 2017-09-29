<?php
/** APIs is for new DashBoard, Simple Query and Report System **/
session_start();
require_once 'Service.php';
$service = new Service;
$option = $_GET['option'];

//function selection
if($option == "LoadActivityNumber")
{
    $service->LoadActivityNumber();
}
elseif ($option == "LoadStudentsNumber")
{
    $service->LoadStudentsNumber();
}
elseif ($option == "LoadCoursesNumber")
{
    $service->LoadCoursesNumber();
}
elseif($option == "LoadCoursesDetail")
{
    $service->LoadCoursesDetail();
}
elseif($option == "postName")
{
    $service->postName();
}
elseif($option == "Name")
{
    $service->Name();
}
elseif($option == "LoadCourse")
{
    $service->LoadCourse();
}
elseif($option == "LoadYear")
{
    $SelectCourseId = $_GET['SelectCourseId'];
    $service->LoadYear($SelectCourseId);
}
elseif($option == "LoadSemester")
{
    $SelectCourseId = $_GET['SelectCourseId'];
    $SelectYearId = $_GET['SelectYearId'];
    $service->LoadSemester($SelectCourseId, $SelectYearId);
}
elseif($option == "LoadAssignment")
{
    $SelectCourseId = $_GET['SelectCourseId'];
    $SelectYearId = $_GET['SelectYearId'];
    $SelectSemesterId= $_GET['SelectSemesterId'];
    $service->LoadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
}
else
{
    echo "Invaild Request! ";
}

?>