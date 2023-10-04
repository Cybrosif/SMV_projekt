<?php
include '../../db.php';

// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fetch all available Razredi from the database
$query = "SELECT * FROM Razredi";
$result = mysqli_query($link, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($link));
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedRazredi'])) {
    $selectedRazredi = $_POST['selectedRazredi'];

    // Clear previous selections for the user
    $deleteQuery = "DELETE FROM Uporabniki_Razredi WHERE Uporabnik_ID = ?";
    $stmt = mysqli_prepare($link, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);

    // Store new selections for the user
    $insertQuery = "INSERT INTO Uporabniki_Razredi (Uporabnik_ID, Razred_ID) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $insertQuery);
    foreach ($selectedRazredi as $razredID) {
        mysqli_stmt_bind_param($stmt, "ii", $_SESSION['user_id'], $razredID);
        mysqli_stmt_execute($stmt);
    }
}

// Fetch the Razredi that the user has selected
$userRazrediQuery = "SELECT r.* FROM Razredi r JOIN Uporabniki_Razredi ur ON r.Razred_ID = ur.Razred_ID WHERE ur.Uporabnik_ID = ?";
$stmt = mysqli_prepare($link, $userRazrediQuery);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$userRazrediResult = mysqli_stmt_get_result($stmt);
?>
<<<<<<< Updated upstream
=======

<!-- Display the form to select Razredi -->
<form method="post">
    <h3>Select Razredi:</h3>
    <?php 
    $selectedRazrediIds = array_column(mysqli_fetch_all($userRazrediResult, MYSQLI_ASSOC), 'Razred_ID');
    while ($row = mysqli_fetch_assoc($result)): ?>
        <input type="checkbox" name="selectedRazredi[]" value="<?php echo $row['Razred_ID']; ?>"
            <?php if (in_array($row['Razred_ID'], $selectedRazrediIds)) echo 'checked'; ?>>
        <?php echo $row['Ime_razreda']; ?><br>
    <?php endwhile; ?>
    <input type="submit" value="Dodaj">
</form>

<!-- Display the selected Razredi for the user -->
<h3>Your Selected Razredi:</h3>
<ul>
    <?php foreach ($selectedRazrediIds as $selectedRazredId): ?>
        <li><?php echo $selectedRazredId; ?></li>
    <?php endforeach; ?>
</ul>
>>>>>>> Stashed changes
