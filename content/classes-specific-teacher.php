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
<style> 
    .assigement{
        border-radius: 5px;
        /*box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);*/
        border: 1px solid black;
        padding: 5px;
        margin-bottom: 5px;
    }
</style>
<div class="container" style="box-shadow: none; background-color: transparent;">
    <div class="text-center">
        <h3 class="mb-4 text1">Ime predmeta</h3>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3 container">
            <h4 class="text2">Gradiva</h4>
            <table class="table">
                <thead>
                    <tr>
                        <!--<th scope="col" class="text2">#</th>
                        <th scope="col" class="text2">Ime gradiva</th>
                        <th scope="col" class="text2">Opis</th>
                        <th scope="col" class="text2"></th>-->
                    </tr>
                </thead>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                <tbody>
                </tbody>
            </table>

        </div>
        <div class="col-md-12 container">
            <h4 class="text2">Naloge</h4>
                <div class="assigement">test</div>
                <div class="assigement">test</div>
                <div class="assigement">test</div>
                
        </div>
    </div>
</div>



