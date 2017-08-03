<?php
date_default_timezone_set('PRC'); //Australia/Adelaide
/**
 * @数据库链接
*/
$host="localhost";
$db_user="root";
$db_pass="123456";
$db_name="studentdata";


$link=mysql_connect($host,$db_user,$db_pass);
mysql_select_db($db_name,$link);
mysql_query("SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
?>
