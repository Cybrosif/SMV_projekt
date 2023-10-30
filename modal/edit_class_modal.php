<?php
    include '../session_start.php';
    include '../../db.php';
    include '../functions/check_if_admin.php';
    $classId = $_POST['classId'];

    
    $sql = "SELECT Ime_razreda, Kljuc_Vpisa FROM razredi WHERE Razred_ID = $classId";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ime = $row["Ime_razreda"];
        $kljuc = $row["Kljuc_Vpisa"];
    }

    $sql = "SELECT * FROM razredi 
    LEFT JOIN ucitelji_razredi ON razredi.Razred_ID = ucitelji_razredi.Razred_ID 
    WHERE razredi.Razred_ID = $classId";

    $result2 = $link->query($sql);
    if (!$result2) {
        //die("Error in SQL query: " . $link->error);
        die();
    }
    if ($result2->num_rows > 0) {
    $teachers = array(); // Initialize an empty array to store subject IDs

    while ($row = $result2->fetch_assoc()) {
        $teacherId = $row["Ucitelj_ID"];
        // Do something with $subjectId (as $ime is not defined in your query)
        // For example, you can add subject IDs to the $subjects array
        $teachers[] = $teacherId;
    }

    // Now $subjects array contains the IDs of subjects the user is associated with
    // You can use this array as needed
    } else {
    echo "No results found";
    }

    $sql = "SELECT ID, Ime, Priimek, Email FROM uporabniki WHERE Vloga = 'Profesor' OR Vloga = 'Administrator'";
    $result3 = $link->query($sql);
        if ($result3->num_rows > 0) {   
            $allTeachers = array();
            while($row = $result3->fetch_assoc()) {
                $teahcerId = $row["ID"];
                $teahcerName = $row["Ime"];
                $teahcerSurname = $row["Priimek"];
                $teahcerEmail = $row["Email"];
                // Store class data in the $allSubjects array
                $allTeachers[] = array("ID" => $teahcerId, "Email" => $teahcerEmail, "Ime" => $teahcerName, "Priimek" => $teahcerSurname);
            }
            } else {
                echo "0 results found";
            }
?>


    <form id="editClassForm">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Uredi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                    <input type="hidden" name="classId" value="<?php echo $classId; ?>">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for='name' class='form-label'>Ime:</label>
                            <input type='text' class='form-control' id='name' name='name' value='<?php echo $ime; ?>'>
                        </div>  
                            
                        <div class="mb-3">
                            <label for='key' class='form-label'>Ključ vpisa:</label>
                            <input type='text' class='form-control' id='key' name='key' value='<?php echo $kljuc; ?>'>
                        </div>

                        <div class="mb-3">
                            <label class="btn btn-secondary mb-1" id="show-teachers">Prikaži profesorje:</label><br>
                            <div style="display: none;" id="hidden-div">
                                <input type="text" id="teacher-search" class="form-control" placeholder="Iskanje profesorjev">
                                <div style="max-height: 400px; overflow-y: auto;">
                                    <table class="table">           
                                        <thead>
                                            <tr>
                                                <th>Ime</th>
                                                <th>Priimek</th>
                                                <th>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php foreach ($allTeachers as $teacher): ?>
                                                <tr>
                                                    <td><?php echo $teacher['Ime']; ?></td>
                                                    <td><?php echo $teacher['Priimek']; ?></td>
                                                    <td><?php echo $teacher['Email']; ?></td>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="teachers[]" value="<?php echo $teacher['ID']; ?>" <?php echo in_array($teacher['ID'], $teachers) ? 'checked' : ''; ?>>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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
    $('#editClassForm').on('submit', function(event){
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '../controllers/edit_class.php', 
            data: formData,
            success: function(response){
                $('#editClassForm').modal('hide');
                location.reload();
            }
        });
    });

    var originalText = $('#show-teachers').text();

    $('#show-teachers').click(function(){
        var currentText = $('#show-teachers').text();
        var newText = (currentText === originalText) ? 'Skrij profesorje:' : originalText;
        $('#show-teachers').text(newText);
        $('#hidden-div').toggle();
    });


    $('#teacher-search').on('input', function(){
        var searchText = $(this).val().toLowerCase();
        $('#hidden-div tbody tr').each(function(){
            var teacherInfo = $(this).text().toLowerCase();
            var isVisible = (teacherInfo.indexOf(searchText) !== -1);
            $(this).toggle(isVisible);
        });
    });
});



</script>
