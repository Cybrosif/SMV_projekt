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
                    //console.log(formData);
                    $('#editClassForm').modal('hide');
                    //console.log(response);
                    location.reload();
                }
            });
        });
    });

</script>
