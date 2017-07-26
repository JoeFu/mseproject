<?php
include_once('connect.php');
$from = $_GET['from'];
$to = $_GET['to'];

$order = intval($_GET['order']);
$OrderBy='';
$OrderInFileName='';
switch ($order)
{
case 1:
  $OrderBy='';
	$OrderInFileName='alpha';
  break;
case 2:
  $OrderBy='ORDER BY count desc';
	$OrderInFileName='desc';
  break;
case 3:
  $OrderBy='ORDER BY count asc';
	$OrderInFileName='asc';
  break;
}

$ThresholdSelect = $_GET['ThresholdSelect'];
$Threshold = $_GET['Threshold'];
$ThresholdSelectInFileName='';
switch ($ThresholdSelect)
{
case ">":
  $ThresholdSelectInFileName='gt';
  break;
  case ">=":
  $ThresholdSelectInFileName='get';
  break;
  case "<":
  $ThresholdSelectInFileName='lt';
  break;
  case ">=":
  $ThresholdSelectInFileName='let';
  break;
  case "=":
  $ThresholdSelectInFileName='eq';
  break;

}




$action = $_GET['action'];
    if ($action=='export') { //导出CSV 

 
		//date_default_timezone_set('Australia/Adelaide'); //PRC

        $str = "Time,Amount of activities\n"; 

		        $result = mysql_query(
"SELECT FKUserId, COUNT(  `Id` ) count
FROM event
WHERE EventTime between '{$from}' and '{$to}'  
GROUP BY FKUserId
HAVING count{$ThresholdSelect}{$Threshold}
{$OrderBy}");
            while($row=mysql_fetch_array($result)){ 
               $str .= $row['FKUserId'].",".$row['count']."\n"; //用引文逗号分开 
            } 
        $filename = 'DistributedSystems2012Semester2'.'StudentActivitiesOverview'.$from.'-'.$to.$ThresholdSelectInFileName.$Threshold.$OrderInFileName.'.csv'; //设置文件名 
        export_csv($filename,$str); //导出 
    } 

    function export_csv($filename,$data) { 
        header("Content-type:text/csv"); 
        header("Content-Disposition:attachment;filename=".$filename); 
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
        header('Expires:0'); 
        header('Pragma:public'); 
        echo $data; 
        exit;
        
    } 



/*$sql = "SELECT DATE_FORMAT(  `EventTime` ,  '%Y%m%d' ) days, COUNT(  `Id` ) count
FROM event
GROUP BY days";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'day'=> $row['days'],
		'count' => $row['count']
	);
}
//var_dump($arr);*/


mysql_close($link);

?>