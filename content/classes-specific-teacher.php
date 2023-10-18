<?php
    include '../../db.php';
    include '../session_start.php';

    if(isset($_GET['razredID']))
    {
        $razredID = $_GET['razredID'];
        if($_SESSION['user_vloga'] == "profesor" || $_SESSION['user_vloga'] == "Profesor") {
            
            $sql = "SELECT * FROM razredi 
                    JOIN ucitelji_razredi ON razredi.Razred_ID = ucitelji_razredi.Razred_ID 
                    WHERE ucitelji_razredi.Ucitelj_ID = {$_SESSION['user_id']} 
                    AND razredi.Razred_ID = $razredID";
        } else if($_SESSION['user_vloga'] == "dijak" || $_SESSION['user_vloga'] == "Dijak") {
            
            $sql = "SELECT * FROM razredi 
                    JOIN dijaki_razredi ON razredi.Razred_ID = dijaki_razredi.Razred_ID 
                    WHERE dijaki_razredi.Dijak_ID = {$_SESSION['user_id']} 
                    AND razredi.Razred_ID = $razredID";
        } else {
           
            $sql = ""; 
        }
        
    }
?>

<div class="container text-center">
    <h3 class="mb-4 text-1">Ime predmeta</h3>
    <div class="container">Gradiva</dvi>
</div>