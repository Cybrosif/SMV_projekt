<?php
    include '../session_start.php';
    include '../../db.php';
    include '../functions/check_if_admin.php';
    $userId = $_POST['userId'];

    $sql = "SELECT Vloga FROM uporabniki WHERE ID = $userId";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $vloga = $row["Vloga"];
    }
    $result->free();

    if($vloga == "Dijak")
    {
        $sql = "SELECT * FROM uporabniki 
        LEFT JOIN uporabniki_razredi ON uporabniki.ID = uporabniki_razredi.Uporabnik_ID 
        WHERE uporabniki.ID = $userId";
        $controller = '../controllers/edit_student.php';
    }
    else if($vloga == "Profesor")
    {
        $sql = "SELECT * FROM uporabniki 
        LEFT JOIN ucitelji_razredi ON uporabniki.ID = ucitelji_razredi.Ucitelj_ID 
        WHERE uporabniki.ID = $userId";
        $controller = '../controllers/edit_teacher.php';
    }
    else
    {
        exit();
    }
    $result = $link->query($sql);

    if ($result) {
    if ($result->num_rows > 0) {
        $subjects = array(); 

        while ($row = $result->fetch_assoc()) {
            $ime = $row["Ime"];
            $priimek = $row["Priimek"];
            $email = $row["Email"];
            $subjectId = $row["Razred_ID"];
            $subjects[] = $subjectId;
        }

    } else {
        echo "No results found";
    }

    $result->free(); 
    } else {
    echo "Error: " . $link->error;
    }

            $sql = "SELECT Razred_ID, Ime_razreda FROM razredi";

            $result = $link->query($sql);
            
            if ($result->num_rows > 0) {   
                $allSubjects = array();
                while($row = $result->fetch_assoc()) {
                    $classId = $row["Razred_ID"];
                    $className = $row["Ime_razreda"];
                    // Store class data in the $allSubjects array
                    $allSubjects[] = array("Razred_ID" => $classId, "Ime_razreda" => $className);
                }
            } else {
                echo "0 results found";
            }
?>

<form id="editUserForm">
                    <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $vloga; ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for='name' class='form-label'>Ime:</label>
                            <input type='text' class='form-control' id='name' name='name' value='<?php echo $ime; ?>'>
                        </div>  
                            
                        <div class="mb-3">
                            <label for='surname' class='form-label'>Priimek:</label>
                            <input type='text' class='form-control' id='surname' name='surname' value='<?php echo $priimek; ?>'>
                        </div> 

                        <div class="mb-3">     
                            <label for='email' class='form-label'>Email:</label>              
                            <input type='text' class='form-control' id='email' name='email' value='<?php echo $email; ?>'>
                        </div> 

                        <div class="mb-3">     
                            <label for='password' class='form-label'>Geslo:</label>              
                            <input type='text' class='form-control' id='password' name='password' value='' placeholder="****">
                        </div> 
                        
                        <div class="mb-3">
                            <label class="btn btn-secondary mb-1" id="show-classes">Prikaži predmete:</label><br>
                            <div style="display: none;" id="hidden-div" class="overflow-auto" style="max-height: 200px;">
                                <input type="text" id="subject-search" class="form-control mb-2" placeholder="Iskanje predmetov">
                                <div style="max-height: 250px; overflow-y: auto;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Razred ID</th>
                                                <th>Ime razreda</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($allSubjects as $subject) {
                                                    $isChecked = in_array($subject['Razred_ID'], $subjects) ? 'checked' : '';
                                                    echo '<tr>';
                                                    echo '<td>' . $subject['Razred_ID'] . '</td>';
                                                    echo '<td>' . $subject['Ime_razreda'] . '</td>';
                                                    echo '<td>';
                                                    echo '<div class="form-check form-check-inline">';
                                                    echo '<input class="form-check-input" type="checkbox" name="subjects[]" value="' . $subject['Razred_ID'] . '" ' . $isChecked . '>';
                                                    echo '</div>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
                        <button type="submit" class="btn btn-primary">Shrani</button>
                    </div>
</form>

<script>
    $(document).ready(function(){

        var originalText = $('#show-classes').text();

        $('#show-classes').click(function(){
            var currentText = $('#show-classes').text();
            var newText = '';

            if (currentText === originalText) {
                newText = 'Skrij predmete:'; 
            } else {
                newText = originalText;
            }
            $('#show-classes').text(newText);

            
            $('#show-classes').change
           
            $('#hidden-div').toggle();
        });

        $('#editUserForm').on('submit', function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '<?php echo $controller; ?>', 
                data: formData,
                success: function(response){
                    console.log(formData);
                    $('#editUserModal').modal('hide');
                    console.log(response);
                    location.reload();
                }
            });
        });

        $('#subject-search').on('input', function(){
        var searchText = $(this).val().toLowerCase();
        $('#hidden-div tbody tr').each(function(){
            var subjectInfo = $(this).text().toLowerCase();
            var isVisible = (subjectInfo.indexOf(searchText) !== -1);
            $(this).toggle(isVisible);
        });
    });
    });

</script>
