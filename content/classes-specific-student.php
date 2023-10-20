<?php
    include '../../db.php';
    include '../session_start.php';
    //PREVERJANJE CE JE DIJAK
    $ime_razreda = null;

    if(isset($_GET['razredID']))
    {
        $razredID = $_GET['razredID'];
        $sql = "SELECT razredi.Ime_razreda FROM razredi 
                    JOIN uporabniki_razredi ON razredi.Razred_ID = uporabniki_razredi.Razred_ID 
                    WHERE uporabniki_razredi.Uporabnik_ID = {$_SESSION['user_id']} 
                    AND razredi.Razred_ID = $razredID";

    $result = mysqli_query($link, $sql);

    // Check if the query was successful
    if($result) {
        // Fetch the data from the result and store it in variables
        $row = mysqli_fetch_assoc($result);
        if($row) {
            $ime_razreda = $row['Ime_razreda'];
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($link);
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
<h1 class='text-center primary-text my-4'><?php echo $ime_razreda; ?></h1>
<div class="container" style="box-shadow: none; background-color: transparent;">
    <div class="row">
        <div class="col-md-12 mb-3 container">
            <h4 class="text1">Gradiva</h4>
            <table class="table">
                <thead>
                    <tr>
                        <!--<th scope="col" class="text2">#</th>
                        <th scope="col" class="text2">Ime gradiva</th>
                        <th scope="col" class="text2">Opis</th>
                        <th scope="col" class="text2"></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM gradiva WHERE Razred_ID = $razredID AND Naloga_ID IS NULL";
                        $result = mysqli_query($link, $sql);
                        $i = 1;
                        if ($result) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>"; 
                                echo "<td>" . $row['Naslov'] . "</td>"; 
                                //echo "<td>" . $row['Opis'] . "</td>"; 
                                echo "<td>" . $row['Pot_Do_Datoteke'] . "</td>"; 
                                echo "</tr>";
                            }
                        
                            
                            mysqli_free_result($result);
                        } else {
                            
                            echo "Error: " . mysqli_error($link);
                        }
                        ?>
                </tbody>
            </table>

        </div>
        <div class="col-md-12 container">
            <h4 class="text1">Naloge</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text2">#</th>
                        <th scope="col" class="text2">Naslov naloge</th>
                        <th scope="col" class="text2">Navodila</th>
                        <th scope="col" class="text2">Rok oddaje</th>
                        <th scope="col" class="text2"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT naloge.Naslov AS naloge_Naslov, naloge.Rok, gradiva.Pot_Do_Datoteke, gradiva.Naslov AS gradiva_Naslov
                    FROM naloge 
                    LEFT JOIN gradiva ON naloge.Naloga_ID = gradiva.Naloga_ID 
                    WHERE naloge.Razred_ID = $razredID";
                    $result = mysqli_query($link, $sql);
                    $i = 1;
                    if ($result) {
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $i . "</td>"; 
                            echo "<td>" . $row['naloge_Naslov'] . "</td>";
                            echo "<td>" . $row['gradiva_Naslov'] . "</td>"; 
                            echo "<td>" . $row['Rok'] . "</td>"; 
                            echo "<td><button class='btn btn-primary'>Oddaj</button></td>";
                            echo "</tr>";
                        }
                    
                        // Free the result set
                        mysqli_free_result($result);
                    } else {
                        // Handle query error
                        echo "Error: " . mysqli_error($link);
                    }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>



