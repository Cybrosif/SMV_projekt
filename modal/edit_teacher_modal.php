<?php
    include '../session_start.php';
    include '../../db.php';
    $userId = $_POST['userId'];

    $sql = "SELECT * FROM Uporabniki 
    LEFT JOIN ucitelji_razredi ON Uporabniki.ID = ucitelji_razredi.Ucitelj_ID 
    WHERE Uporabniki.ID = $userId";

    $result = $link->query($sql);

    if ($result) {
    if ($result->num_rows > 0) {
        $subjects = array(); // Initialize an empty array to store subject IDs

        while ($row = $result->fetch_assoc()) {
            $ime = $row["Ime"];
            $priimek = $row["Priimek"];
            $email = $row["Email"];
            $subjectId = $row["Razred_ID"];
            // Do something with $ime and $subjectId
            // For example, you can add subject IDs to the $subjects array
            $subjects[] = $subjectId;
        }

        // Now $subjects array contains the IDs of subjects the user is associated with
        // You can use this array as needed
    } else {
        echo "No results found";
    }

    $result->free(); // Free the result set
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo $ime; ?></h1>
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
                            <label class="btn btn-secondary" id="show-classes">Prikaži predmete:</label><br>
                            <div style="display: none;" id="hidden-div">
                                <?php
                                    foreach ($allSubjects as $subject) {
                                        $isChecked = in_array($subject['Razred_ID'], $subjects) ? 'checked' : '';
                                        echo '<div class="form-check form-check-inline">';
                                        echo '<input class="form-check-input" type="checkbox" name="subjects[]" value="' . $subject['Razred_ID'] . '" ' . $isChecked . '>';
                                        echo '<label class="form-check-label">' . $subject['Ime_razreda'] . '</label>';
                                        echo '</div>';
                                    }
                                ?>
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
                newText = 'Skrij predmete:'; // Change text to this when button is clicked
            } else {
                newText = originalText; // Change text back to original when button is clicked again
            }
            $('#show-classes').text(newText);

            // Toggle the arrow icon
            $('#show-classes').change
            // Toggle the visibility of the previous div
            $('#hidden-div').toggle();
        });

        $('#editUserForm').on('submit', function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '../controllers/edit_teacher.php', 
                data: formData,
                success: function(response){
                    console.log(formData);
                    $('#editUserModal').modal('hide');
                    console.log(response);
                    location.reload();
                }
            });
        });
    });

</script>
