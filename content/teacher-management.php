<?php
    include '../functions/check_if_admin.php';
    include '../session_start.php';
    include '../../db.php';
?>
<h1 class='text-center primary-text'>Upravljanje profesorjev</h1>
<body>

    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal content goes here -->
            </div>
        </div>
    </div>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Ime</th>
        <th scope="col">Priimek</th>
        <th scope="col">E-mail</th>
        <!--<th scope="col">Vloga</th>-->
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $user_id = $_SESSION['user_id'];
            $i = 1;
            $query = "SELECT * FROM Uporabniki WHERE  vloga = 'učitelj'";
            $result = mysqli_query($link, $query);   
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $row['Ime'] . '</td>
                    <td>' . $row['Priimek'] . '</td>
                    <td>' . $row['Email'] . '</td>';
                    /*<td>
                        <input type="hidden" name="user_id[]" value="'.$row['ID'].'">
                        <select style="border:none" name="vloga[]">
                            <option value="učenec" ' . ($row['Vloga'] == 'učenec' ? 'selected' : '') . '>Dijak</option>
                            <option value="učitelj" ' . ($row['Vloga'] == 'učitelj' ? 'selected' : '') . '>Profesor</option>
                        </select>
                    </td>*/
                    echo 
                    '<td>
                        <button class="btn btn-primary edit-btn" data-userid="' . $row['ID'] . '">Edit</button>
                    </td>
                    </tr>
                ';
                $i++;
            }
            
        ?>
    </tbody>
    </table>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){

        /* $('#myForm').on('submit', function(event){
                event.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize(); // Serialize form data
                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: '../controllers/user_administration.php', // Replace 'processing.php' with your actual PHP processing file
                    data: formData,
                    success: function(response){
                        // Handle the response from the server if needed
                        //console.log(response);
                    }
                });
            });*/

            $('.edit-btn').on('click', function(){
            var userId = $(this).data('userid');     
            // Load modal content via AJAX
            $.ajax({
                type: 'POST',
                url: '../modal/edit_teacher_modal.php', // PHP file to handle modal content retrieval
                data: { userId: userId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show'); // Show the modal
                }
            });
        });

    });
</script>

<style>
    .col{
        border:1px solid black;
        border-radius: 5px;
        margin:5px;
    }
</style>





