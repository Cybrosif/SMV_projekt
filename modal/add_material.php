<?php
    include '../session_start.php';
    include '../../db.php';
    //include '../functions/add_material_check.php';

    if(isset($_POST['classId'])) {
        $classId = $_POST['classId'];
    }
?>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nalaganje gradiva</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="name" class="form-label">Ime gradiva:</label>
        <input class="form-control" type="text" name="name" id="name">
    </div>
    <div class="mb-3">
        <label for="fileToUpload" class="form-label">Izberi datoteko:</label>
        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
    </div>  
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
    <button type="button" id="submitBtn" class="btn btn-primary btn-primary">Dodaj gradivo</button>
</div>

<script>
    $(document).ready(function(){
        $("#submitBtn").on("click", function(){
            var name = $("#name").val();
            var fileToUpload = $("#fileToUpload")[0].files[0]; 
            var classId = <?php echo $classId; ?>; 

            var formData = new FormData();
            formData.append("name", name); 
            formData.append("fileToUpload", fileToUpload); 
            formData.append("classId", classId); 

            $.ajax({
                type: "POST",
                url: "../controllers/upload_material.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response); 
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Handle errors
                }
            });
        });
    });
</script>
