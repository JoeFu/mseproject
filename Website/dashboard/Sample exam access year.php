<?php
include_once('connect.php');

$sql = "SELECT DATE_FORMAT(  `EventTime` ,  '%Y' ) days, COUNT(  `Id` ) count
FROM event
WHERE Context=' Sample Exam'
GROUP BY days";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'day'=> $row['days'],
		'count' => $row['count']

	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"day":"20170304","count":"5"},{"name":"�½�","value":"0.94"}]
?>