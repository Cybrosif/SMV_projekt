<?php 
    include '../session_start.php';
    include '../../db.php';
    include '../functions/check_if_admin.php';
?>


<div class="container">
    <h1 class='text-center primary-text text1'>Upravljanje razredov</h1>

    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <!-- Modal content goes here -->
                </div>
            </div>
        </div>
    <div class="mb-3">
            <button class="btn btn-primary create-class">Ustvari predmet</button>
        </div>
    <div class="mb-3">
            <label for="search">Išči:</label>
            <input type="text" class="form-control" id="search" placeholder="Vpišite pojem za iskanje...">
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="text2">#</th>
                <th scope="col" class="text2">Ime razreda</th>
                <th scope="col" class="text2">Ključ vpisa</th>
                <th scope="col" class="text2"></th>     
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function(){
        var classesArray;
        loadClasses();
        
        function loadClasses() {
            $.ajax({
                type: 'POST',
                url: '../controllers/load-classes.php', 
                success: function(response) {
                    classesArray = response;
                    //console.log(classesArray);
                    loadTable(classesArray);
                },
                error: function(error) {
                    console.error('Error loading classes:', error);
                }
            });
        };

        function loadTable(classesArray){

            var tbody = $('table tbody');
            tbody.empty();
            var i = 1;
            classesArray.forEach(function(classItem) {
                    var row = $('<tr>');
                    row.append($('<td class="text3">').text(i));
                    row.append($('<td class="text3">').text(classItem.Ime_Razreda));
                    row.append($('<td class="text3">').text(classItem.Kljuc_Vpisa));

                    var editButton = $('<button>').addClass('btn btn-primary edit-btn mx-2').attr('data-classid', classItem.Razred_ID).text('Uredi');
                    var deleteButton = $('<button>').addClass('btn btn-primary btn-danger delete-btn').attr('data-classid', classItem.Razred_ID).text('Izbriši');
                    row.append($('<td class="text3">').append(editButton).append(deleteButton));

                    tbody.append(row);
                    i++;
            });
        };

        $('#search').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();

            var filteredClasses = classesArray.filter(function(classItem) {
                return classItem.Ime_Razreda.toLowerCase().includes(searchTerm);
            });

            loadTable(filteredClasses);
        });

        $('.create-class').click(function() {
           $.ajax({
                type: 'POST',
                url: '../modal/create_class_modal.php', 
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    $('#editUserModal .modal-dialog').addClass('modal-xl'); 
                }
            });
        });

        $('table').on('click', '.delete-btn', function(){
            var classId = $(this).data('classid');     
            $.ajax({
                type: 'POST',
                url: '../modal/delete_class_modal.php', 
                data: { classId: classId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    $('#editUserModal .modal-dialog').removeClass('modal-xl');
                }
            });
        });

        $('table').on('click', '.edit-btn', function(){
            var classId = $(this).data('classid');     
            
            $.ajax({
                type: 'POST',
                url: '../modal/edit_class_modal.php', 
                data: { classId: classId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    $('#editUserModal .modal-dialog').addClass('modal-xl'); 
                }
            });
        });
    });
</script>

