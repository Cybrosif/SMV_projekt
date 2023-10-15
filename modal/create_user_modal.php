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
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ustvari uporabnika</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
        <div class="mb-3">
            <label for='name' class='form-label'>Ime:</label>
            <input type='text' class='form-control' id='name' name='name' value='' placeholder="Vnesite ime">
        </div>  
                            
        <div class="mb-3">
            <label for='surname' class='form-label'>Priimek:</label>
            <input type='text' class='form-control' id='surname' name='surname' value='' placeholder="Vnesite priimek">
        </div> 

        <div class="mb-3">     
            <label for='email' class='form-label'>Email:</label>              
            <input type='text' class='form-control' id='email' name='email' value='' placeholder="Vnesite email">
        </div> 

        <div class="mb-3">     
            <label for='password' class='form-label'>Geslo:</label>              
            <input type='password' class='form-control mb-1' id='password' name='password' value='' placeholder="Vnesite geslo">  
            <input type='password' class='form-control' id='confirmPassword' name='confirmPassword' value='' placeholder="Ponovno vnesite geslo">
            <div id="passwordError" class="error-message"></div>
        </div>

        <div class="mb-3">     
            <label for="vloga">Izberite tip uporabnika:</label>
            <select class="form-select" id="vloga" name="vloga">
                <option value="Profesor">Profesor</option>
                <option value="Dijak">Dijak</option>
            </select>
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

            if(formObject.name === '' || formObject.surname === '' || formObject.email === '' || formObject.password === '' || formObject.confirmPassword === '' || formObject.vloga === '') {
                $('#error').text('Prosim vnesite vsa polja!');
                return;
            }
        if (formObject.password !== formObject.confirmPassword) {
            $('#error').text('Gesli se ne ujemata!');
            return;
        }
            $.ajax({
                type: 'POST',
                url: '../controllers/create-user.php', 
                data: formData,
                success: function(response){
                    $('#editUserModal').modal('hide');
                    //console.log(response);
                    location.reload();
                }
            });
        });
    });

</script>