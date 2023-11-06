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
    <h1 class='text-center primary-text text1'>Upravljanje uporabnikov</h1>
    
        <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <!-- Modal content goes here -->
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <button class="btn btn-primary create-user">Ustvari uporabnika</button>
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
                <th scope="col" class="text2">#</th>
                <th scope="col" class="text2">Ime</th>
                <th scope="col" class="text2">Priimek</th>
                <th scope="col" class="text2">E-mail</th>
                <th scope="col" class="text2">Vloga</th>
                <th scope="col" class="text2"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var usersArray;
        loadUsers();
        
        function loadUsers() {
            $.ajax({
                type: 'POST',
                url: '../controllers/load_users.php',
                success: function(response){
                    usersArray = response;
                    //console.log(response);
                    loadTable(usersArray);
                }
            });
        };
    
        function loadTable(usersArray){

            var tbody = $('table tbody');
            tbody.empty();
            var i = 1;
            usersArray.forEach(function(userItem) {

                    var row = $('<tr>');
                    row.append($('<td class="text3">').text(i));
                    row.append($('<td class="text3">').text(userItem.Ime));
                    row.append($('<td class="text3">').text(userItem.Priimek));
                    row.append($('<td class="text3">').text(userItem.Email));
                    row.append($('<td class="text3">').text(userItem.Vloga));
                    var editButton = $('<button>').addClass('btn btn-primary edit-btn mx-2').attr('data-userid', userItem.ID).text('Uredi');
                    var deleteButton = $('<button>').addClass('btn btn-primary btn-danger delete-btn').attr('data-userid', userItem.ID).text('Izbriši');


                    row.append($('<td class="text3">').append(editButton).append(deleteButton));
                    tbody.append(row); 
                    i++;
            });
        };
        $('table').on('click', '.delete-btn', function(){
            var userId = $(this).data('userid');     
            $.ajax({
                type: 'POST',
                url: '../modal/delete_user_modal.php', 
                data: { userId: userId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    $('#editUserModal .modal-dialog').removeClass('modal-xl');
                }
            });
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
                    $('#editUserModal .modal-dialog').addClass('modal-xl'); 
                }
            });
        });

        $('.create-user').click(function() {
           $.ajax({
                type: 'POST',
                url: '../modal/create_user_modal.php', 
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    $('#editUserModal .modal-dialog').addClass('modal-xl'); 
                }
            });
        });



        $('#search').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            var selectedRole = $('#filter').val().toLowerCase();

            var filteredUsers = usersArray.filter(function(userItem) {
                var nameMatches = userItem.Ime.toLowerCase().includes(searchTerm) ||
                                userItem.Priimek.toLowerCase().includes(searchTerm) ||
                                userItem.Email.toLowerCase().includes(searchTerm);
                var roleMatches = selectedRole === 'all' || userItem.Vloga.toLowerCase() === selectedRole;
                
                return nameMatches && roleMatches;
            });

            loadTable(filteredUsers); 
        });

        $('#filter').on('change', function() {
            var searchTerm = $('#search').val().toLowerCase();
            var selectedRole = $(this).val().toLowerCase();

            var filteredUsers = usersArray.filter(function(userItem) {
                var nameMatches = userItem.Ime.toLowerCase().includes(searchTerm) ||
                                userItem.Priimek.toLowerCase().includes(searchTerm) ||
                                userItem.Email.toLowerCase().includes(searchTerm);
                var roleMatches = selectedRole === 'all' || userItem.Vloga.toLowerCase() === selectedRole;

                return nameMatches && roleMatches;
            });

            loadTable(filteredUsers); 
        });
    });

</script>





