<?php
    include '../../db.php';
    include '../session_start.php';
    include '../functions/check_student.php';


$ime_razreda = null;
$userRole = $_SESSION['user_vloga'];
$userId = $_SESSION['user_id'];
$razredID = $_GET['razredID'];

$belongsRazred = false;
if ($userId && $razredID) {
    // Construct the query
    $sql = "SELECT 1 FROM uporabniki_razredi WHERE Uporabnik_ID = $userId AND Razred_ID = $razredID LIMIT 1";
    
    // Execute the query
    $result = mysqli_query($link, $sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }

    // If there's at least one row in the result, set belongsRazred to true
    if (mysqli_num_rows($result) > 0) {
        $belongsRazred = true;
    }
    
    // Free the result
    mysqli_free_result($result);
}

// If the user is not a student or does not belong to the class, redirect them.
if ($belongsRazred == false) {
    echo '<script type="text/javascript">window.location.href = "home.php?page=classes";</script>';
    exit; // Ensure no further code is executed after a redirect
}

// Fetch the razred name
if ($razredID) {
    $stmt = $link->prepare("SELECT Ime_razreda FROM razredi WHERE Razred_ID = ?");
    $stmt->bind_param("i", $razredID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $ime_razreda = $row['Ime_razreda'];
    }
    $stmt->close();
}

?>

<style> 
    .assigement {
        border-radius: 5px;
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
                   WHERE naloge.Razred_ID = $razredID
                   AND naloge.Visible = 1";           
                    $result = mysqli_query($link, $sql);
                    $i = 1;
                    if ($result) {
                        
                        while ($row = mysqli_fetch_assoc($result)) {           
                            $fileExtension = pathinfo($row['Pot_Do_Datoteke'], PATHINFO_EXTENSION);
                            $downloadFileName = $row['gradiva_Naslov'];
                            echo "<tr>";
                            echo "<td>" . $i . "</td>"; 
                            echo "<td>" . $row['naloge_Naslov'] . "</td>";
                            echo "<td><a href='../uploads/" . $row['Pot_Do_Datoteke'] . "' download='" . $downloadFileName . "'>" . $row['gradiva_Naslov'] . "</a></td>"; 
                            echo "<td>" . $row['Rok'] . "</td>"; 
                            echo "<td><button class='btn btn-primary submit' data-nalogaid='" . $row['Naloga_ID'] . "'>Naloži datoteko</button></td>";
                            echo "</tr>";
                        }
                    
                    while ($row = mysqli_fetch_assoc($result)) {           
                        $fileExtension = pathinfo($row['Pot_Do_Datoteke'], PATHINFO_EXTENSION);
                        $downloadFileName = $row['gradiva_Naslov'];
                        echo "<tr>";
                        echo "<td class='text2'>" . $i . "</td>"; 
                        echo "<td class='text2'>" . $row['naloge_Naslov'] . "</td>";
                        echo "<td class='text2'><a href='../uploads/" . $row['Pot_Do_Datoteke'] . "' download='" . $downloadFileName . "'>" . $row['gradiva_Naslov'] . "</a></td>"; 
                        echo "<td class='text2'>" . $row['Rok'] . "</td>"; 
                        echo "<td class='text2'><button class='btn btn-primary submit' data-nalogaid='" . $row['Naloga_ID'] . "'>Naloži datoteko</button></td>";
                        echo "</tr>";
                        $i++;
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
                }
            });
        });
    });
</script>
