<?php
include '../session_start.php';
include '../../db.php';
include '../functions/upload-file-check.php';

$taskId = $_POST['nalogaId'];
?>

<style>
.custom-sm-button {
    font-size: 10px;
    width: 15px;
    height: 15px;
    padding: 0;
    text-align: center;
    line-height: 15px;
}
</style>

<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Naložite datoteko</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form id="uploadForm" action="../controllers/upload_naloga.php" method="post" enctype="multipart/form-data">
    <div class="modal-body">
    <input type="hidden" name="Naloga_ID" value="<?php echo $taskId; ?>">
        <div class="mb-3">
            <input class="form-control" type="file" name="fileToUpload[]" id="fileToUpload" multiple>
        </div>
        <div class="mb-3">
            <?php
                $sql = "SELECT * FROM student_naloge WHERE Student_ID = {$_SESSION['user_id']} AND Naloga_ID = $taskId";
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    die('Query Error: ' . mysqli_error($link));
                }
                if (mysqli_num_rows($result) > 0) {
                    echo '<p class="text1">Naložene datoteke:</p>';
                    while ($row = mysqli_fetch_assoc($result)) {

                        $downloadFileName = $row['Original_Filename'];
                        echo '<div class="d-flex" id="file-' . $row['Student_Naloga_ID'] . '">';
                        echo "<td><div class='file-name'><a href='../uploads/" . $row['Pot_Do_Datoteke'] . "' download='" . $downloadFileName . "'>" .$downloadFileName . "</a></div></td>"; 
                        echo '<button type="button" class="delete-button btn btn-danger custom-sm-button" data-fileid="' . $row['Student_Naloga_ID'] . '">-</button>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Niste še oddali naloge.</p>';
                }
            ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Prekliči</button>
        <button type="submit" id="uploadBtn" class="btn btn-primary btn-primary">Oddaj</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $('#uploadForm').submit(function(event) {
            event.preventDefault(); 
            console.log('Form submitted'); 
            var taskId = $('[name="taskId"]').val(); 
            var formData = new FormData($(this)[0]); 
            formData.append('taskId', taskId); 

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST', 
                data: formData, 
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                   
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error); 
                }
            });
        });

        $(document).on('click', '.delete-button', function() {
            var fileId = $(this).data('fileid');
            var fileEntryId = '#file-' + fileId; // Create the ID of the wrapping div element

            $.ajax({
                url: '../controllers/delete-file.php',
                method: 'POST',
                data: { fileId: fileId },
                success: function(response) {
                    $(fileEntryId).remove();
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error); // Debugging: Check if there are any errors
                }
            });
        });
    });
</script>
