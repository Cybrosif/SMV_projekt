
<h1 class='text-center primary-text mb-5'>Razredi</h1>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

<?php
$user_id = $_SESSION['user_id'];
$sql = "
    SELECT Razredi.* 
    FROM Razredi JOIN uporabniki_razredi ON Razredi.Razred_ID = uporabniki_razredi.Razred_ID
    WHERE uporabniki_razredi.Uporabnik_ID = $user_id
";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container'>";
    echo "<div class='row'>";
    while($row = $result->fetch_assoc()) {
?>
    <div class='custom-col mb-3' style="min-width: 200px;">
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

<script>
        function fetchRazredDetails(razredId) {
            $.ajax({
                url: '../controllers/content.php',
                type: 'GET',
                data: { page: 'specific_class', razred_id: razredId },
                success: function(response) {
                    
                    $('#content').html(response);
                },
                error: function() {
                    alert('Failed to fetch razred details.');
                }
            });
        }
    </script>
