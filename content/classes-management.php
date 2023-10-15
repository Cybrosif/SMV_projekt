<?php 
    include '../session_start.php';
    include '../../db.php';
    include '../functions/check_if_admin.php';
?>


<div class="container">
    <h1 class='text-center primary-text'>Upravljanje razredov</h1>

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
                <th scope="col">#</th>
                <th scope="col">Ime razreda</th>
                <th scope="col">Ključ vpisa</th>
                <th scope="col"></th>     
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
                url: '../controllers/load-classes.php', // Replace this with the actual URL to your server endpoint
                success: function(response) {
                    //var classesArray = JSON.parse(response);
                    classesArray = response;
                    // Do something with the classesArray
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
                    // Assuming classItem has properties like 'className', 'classDescription', etc.
                    // Create a table row and append it to the table body
                    var row = $('<tr>');
                    row.append($('<td>').text(i));
                    row.append($('<td>').text(classItem.Ime_Razreda));
                    row.append($('<td>').text(classItem.Kljuc_Vpisa));

                    var editButton = $('<button>').addClass('btn btn-primary edit-btn').attr('data-classid', classItem.Razred_ID).text('Uredi');
                    var deleteButton = $('<button>').addClass('btn btn-primary btn-danger delete-btn').attr('data-classid', classItem.Razred_ID).text('Izbriši');
                    // Append buttons to the row
                    row.append($('<td>').append(editButton).append(deleteButton));

                    tbody.append(row); // Append the row to the table body
                    i++;
            });
        };

        $('#search').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            //console.log(searchTerm);
            // Filter classesArray based on the search term
            var filteredClasses = classesArray.filter(function(classItem) {
                return classItem.Ime_Razreda.toLowerCase().includes(searchTerm);
            });

            // Update the table with filtered results
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

