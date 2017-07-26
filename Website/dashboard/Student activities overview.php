<?php
include_once('connect.php');
$from = $_POST['from'];
$to = $_POST['to'];
$order = intval($_POST['order']);
$OrderBy='';
switch ($order)
{
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
$ThresholdSelect = $_POST['ThresholdSelect'];
$Threshold = $_POST['Threshold'];


$sql = "SELECT FKUserId, COUNT(  `Id` ) count
FROM event
WHERE EventTime between '{$from}' and '{$to}'  
GROUP BY FKUserId
HAVING count{$ThresholdSelect}{$Threshold}
{$OrderBy}";
$query = mysql_query($sql);
$amount=mysql_num_rows($query);
while($row=mysql_fetch_array($query)){
	$row['FKUserId']=str_replace('SER','',$row['FKUserId']);
	$arr[] = array(
		'name'=> $row['FKUserId'],
		'count' => ($row['count']/1000),
		'amount' => $amount
	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"day":"20170304","count":"5"},{"name":"ÐÂ½®","value":"0.94"}]
?>