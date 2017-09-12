<?php
require_once './service_class.php';

$service = new Service;
$type = $_GET['type'];
switch ($type) {
    case 'loadCourse':
		{
			$response = $service->loadCourse();
			echo $response;
		}
        break;
	case 'loadYear':
		{
			//the course user chooses
			$SelectCourseId = $_GET['SelectCourseId'];

			$response = $service->loadYear($SelectCourseId);
			echo $response;
		}
		break;
	case 'loadSemester':
		{
			//the course and year user chooses
			$SelectCourseId = $_GET['SelectCourseId'];
			$SelectYearId = $_GET['SelectYearId'];

			$response = $service->loadSemester($SelectCourseId, $SelectYearId);
			echo $response;
		}
		break;
	case 'loadAssignment':
		{
			//the course, year, semester user chooses
			$SelectCourseId = $_GET['SelectCourseId'];
			$SelectYearId = $_GET['SelectYearId'];
			$SelectSemesterId= $_GET['SelectSemesterId'];

			$response = $service->loadAssignment($SelectCourseId, $SelectYearId, $SelectSemesterId);
			echo $response;
		}
		break;
}
?>