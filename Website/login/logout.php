<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 5/9/17
 * Time: 10:03 PM
 */
    session_start();
    $_SESSION['session_time']='0';
    $_SESSION['userloginstatus']=0;
    session_unset();
    echo "<script language='javascript'>alert(\"You have been logged out.\") </script>";
    $url = "../index.html";
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>";
?>
