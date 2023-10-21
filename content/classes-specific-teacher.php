<?php
    include '../../db.php';
    include '../session_start.php';
    //PREVERJANJE CE JE UCTIL
    $ime_razreda = null;

    if(isset($_GET['razredID']))
    {
        $razredID = $_GET['razredID'];
        $sql = "SELECT Ime_razreda FROM razredi 
                WHERE Razred_ID = $razredID";

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

<h1 class='text-center primary-text my-4'><?php echo $ime_razreda;?></h1>
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
                        $sql = "SELECT * FROM gradiva
                        WHERE Razred_ID = $razredID 
                        AND NOT EXISTS (
                            SELECT 1 FROM naloge 
                            WHERE naloge.Gradiva_ID = gradiva.Gradivo_ID
                        )";
                
                        $result = mysqli_query($link, $sql);
                        $i = 1;
                        if ($result) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                $fileExtension = pathinfo($row['Pot_Do_Datoteke'], PATHINFO_EXTENSION);
                                $downloadFileName = $row['Naslov'] . '.' . $fileExtension;
                                echo "<tr>";
                                echo "<td>" . $i . "</td>"; 
                                echo "<td><a href='../uploads/" . $row['Pot_Do_Datoteke'] . "' download='" . $downloadFileName . "'>" . $row['Naslov'] . "</a></td>"; 
                                echo "<td></td>"; 
                                echo "<td></td>"; 
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
    </div>
    <div class="row">
        <div class="col-md-12 mb-3 container">
            Naloge
        </div>
    </div>
</div>