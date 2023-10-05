<?php
    if (isset($_GET['page'])) {
        $data = $_GET['page'];

        switch ($data) {
            case 'dashboard':
                include '../content/dashboard.php';     
                break;
        
            case 'classes':
                include '../content/classes.php';
                break;
        
            case 'settings':
                include '../content/settings.php';
                break;
        
                case 'specific_class':
                    include '../content/specific_class.php';
                    break;
                
            case 'verify_kljuc':
                include '../controllers/verify_kljuc.php';
                break;
            
            case 'user-management':
                include '../content/user_administration.php';
                break;
            }
    } else {
        include '../content/dashboard.php';
    }
  
?>