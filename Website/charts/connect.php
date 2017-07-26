<?php
$host_name="localhost";
$db_user="root";
$db_pass="outlook";
$db_name="student_data";
$db_timezone="Australia/Adelaide";

$link = mysqli_connect($host_name,$db_user,$db_pass,$db_name,3306);

mysqli_select_db($db_name,$link);
mysqli_query("SET name UTF8");

header("Content-type: text/html; charset=uft-8");

?>