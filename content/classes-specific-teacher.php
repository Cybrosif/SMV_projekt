<?php
    include '../../db.php';
    include '../session_start.php';

    if(isset($_GET['razredID']))
    {
        $razredID = $_GET['razredID'];
    }
    echo $razredID;
?>

NARED PREVERJANJE CE JE SPLOH PROFESOR NA STRANI