<?php
            if (!session_status() == PHP_SESSION_NONE && !session_status() == PHP_SESSION_DISABLED && !empty($_SESSION['user_ime'])) 
            {  
                header('LOCATION: views/home.php?page=dashboard');
                
            }
            else
            {
                header('LOCATION: views/login_page.php');
            }
?>