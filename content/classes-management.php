<?php
    include '../functions/check_if_admin.php';
    include '../session_start.php';
    include '../../db.php';
?>


<div class="container">
    <h1 class='text-center primary-text'>Upravljanje razredov</h1>

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
        loadClasses();
        var classesArray;
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
                    // Add more columns as needed

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
    });
</script>

