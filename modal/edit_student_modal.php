<?php
    include '../session_start.php';
    include '../../db.php';
    $userId = $_POST['userId'];

    $sql = "SELECT * FROM uporabniki 
    LEFT JOIN uporabniki_razredi ON uporabniki.ID = uporabniki_razredi.Uporabnik_ID 
    WHERE uporabniki.ID = $userId";

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
                            <label class="form-label">Izberi razrede:</label><br>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
                        <button type="submit" class="btn btn-primary">Shrani</button>
                    </div>
</form>

<script>
    
    $('#editUserForm').on('submit', function(event){
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '../controllers/edit_student.php', 
            data: formData,
            success: function(response){
                console.log(formData);
                $('#editUserModal').modal('hide');
                console.log(response);
                location.reload();
            }
        });
    });
</script>
