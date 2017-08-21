<!-- /**
* Created by PhpStorm.
* User: Joe Fu
* Date: 1/4/2017
* Time: 11:32 PM
*/ -->

<?php

ob_start();
session_start();

//include connection file
include('../one_connection.php');
//检测用户名及密码是否正确
$username = $_SESSION['username'];
$password = $_SESSION['password'];



$sql = "SELECT username, password From user_login;
$query = mysql_query($sql);
while($row=mysql_fetch_array($query))
{
  echo "usrename".$row["usrename"]."password".$row["password"];
}



?>
