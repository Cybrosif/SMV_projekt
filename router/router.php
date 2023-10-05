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
            
            case 'user-management':
                include '../content/user_administration.php';
                break;

            case 'logout':
                echo '<script type="text/javascript">window.location.href = "../functions/logout.php";</script>';
                break;
            }
    } else {
        include '../content/dashboard.php';
    }
  
?>