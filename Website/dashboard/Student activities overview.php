<<<<<<< HEAD
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
$CourseName=$_POST['CourseName'];


$sql = "SELECT FKUserId, COUNT(  `Id` ) count
FROM event
WHERE CourseName='{$CourseName}' and EventTime between '{$from}' and '{$to}' and DataSourceType=1
GROUP BY FKUserId
HAVING count{$ThresholdSelect}{$Threshold}
{$OrderBy}";
$query = mysql_query($sql);
$amount=mysql_num_rows($query);
while($row=mysql_fetch_array($query)){
	$row['FKUserId']=str_replace('SER','',$row['FKUserId']);
	$arr[] = array(
		'name'=> $row['FKUserId'],
		'count' => $row['count'],
		'amount' => $amount
	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"day":"20170304","count":"5"},{"name":"ÐÂ½®","value":"0.94"}]
=======
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
$CourseName=$_POST['CourseName'];


$sql = "SELECT FKUserId, COUNT(  `Id` ) count
FROM event
WHERE CourseName='{$CourseName}' and EventTime between '{$from}' and '{$to}' and DataSourceType=1
GROUP BY FKUserId
HAVING count{$ThresholdSelect}{$Threshold}
{$OrderBy}";
$query = mysql_query($sql);
$amount=mysql_num_rows($query);
while($row=mysql_fetch_array($query)){
	$row['FKUserId']=str_replace('SER','',$row['FKUserId']);
	$arr[] = array(
		'name'=> $row['FKUserId'],
		'count' => $row['count'],
		'amount' => $amount
	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"day":"20170304","count":"5"},{"name":"ÐÂ½®","value":"0.94"}]
>>>>>>> 2eb7366c01376b015e8a81896c102552bc1da07d
?>