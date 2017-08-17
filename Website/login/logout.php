<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 5/9/17
 * Time: 10:03 PM
 */
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);


    echo 'You have cleaned session';
    header('Refresh: 2; URL = login.php');
?>
