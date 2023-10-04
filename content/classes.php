<?php
    include '../controllers/classes_add.php'
?>

<div class="container mt-3">
    <button class="btn btn-primary" type="button" id="toggleButton">
        Vsi predmeti
    </button>

    <div class="class-selection" id="classSelection" style="display:none;">
        <form method="post" action="../controllers/classes_add.php">
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
            echo "<button type='submit' class='btn btn-danger btn-sm'>Odstsrani</button>";
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
</script>
