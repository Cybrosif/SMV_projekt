<?php
include '../controllers/classes_add.php';
?>

<div class="container mt-3">
    <button class="btn btn-primary mb-3" type="button" id="toggleButton">Vsi predmeti</button>

    <div class="class-selection box-background shadow" id="classSelection" style="display:none;">
        <h3 class="mb-3">Izberite Predmet</h3>
        <form method="post">
            <div class="row mb-3">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col-md-4 mb-3'>";
                    echo "<div class='form-check'>";
                    echo "<input type='radio' class='form-check-input' name='razred' value='{$row['Razred_ID']}' id='razred-{$row['Razred_ID']}'>";
                    echo "<label class='form-check-label' for='razred-{$row['Razred_ID']}'>{$row['Ime_razreda']}</label>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
                <div class="col-md-12 mb-3">
                    <label for="kljuc_vpisa">Vnesite ključ vpisa:</label>
                    <input type="text" name="kljuc_vpisa" id="kljuc_vpisa" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Shrani</button>
        </form>
    </div>

    <style>
        .box-background {
            background-color: #f7f8fa;
            padding: 30px;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .compact-list-group .list-group-item {
            padding: 0.5rem 1.25rem;
            margin-bottom: 5px;
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
                echo "<ul class='list-group compact-list-group col-md-4'>";
                $start = $col * $itemsPerColumn;
                $end = min($start + $itemsPerColumn, count($classes));
                for ($i = $start; $i < $end; $i++) {
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "{$classes[$i]['Ime_razreda']}";
                    
                    // Place the two buttons in a div for better control
                    echo "<div class='action-buttons'>";

                    // "Naloge" button
                    echo "<a href='../views/home.php?page=specific_class&Razred_ID={$classes[$i]['Razred_ID']}' class='btn btn-info btn-sm mr-2'>Naloge</a>";

                    // "Odstrani" button
                    echo "<form method='post' class='d-inline-block'>";
                    echo "<input type='hidden' name='remove' value='{$classes[$i]['Razred_ID']}'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Odstrani</button>";
                    echo "</form>";

                    echo "</div>"; // Close action-buttons div

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
    $(document).on('submit', 'form', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        console.log("test");
        $.ajax({
            type: "POST",
            url: "../controllers/classes_add.php",
            data: formData,
            success: function(data) {
                location.reload();
            }
        });
    });
</script>
