<?php
ob_start();
session_start();
include('../one_connection.php');


if(!isset($_POST['submit']))
{
  exit('<a href="index.html"> Back </a>');
}
//include connection file
$username = "";
$password = "";



if(isset($_POST['username']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
}
    if($username!="" && $password!="")
    {
        $sql = "select password from login where username = '$username' limit 1";
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        if($password == $row[0])
        {
            $_SESSION['username'] = $username;
            $_SESSION['login_status'] = true;
            echo $username,' Welcome!';
            echo '<script type="text/javascript"> window.location.href = "../demo/index.html";</script>';
            exit;
        } 
        else 
        {
            exit('Login Fail <a href="javascript:history.back(-1);"> Back </a>Try Again');
        }
    }
    else 
    {
        exit('Login Fail <a href="javascript:history.back(-1);"> Back </a>Try Again');
    }
?>