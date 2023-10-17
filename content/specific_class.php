<?php
include '../../db.php';
include '../session_start.php';

$classId = $_GET['Razred_ID'];

$classId = mysqli_real_escape_string($link, $classId);

$query = "SELECT Ime_razreda FROM razredi WHERE Razred_ID = $classId";
$classNameResult = mysqli_query($link, $query);
$classNameData = mysqli_fetch_assoc($classNameResult);
$className = $classNameData['Ime_razreda'];

$nalogeQuery = "SELECT n.Naloga_ID, n.Naslov, n.Opis, n.Rok, s.Pot_Do_Datoteke AS stored_filename, s.Original_Filename AS original_filename FROM naloge n LEFT JOIN student_naloge s ON n.Naloga_ID = s.Naloga_ID AND s.Student_ID = '{$_SESSION['user_id']}' WHERE n.Razred_ID = $classId";
$nalogeResult = mysqli_query($link, $nalogeQuery);

?>

<head>
    <style>
        .assignment-card {
            transition: transform .2s;
        }

        .assignment-card:hover {
            transform: scale(1.02);
        }

        .assignment-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .assignment-body {
            padding: 20px;
        }

        /* Scrollable container styles */
        .scrollable-container {
            max-height: 500px;  /* Adjust this height as per your design requirements */
            overflow-y: auto;
            padding: 1rem;  /* Optional, to give some space */
        }
    </style>
</head>


    <div class="container mt-5">
        <h1 class="text-center mb-5"><?php echo $className; ?></h1>

        <div class="scrollable-container">
            <div class="row">
                <?php
                /*if (!$nalogeResult) {
                    die('Error in SQL query: ' . mysqli_error($link));
                }*/
                if (mysqli_num_rows($nalogeResult) > 0)
                {
                    while ($nalogeData = mysqli_fetch_assoc($nalogeResult)) {
                        echo '<div class="col-md-6 col-lg-4 mb-4" data-naloga-id="' . $nalogeData['Naloga_ID'] . '">';
                        echo '<div class="card assignment-card">';
                        echo '<div class="assignment-header">' . $nalogeData['Naslov'] . '</div>';
                        echo '<div class="assignment-body">';
                        echo '<p>' . $nalogeData['Opis'] . '</p>';
                        echo '<p><small class="text-muted">Rok: ' . $nalogeData['Rok'] . '</small></p>';
                        
                        echo '<form id="uploadForm" action="../controllers/upload_naloga.php" method="post" enctype="multipart/form-data">';
                        echo '<input type="hidden" name="Naloga_ID" value="' . $nalogeData['Naloga_ID'] . '">';
                        echo '<div class="mb-3">';
                        echo '<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">';
                        echo '</div>';
                        echo '<input class="btn btn-primary mb-2" type="submit" value="Naloži nalogo" name="submit">';
        
                        if (isset($nalogeData['stored_filename']) && isset($nalogeData['original_filename'])) {
                            echo '<a class="btn btn-secondary mt-2 d-block" href="../uploads/' . $nalogeData['stored_filename'] . '" download="' . $nalogeData['original_filename'] . '">Download: ' . $nalogeData['original_filename'] . '</a>';
                        }
        
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                else {
                    echo '<div class="col-12 text-center">';
                    echo '<p>No results found.</p>';
                    echo '</div>';
                }
                
                ?>
            </div>
        </div>
    </div>




<script>
   $(document).ready(function() {
    // Initially, disable all submit buttons
    $('input[type="submit"]').prop('disabled', true);

    // Add event listener for file input change
    $('input[type="file"]').on('change', function() {
        // Get the container div for the current file input
        var container = $(this).closest('div[data-naloga-id]');
        var submitButton = container.find('input[type="submit"]');

        if ($(this).val()) {
            submitButton.prop('disabled', false);
        } else {
            submitButton.prop('disabled', true);
        }
    });

    // Add event listener for form submission using AJAX
    $('#uploadForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        var formData = new FormData($(this)[0]); // Get form data
        $.ajax({
            url: $(this).attr('action'), // Form action URL
            type: 'POST', // Form submission method
            data: formData, // Form data
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success response here, if needed
                location.reload();
                console.log(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error here, if needed
                console.error('AJAX error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
});


</script>

