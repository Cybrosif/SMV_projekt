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
            
            case 'student_administration':
                include '../content/student_administration.php';
                break;
            
            case 'teacher-management':
                include '../content/teacher-management.php';
                break;

            case 'user-management':
                include '../content/user-management.php';
                break;

            case 'classes-management':
                include '../content/classes-management.php';
                break;

            case 'specific_class':
                include '../content/specific_class.php';
                break;

            case 'classes-teacher':
                include '../content/classes-teacher.php';
                break;
            case 'classes-specific-student.php':
                include '../content/classes-specific-student.php';
                 break;

            case 'logout':
                echo '<script type="text/javascript">window.location.href = "../functions/logout.php";</script>';
                break;
            }
    } else {
        include '../content/dashboard.php';
    }
  
?>