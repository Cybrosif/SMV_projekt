<?php
    include '../session_start.php';
    include '../../db.php';

    if(isset($_POST['taskId'])) {
        $taskId = $_POST['taskId'];
        $classId = $_POST['classId'];

        // Fetch task data and file-related information from the database
        $query = "SELECT n.*, g.Naslov AS GradivaNaslov, g.Pot_Do_Datoteke AS GradivaPot
                  FROM naloge n
                  LEFT JOIN gradiva g ON n.Gradiva_ID = g.Gradivo_ID
                  WHERE n.Naloga_ID = '$taskId'";

        $result = mysqli_query($link, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $taskData = mysqli_fetch_assoc($result);
            $taskName = $taskData['Naslov'];
            $deadline = $taskData['Rok'];
            $isVisible = $taskData['Visible'];
            $fileTitle = $taskData['GradivaNaslov']; // File title from gradiva table
            $filePath = $taskData['GradivaPot']; // File path from gradiva table
        } else {
            // Handle error if no task found
            echo "Task not found!";
        }
    }
?>
<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Spremeni nalogo</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="name" class="form-label">Ime naloge:</label>
        <input class="form-control" type="text" name="name" id="name" value="<?php echo $taskName; ?>">
    </div>
    <div class="mb-3">
        <label for="deadline" class="form-label">Rok oddaje:</label>
        <input class="form-control" type="date" name="deadline" id="deadline" value="<?php echo $deadline; ?>">
    </div>
    <div class="mb-3">
        <label for="fileToUpload" class="form-label">Navodila:</label>
        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
        <!-- Display existing file information if available -->
    </div>
    <div class="mb-3">
        <label for="isVisible" class="form-label">Dodeli nalogo:</label>
        <input class="form-check-input" type="checkbox" id="isVisible" <?php echo $isVisible == 1 ? 'checked' : ''; ?>>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
    <button type="button" id="submitBtn" class="btn btn-primary btn-primary">Spremeni nalogo</button>
</div>

<script>
   $(document).ready(function(){
    $("#submitBtn").on("click", function(){
        var name = $("#name").val();
        var deadline = $("#deadline").val(); // Get deadline value
        var fileToUpload = $("#fileToUpload")[0].files[0]; 
        var isVisible = $("#isVisible").is(":checked"); // Get checkbox state
        var taskId = <?php echo $taskId; ?>; 
        var classId = <?php echo $classId; ?>; 

        var formData = new FormData();
        formData.append("name", name); 
        formData.append("deadline", deadline); // Append deadline to form data
        formData.append("fileToUpload", fileToUpload);
        formData.append("isVisible", isVisible); // Append isVisible to form data
        formData.append("taskId", taskId); 
        formData.append("classId", classId); 

        $.ajax({
            type: "POST",
            url: "../controllers/edit_task.php",
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

