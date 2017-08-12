<?php
include_once('connect.php');

$sql = "SELECT grade, COUNT(  `Id` ) count
FROM event
WHERE DataSourceType=2
GROUP BY grade";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'grade'=> $row['grade'],
		'count' => $row['count']

	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"day":"20170304","count":"5"},{"name":"ÐÂ½®","value":"0.94"}]
?>