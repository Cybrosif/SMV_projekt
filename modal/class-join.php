<?php
    include '../session_start.php';
    include '../../db.php';
    include '../functions/class_join_check.php'
    $classId = $_POST['razredId'];
?>

<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Vpis</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-3">
        <label for="inputText" class="form-label">Vpišite ključ za vpis</label>
        <input type="text" class="form-control" id="inputText" placeholder="Vpišite...">
        <div id="error-message" class="text-danger mt-2"></div> <!-- Error message placeholder -->
    </div>
</div>
<div class="modal-footer">
    <button type="button" id="enrollBtn" class="btn btn-success">Vpis</button>
</div>

<script>
    $(document).ready(function() {
        $("#enrollBtn").on("click", function() {
            var enteredKey = $("#inputText").val();
            var classId = <?php echo $classId; ?>;
            var errorMessage = $("#error-message");

            $.ajax({
                type: "POST",
                url: "../controllers/join-class.php",
                data: { enteredKey: enteredKey, classId: classId },
                success: function(response) {
                    if (response === "success") {
                        location.reload();
                    } else if(response === "error") {
                        
                        errorMessage.text("Naroben ključ vpisa. Poskusite znova.");
                    }
                }
            });
        });
    });
</script>
