<?php
include '../../db.php';

if(!isset($_SESSION)) {
    session_start();
}

$classId = $_GET['Razred_ID'];

$classId = mysqli_real_escape_string($link, $classId);

$query = "SELECT Ime_razreda FROM razredi WHERE Razred_ID = $classId";
$classNameResult = mysqli_query($link, $query);
$classNameData = mysqli_fetch_assoc($classNameResult);
$className = $classNameData['Ime_razreda'];

$nalogeQuery = "SELECT n.Naloga_ID, n.Naslov, n.Opis, n.Rok, s.Pot_Do_Datoteke AS stored_filename, s.Original_Filename AS original_filename FROM naloge n LEFT JOIN Student_Naloge s ON n.Naloga_ID = s.Naloga_ID AND s.Student_ID = '{$_SESSION['user_id']}' WHERE n.Razred_ID = $classId";
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
    </style>
</head>

<body>


    <div class="container mt-5">
        <h1 class="text-center mb-5"><?php echo $className; ?></h1>

        <div class="row">
            <?php
            while ($nalogeData = mysqli_fetch_assoc($nalogeResult)) {
                echo '<div class="col-md-6 col-lg-4 mb-4">';
                echo '<div class="card assignment-card">';
                echo '<div class="assignment-header">' . $nalogeData['Naslov'] . '</div>';
                echo '<div class="assignment-body">';
                echo '<p>' . $nalogeData['Opis'] . '</p>';
                echo '<p><small class="text-muted">Rok: ' . $nalogeData['Rok'] . '</small></p>';
                
                echo '<form action="../controllers/upload_naloga.php" method="post" enctype="multipart/form-data">';
                echo '<input type="hidden" name="Naloga_ID" value="' . $nalogeData['Naloga_ID'] . '">';
                echo '<div class="mb-3">';
                echo '<input class="form-control" type="file" name="fileToUpload" id="fileToUpload">';
                echo '</div>';
                echo '<input class="btn btn-primary mb-2" type="submit" value="Naloži nalogo" name="submit">';

                if (isset($nalogeData['stored_filename']) && isset($nalogeData['original_filename'])) {
                    echo '<a class="btn btn-secondary mt-2" href="../uploads/' . $nalogeData['stored_filename'] . '" download="' . $nalogeData['original_filename'] . '">Download: ' . $nalogeData['original_filename'] . '</a>';
                }

                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
