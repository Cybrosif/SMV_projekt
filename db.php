<?php
    $user = 'anej';
    $password = 'anej';
    $db = 'classorbit';
    $host = 'db';
    $port = 3306;
    
    $link = mysqli_init();
    $success = mysqli_real_connect(
       $link, 
       $host, 
       $user, 
       $password, 
       $db,
       $port
    );
?>