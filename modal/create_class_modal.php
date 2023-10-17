<?php
    include '../session_start.php';
    include '../../db.php';
    include '../functions/check_if_admin.php';
?>
<style>
.error-message {
    color: red;
    font-size: 14px;
}
</style>
<form>
<div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ustvari razred</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
        <div class="mb-3">
            <label for='name' class='form-label'>Ime:</label>
            <input type='text' class='form-control' id='name' name='name' value='' placeholder="Vnesite ime">
            <div id="name-error" class="text-danger"></div>
        </div>  
                            
        <div class="mb-3">
            <label for='key' class='form-label'>Ključ vpisa:</label>
            <input type='text' class='form-control' id='key' name='key' value='' placeholder="Vnesite priimek">
        </div>                
        <div id="error" class="error-message"></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
    <button type="submit" id="createBtn" class="btn btn-primary btn-primary">Ustvari</button>
</div>
</form>
<script>
    $(document).ready(function(){

        $('#createBtn').on('click', function(event){
            event.preventDefault();
            var formData = $('form').serializeArray();
            var formObject = {};
            $.each(formData, function(index, field) {
                formObject[field.name] = field.value;
            });

            if(formObject.name === '' || formObject.key === '') {
                $('#error').text('Prosim vnesite vsa polja!');
                return;
            }
            $.ajax({
                type: 'POST',
                url: '../controllers/create-class.php', 
                data: formData,
                success: function(response){
                    $('#editUserModal').modal('hide');
                    //console.log(response);
                    location.reload();
                }
            });
        });

        $('#name').on('input', function() {
            var email = $(this).val();
            
            $.ajax({
                url: '../controllers/check_classname.php', 
                method: 'POST',
                data: { name: email },
                success: function(response) {
                    console.log(response);
                    if (response === 'exists') {
                        
                    $('#name-error').text('Ime je zasedeno.'); 
                    } else {
                        
                        $('#name-error').text('');
                    }
                }
            });
        });

    });

</script>