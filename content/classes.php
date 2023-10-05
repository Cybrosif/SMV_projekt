<?php
include '../session_start.php';
include '../../db.php';
$userId = $_SESSION['user_id']; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['razredi'])) {
        $razredi = $_POST['razredi'];
   
        foreach ($razredi as $razredId) {
            $query = "INSERT IGNORE INTO Uporabniki_Razredi (Uporabnik_ID, Razred_ID) VALUES ($userId, $razredId)";
            mysqli_query($link, $query);
        }
    } elseif (isset($_POST['remove'])) {
        $removeId = $_POST['remove'];

        
        $query = "DELETE FROM Uporabniki_Razredi WHERE Uporabnik_ID = $userId AND Razred_ID = $removeId";
        mysqli_query($link, $query);
    }
}

$query = "SELECT * FROM Razredi";
$result = mysqli_query($link, $query);

$selectedQuery = "SELECT Razredi.* FROM Razredi JOIN Uporabniki_Razredi ON Razredi.Razred_ID = Uporabniki_Razredi.Razred_ID WHERE Uporabniki_Razredi.Uporabnik_ID = $userId";
$selectedResult = mysqli_query($link, $selectedQuery);
?>

<div class="container mt-3">
    <button class="btn btn-primary" type="button" id="toggleButton">
        Vsi predmeti
    </button>

    <div class="class-selection" id="classSelection" style="display:none;">
        <form method="post" action="classes.php">
            <h2>Izberi Predmete</h2>
            <div class="row mb-3">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-4 mb-3'>";
                    echo "<div class='form-check'>";
                    echo "<input type='checkbox' class='form-check-input' name='razredi[]' value='{$row['Razred_ID']}' id='razred-{$row['Razred_ID']}'>";
                    echo "<label class='form-check-label' for='razred-{$row['Razred_ID']}'>{$row['Ime_razreda']}</label>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Shrani</button>
        </form>
    </div>

    <style>
        .compact-list-group .list-group-item {
            padding: 0.5rem 1.25rem;
            margin-bottom: 5px;
        }
        .compact-list-group .btn {
            margin: 0 0 0 10px;
        }
    </style>

    <h2 class="mt-5">Moji predmeti</h2>
    <ul class="list-group compact-list-group">
        <?php
        while ($row = mysqli_fetch_assoc($selectedResult)) {
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
            echo "{$row['Ime_razreda']}";
            echo "<form method='post' action='classes.php' class='ms-3'>";
            echo "<input type='hidden' name='remove' value='{$row['Razred_ID']}'>";
            echo "<button type='submit' class='btn btn-danger btn-sm'>Remove</button>";
            echo "</form>";
            echo "</li>";
        }
        ?>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#toggleButton').click(function() {
            $('#classSelection').toggle();
        });
    });

    $(document).on('submit', 'form', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "../controllers/content.php?page=classes",
                data: formData,
                success: function(data) {
                    $("#content").html(data);
                }
            });
        });
</script>
