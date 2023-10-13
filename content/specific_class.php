<?php
include '../../db.php';

$classId = $_GET['Razred_ID'];

// Make sure to sanitize the input to prevent SQL injection
$classId = mysqli_real_escape_string($link, $classId);

$query = "SELECT Ime_razreda FROM razredi WHERE Razred_ID = $classId";
$classNameResult = mysqli_query($link, $query);
$classNameData = mysqli_fetch_assoc($classNameResult);
$className = $classNameData['Ime_razreda'];

// Query for Naloge of the specific class
$nalogeQuery = "SELECT Naslov, Opis, Rok FROM naloge WHERE Razred_ID = $classId";
$nalogeResult = mysqli_query($link, $nalogeQuery);
?>

    <style>

        body {
            background-color: #f5f5f5;
        }
    </style>

<div class="container mt-5">
    <h1 class="text-center mb-5"><?php echo $className; ?></h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Naloge:</h3>
        </div>
        <ul class="list-group list-group-flush">
        <?php
            while($nalogeData = mysqli_fetch_assoc($nalogeResult)) {
                echo '<li class="list-group-item">';
                echo "<strong>Naslov:</strong> " . $nalogeData['Naslov'] . "<br>";
                echo "<strong>Opis:</strong> " . $nalogeData['Opis'] . "<br>";
                echo "<strong>Rok:</strong> " . $nalogeData['Rok'];
                echo "</li>";
            }
        ?>
        </ul>
    </div>
</div>
