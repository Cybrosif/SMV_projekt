<?php
    include '../controllers/classes_add.php'
?>

<div class="container mt-3">
    <button class="btn btn-primary mb-3" type="button" id="toggleButton">Vsi predmeti</button>

    <div class="class-selection box-background shadow" id="classSelection" style="display:none;">
        <h3 class="mb-3">Izberite Predmet</h3>
        <form method="post" action="../controllers/classes_add.php">
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
        .box-background {
            background-color: #f7f8fa;
            padding: 30px; /* Increased padding */
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow effect */
        }
        .compact-list-group .list-group-item {
            padding: 0.5rem 1.25rem;
            margin-bottom: 5px;
        }

        .odstrani-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>

    <div class="box-background shadow">
        <h3 class="mb-4">Moji predmeti</h3>
        <div class="row">
            <?php
            $classes = [];
            while ($row = mysqli_fetch_assoc($selectedResult)) {
                $classes[] = $row;
            }

            $itemsPerColumn = ceil(count($classes) / 3);

            for ($col = 0; $col < 3; $col++) {
                echo "<ul class='list-group compact-list-group col-md-4'>"; // Change from col-md-6 to col-md-4 for 3 columns
                $start = $col * $itemsPerColumn;
                $end = min($start + $itemsPerColumn, count($classes));
                for ($i = $start; $i < $end; $i++) {
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "{$classes[$i]['Ime_razreda']}";
                    echo "<form method='post' action='classes.php' class='odstrani-btn'>";
                    echo "<input type='hidden' name='remove' value='{$classes[$i]['Razred_ID']}'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Odstsrani</button>";
                    echo "</form>";
                    echo "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#toggleButton').click(function() {
            $('#classSelection').toggle();
        });
    });
</script>
