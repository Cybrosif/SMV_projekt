<?php
    include '../session_start.php';
    include '../../db.php';
    include '../functions/add_task_check.php'

    if(isset($_POST['classId'])) {
        $classId = $_POST['classId'];
    }
?>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Dodajanej nalog</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="name" class="form-label">Ime naloge:</label>
        <input class="form-control" type="text" name="name" id="name">
    </div>
    <div class="mb-3">
        <label for="deadline" class="form-label">Rok oddaje:</label>
        <input class="form-control" type="date" name="deadline" id="deadline">
    </div>
    <div class="mb-3">
        <label for="fileToUpload" class="form-label">Navodila:</label>
        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <div class="mb-3">
    <label for="isVisible" class="form-label">Dodeli nalogo:</label>
    <input class="form-check-input" type="checkbox" id="isVisible">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
    <button type="button" id="submitBtn" class="btn btn-primary btn-primary">Dodaj nalogo</button>
</div>

<script>
   $(document).ready(function(){
    $("#submitBtn").on("click", function(){
        var name = $("#name").val();
        var deadline = $("#deadline").val(); // Get deadline value
        var fileToUpload = $("#fileToUpload")[0].files[0]; 
        var isVisible = $("#isVisible").is(":checked"); // Get checkbox state
        var classId = <?php echo $classId; ?>; 

        var formData = new FormData();
        formData.append("name", name); 
        formData.append("deadline", deadline); // Append deadline to form data
        formData.append("fileToUpload", fileToUpload);
        formData.append("isVisible", isVisible); // Append isVisible to form data
        formData.append("classId", classId); 

        $.ajax({
            type: "POST",
            url: "../controllers/add_task.php",
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

