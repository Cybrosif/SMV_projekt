<?php
    include '../session_start.php';
    if(!isset($_SESSION['user_vloga']))
        echo '<script type="text/javascript">window.location.href = "../functions/logout.php";</script>';
    else if($_SESSION['user_vloga'] != 'Administrator' && $_SESSION['user_vloga'] != 'administrator' && $_SESSION['user_vloga'] != 'profesor' && $_SESSION['user_vloga'] != 'Profesor')
        echo '<script type="text/javascript">window.location.href = "../functions/logout.php";</script>';
?>