<?php
    include '../functions/check_if_admin.php';
    include '../session_start.php';
    include '../../db.php';
?>

<style>
    .col{
        border:1px solid black;
        border-radius: 5px;
        margin:5px;
    }
</style>
<div class="container">
    <h1 class='text-center primary-text'>Upravljanje uporabnikov</h1>
        <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- Modal content goes here -->
                </div>
            </div>
        </div>
        

        <div class="mb-3">
            <label for="filter">Filtriraj po vlogi:</label>
            <select class="form-select" id="filter" name="filter">
                <option value="all">Vsi uporabniki</option>
                <option value="Profesor">Profesorji</option>
                <option value="Dijak">Dijaki</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="search">Išči:</label>
            <input type="text" class="form-control" id="search" placeholder="Vpišite pojem za iskanje...">
        </div>


        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Ime</th>
            <th scope="col">Priimek</th>
            <th scope="col">E-mail</th>
            <th scope="col">Vloga</th>
            <th scope="col"></th>
            
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        loadUsers();

        
        $('#filter, #search').on('input', function(){
            loadUsers(); 
        });

        
        $('table').on('click', '.edit-btn', function(){
            var userId = $(this).data('userid');     
            
            $.ajax({
                type: 'POST',
                url: '../modal/edit_user_modal.php', 
                data: { userId: userId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show'); 
                }
            });
        });

        function loadUsers() {
            var filterValue = $('#filter').val();
            var searchQuery = $('#search').val();

            $.ajax({
                type: 'POST',
                url: '../controllers/load_users.php',
                data: { filter: filterValue, search: searchQuery },
                success: function(response){
                    $('table tbody').html(response); 
                }
            });
        }
    });

</script>





