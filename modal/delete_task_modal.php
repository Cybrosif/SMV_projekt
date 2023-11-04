<?php
    include '../session_start.php';
    include '../../db.php';
    // include '../functions/delete_task_check.php';

    if(isset($_POST['taskId'])) {
        $taskId = $_POST['taskId'];
    }
?>
     <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pozor<i class="fas fa-exclamation-triangle"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Ste prepričani da želite izbrisati nalogo?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
        <button type="button" id="deleteBtn" class="btn btn-primary btn-danger">Da</button>
      </div>


<script>
    $(document).ready(function(){

        $('#deleteBtn').on('click', function(event){
            event.preventDefault();
            var taskId = <?php echo $taskId ?>;
            $.ajax({
                type: 'POST',
                url: '../controllers/delete_task.php', 
                data: { taskId: taskId },
                success: function(response){
                    $('#editUserModal').modal('hide');
                    console.log(response);
                    location.reload();
                }
            });
        });
    });

</script>
