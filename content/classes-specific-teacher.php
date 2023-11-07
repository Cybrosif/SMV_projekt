<?php
    include '../../db.php';
    include '../session_start.php';
    
    $ime_razreda = null;
    $userRole = $_SESSION['user_vloga'];
    $userId = $_SESSION['user_id'];
    $razredID = $_GET['razredID'];

    $belongsRazred = false;
    if ($userId && $razredID) {

        $sql = "SELECT 1 FROM ucitelji_razredi WHERE Ucitelj_ID = $userId AND Razred_ID = $razredID LIMIT 1";

        $result = mysqli_query($link, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($link));
        }

        if (mysqli_num_rows($result) > 0) {
            $belongsRazred = true;
        }

        mysqli_free_result($result);
    }

    if ($belongsRazred == false) {
        echo '<script type="text/javascript">window.location.href = "home.php?page=classes";</script>';
        exit; // Ensure no further code is executed after a redirect
    }


    if(isset($_GET['razredID']))
    {
        $razredID = $_GET['razredID'];
        $sql = "SELECT Ime_razreda FROM razredi 
                WHERE Razred_ID = $razredID";

    $result = mysqli_query($link, $sql);

    if($result) {
        // Fetch the data from the result and store it in variables
        $row = mysqli_fetch_assoc($result);
        if($row) {
            $ime_razreda = $row['Ime_razreda'];
        }

        mysqli_free_result($result);
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($link);
    }


    }
?>
<style>
    .delete{
        height: 20px;
        width: 20px;
        padding: 0;
    text-align: center;
    line-height: 15px;
    }
</style>
<div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- Modal content goes here -->
        </div>
     </div>
</div>
<h1 class='text-center primary-text my-4'><?php echo $ime_razreda;?></h1>
<div class="container" style="box-shadow: none; background-color: transparent;">
    <div class="row">
        <div class="col-md-12 mb-3 container">
        <h4 class="text1">Gradiva</h4>
        <button class="btn btn-primary" id="addFile" data-classid="<?php echo $razredID; ?>">Dodaj gradivo</button>
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
                                echo "<tr >";
                                echo "<td>" . $i . "</td>"; 
                                echo "<td><a href='../uploads/" . $row['Pot_Do_Datoteke'] . "' download='" . $downloadFileName . "'>" . $row['Naslov'] . "</a></td>"; 
                                echo "<td></td>"; 
                                echo "<td><button data-gradivoid='" . $row['Gradivo_ID'] . "' class='btn btn-danger btn-sm delete delete-file'><i class='fas fa-times'></i></button></td>"; 
                                echo "</tr>";
                                $i++;
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
        <h4 class="text1">Naloge</h4>
        <button class="btn btn-primary" id="addTask" data-classid="<?php echo $razredID; ?>">Dodaj nalogo</button>
        <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text2">#</th>
                        <th scope="col" class="text2">Naslov naloge</th>
                        <th scope="col" class="text2">Navodila</th>
                        <th scope="col" class="text2">Rok oddaje</th>
                        <th scope="col" class="text2"></th>
                        <th scope="col" class="text2"></th>
                        <th scope="col" class="text2"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   $sql = "SELECT naloge.Visible, naloge.Naslov AS naloge_Naslov, naloge.Naloga_ID, naloge.Rok, 
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
                            $downloadFileName = $row['gradiva_Naslov'];
                            $visibilityClass = $row['Visible'] ? 'text-success' : 'text-danger';
                            echo "<tr>";
                            echo "<td>" . $i . "</td>"; 
                            echo "<td class='$visibilityClass'>" . $row['naloge_Naslov'] . "</td>";
                            echo "<td><a href='../uploads/" . $row['Pot_Do_Datoteke'] . "' download='" . $downloadFileName . "'>" . $row['gradiva_Naslov'] . "</a></td>"; 
                            echo "<td>" . $row['Rok'] . "</td>"; 
                            echo "<td><button class='btn btn-sm btn-warning editTask'  data-nalogaid='" . $row['Naloga_ID'] . "'>Uredi nalogo</button></td>";
                            echo "<td><button data-nalogaid='" . $row['Naloga_ID'] . "' class='btn btn-secondary btn-sm redirect'>oddaje</button></td>";
                            echo "<td><button data-nalogaid='" . $row['Naloga_ID'] . "' class='btn btn-danger btn-sm delete delete-task'><i class='fas fa-times'></i></button></td>"; 
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
</div>


<script>
   $(document).ready(function() {
        
        $(".delete-file").on("click", function() {
            var gradivoID = $(this).data("gradivoid");

            $.ajax({
                type: "POST",
                url: "../controllers/delete-file.php", 
                data: { fileId: gradivoID },
                success: function(response) {
                    console.log(response); 
                        location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });
        });

        $('table').on('click', '.redirect', function(){
            var taskId = $(this).data('nalogaid');
            var redirectUrl = '../views/home.php?page=submits&Naloga_ID=' + taskId;

            window.location.href = redirectUrl;

        });

        $('table').on('click', '.editTask', function(){
            var taskId = $(this).data('nalogaid');
            var classId = <?php echo $razredID; ?>;

            $.ajax({
                type: 'POST',
                url: '../modal/edit_task_modal.php', 
                data: { taskId: taskId, classId: classId }, 
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                }
            });
        });

        $('table').on('click', '.delete-task', function(){
            var taskId = $(this).data('nalogaid');

            $.ajax({
                type: 'POST',
                url: '../modal/delete_task_modal.php', 
                data: { taskId: taskId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });
        });

        
        $("#addFile").click(function(){
         var classId = $(this).data("classid");
        $.ajax({
                type: 'POST',
                url: '../modal/add_material.php', 
                data: { classId: classId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                }
            });
        });

        $("#addTask").click(function(){
         var classId = $(this).data("classid");
        $.ajax({
                type: 'POST',
                url: '../modal/add_task.php', 
                data: { classId: classId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                }
            });
        });

    });
</script>