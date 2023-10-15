<?php
    include '../session_start.php';
    include '../../db.php';
    include '../functions/check_if_admin.php';
    $userId = $_POST['userId'];
?>
     <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pozor<i class="fas fa-exclamation-triangle"></i></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Ste prepričani da želite odstraniti uporabnika?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
        <button type="button" id="deleteBtn" class="btn btn-primary btn-danger">Da</button>
      </div>


<script>
    $(document).ready(function(){

        $('#deleteBtn').on('click', function(event){
            event.preventDefault();
            var userid = <?php echo $userId ?>;
            $.ajax({
                type: 'POST',
                url: '../controllers/delete_user.php', 
                data: { userId: userid },
                success: function(response){
                    $('#editUserModal').modal('hide');
                    //console.log(response);
                    location.reload();
                }
            });
        });
    });

</script>
