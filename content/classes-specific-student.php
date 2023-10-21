<?php
    include '../../db.php';
    include '../session_start.php';
    //PREVERJANJE CE JE DIJAK
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
<style> 
    .assigement{
        border-radius: 5px;
        /*box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);*/
        border: 1px solid black;
        padding: 5px;
        margin-bottom: 5px;
    }
</style>
    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <!-- Modal content goes here -->
            </div>
        </div>
    </div>

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
                   $sql = "SELECT naloge.Naslov AS naloge_Naslov, naloge.Naloga_ID, naloge.Rok, 
                   COALESCE(gradiva.Pot_Do_Datoteke, 'N/A') AS Pot_Do_Datoteke, 
                   gradiva.Naslov AS gradiva_Naslov
                   FROM naloge 
                   LEFT JOIN gradiva ON naloge.Gradiva_ID = gradiva.Gradivo_ID
                   WHERE naloge.Razred_ID = $razredID";           
                    $result = mysqli_query($link, $sql);
                    $i = 1;
                    if ($result) {
                        
                        while ($row = mysqli_fetch_assoc($result)) {           
                            $fileExtension = pathinfo($row['Pot_Do_Datoteke'], PATHINFO_EXTENSION);
                            $downloadFileName = $row['gradiva_Naslov'] . '.' . $fileExtension;
                            echo "<tr>";
                            echo "<td>" . $i . "</td>"; 
                            echo "<td>" . $row['naloge_Naslov'] . "</td>";
                            echo "<td><a href='../uploads/" . $row['Pot_Do_Datoteke'] . "' download='" . $downloadFileName . "'>" . $row['gradiva_Naslov'] . "</a></td>"; 
                            echo "<td>" . $row['Rok'] . "</td>"; 
                            echo "<td><button class='btn btn-primary submit' data-nalogaid='" . $row['Naloga_ID'] . "'>Naloži datoteko</button></td>";
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

<script>
    $(document).ready(function() {
        $('table').on('click', '.submit', function(){
            var nalogaId = $(this).data('nalogaid');     
            $.ajax({
                type: 'POST',
                url: '../modal/upload-file-student.php', 
                data: { nalogaId: nalogaId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    console.log(nalogaId);
                    //$('#editUserModal .modal-dialog').removeClass('modal-xl');
                }
            });
        });
    });
</script>