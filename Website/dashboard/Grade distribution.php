<?php
include_once('connect.php');

$sql = "select   'F'   Grade,sum(case   when   Grade   between   1   and   49   then   1   else   0   end)   Number 
from   event
union all

select   'P'   Grade,sum(case   when   Grade   between   50   and   64   then   1   else   0   end)   Number 
from   event
union all

select   'C'   Grade,sum(case   when   Grade   between   65   and   74   then   1   else   0   end)   Number 
from   event
union all

select   'D'   Grade,sum(case   when   Grade   between   75   and   84   then   1   else   0   end)   Number 
from   event
union all

select   'HD'   Grade,sum(case   when   Grade   between   85   and   100   then   1   else   0   end)   Number 
from   event
";
$query = mysql_query($sql);
while($row=mysql_fetch_array($query)){
	$arr[] = array(
		'grade'=> $row['Grade'],
		'count' => $row['Number']
	);
}
//var_dump($arr);


mysql_close($link);
echo json_encode($arr);
//[{"day":"20170304","count":"5"},{"name":"ÐÂ½®","value":"0.94"}]
?>