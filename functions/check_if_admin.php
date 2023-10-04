<?php
    include '../session_start.php';
    if(!$_SESSION['user_vloga'])
        header("Location: ../çontrollers/page=dashboard");
    else if($_SESSION['user_vloga'] != "administrator")
        header("Location: ../çontrollers/page=dashboard");
?>