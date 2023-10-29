<?php
    include '../../db.php';
    include '../session_start.php';
    // PREVERJANJE CE JE DIJAK

    $sql = "SELECT * FROM razredi 
        WHERE Razred_ID NOT IN 
        (SELECT razred_id FROM uporabniki_razredi WHERE Uporabnik_ID = {$_SESSION['user_id']})";
    $result = mysqli_query($link, $sql);
?>
<style>
    .hover:hover {
        transform: scale(1.05);
        cursor: pointer;
    }

    .razred {
        height: 50px;
        border: 1px solid black;
    }
</style>
<div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <!-- Modal content goes here -->
        </div>
    </div>
</div>
<h1 class='text-center primary-text my-4'>Vpis v razred</h1>
<div class="container text-center">
    <div class="mb-3 search">
        <label for="search">Išči:</label>
        <input type="text" class="form-control" id="search" placeholder="Vpišite pojem za iskanje...">
    </div>
    <div id="razredi-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text2">#</th>
                    <th scope="col" class="text2">Ime razreda</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='razred-row hover' data-razredId=" . $row['Razred_ID'] . ">";
                            echo "<td>" . $i . "</td>";
                            echo "<td><a>" . $row['Ime_razreda'] . "</a></td>";
                            echo "</tr>";
                            $i++;
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#search").on("input", function() {
            var searchText = $(this).val().toLowerCase();
            $(".razred-row").each(function() {
                var razredText = $(this).text().toLowerCase();
                if (razredText.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $(".razred-row").on("click", function() {
            var razredId = $(this).data("razredid");

            // Make an AJAX request to fetch data for the selected Razred_ID
            $.ajax({
                type: "POST",
                url: "../modal/class-join.php", // Modify this URL to the server-side script that fetches data based on Razred_ID
                data: { razredId: razredId },
                success: function(response) {
                    // Populate the modal content with the fetched data
                    $("#editUserModal .modal-content").html(response);
                    $("#editUserModal").modal("show");
                }
            });
        });
    });
</script>
