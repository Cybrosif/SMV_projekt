<?php
$page = $_GET['page'];
include '../../db.php';
include '../session_start.php';


switch ($page) {
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
            include '../content/verify_kljuc.php';
            break;
    }
?>
