<h1 class='text-center primary-text mb-5'>Razredi</h1>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

<?php
$sql = "SELECT * FROM Razredi";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container'>";
    echo "<div class='row'>";
    while($row = $result->fetch_assoc()) {
?>
    <div class='custom-col mb-3'>
        <a href='javascript:void(0);' onclick='fetchRazredDetails(<?php echo $row['Razred_ID']; ?>);' class='d-block p-3 text-center class-link modern-box custom-side-shadow' style='background-color: #3394e1; font-family: Poppins, sans-serif;'>
            <?php echo $row['Ime_razreda']; ?>
        </a>
    </div>
<?php
    }
    echo "</div>";
    echo "</div>";
} else {
    echo "<p class='text-center second-text'>No classes found!</p>";
}
?>
