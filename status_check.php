<?php
        if (session_status() == PHP_SESSION_NONE || session_status() == PHP_SESSION_DISABLED || empty($_SESSION['username'])) 
        {  
            header('LOCATION: views/login_page.php');
            
        }
        else        
        {
            header('LOCATION: views/home.php');
        }
?>