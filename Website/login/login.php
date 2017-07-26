<!-- /**
* Created by PhpStorm.
* User: Joe Fu
* Date: 1/4/2017
* Time: 11:32 PM
*/ -->
<?php
session_start();
if(!isset($_POST['submit']))
{
    exit('Decline Access!');
}
$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);

//包含数据库连接文件
include('../connect.php');
//检测用户名及密码是否正确
$check_query = mysql_query("select uid from user_login where username='$username' and password='$password' limit 1");
if($result = mysql_fetch_array($check_query))
{
//登录成功
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $result['uid'];
    echo $username,' Welcome to the System <a href="../dashboard">Dashboard</a><br />';
    echo 'Click <a href="login.php?action=logout">Logout</a> Logout<br />';
    exit;
} else {
exit('Login Fail！Click Here go Back <a href="javascript:history.back(-1);">Back</a> Try Again');
}
?>