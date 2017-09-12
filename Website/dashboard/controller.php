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
}
?>