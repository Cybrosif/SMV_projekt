<?php
    session_start();
    session_destroy();
    header('LOCATION: ../views/login_page.php');
?>
