<?php
        if (!session_status() == PHP_SESSION_NONE && !session_status() == PHP_SESSION_DISABLED && !empty($_SESSION['user_ime'])) 
        {  
            header('LOCATION: ../views/home.php');
            
        }
?>