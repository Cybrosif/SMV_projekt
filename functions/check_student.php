<?php
$ime_razreda = null;
$userRole = $_SESSION['user_vloga'];
$userId = $_SESSION['user_id'];
$razredID = $_GET['razredID'];

$belongsRazred = false;
if ($userId && $razredID) {
    // Construct the query
    $sql = "SELECT 1 FROM uporabniki_razredi WHERE Uporabnik_ID = $userId AND Razred_ID = $razredID LIMIT 1";

    // Execute the query
    $result = mysqli_query($link, $sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }

    // If there's at least one row in the result, set belongsRazred to true
    if (mysqli_num_rows($result) > 0) {
        $belongsRazred = true;
    }

    // Free the result
    mysqli_free_result($result);
}

// If the user is not a student or does not belong to the class, redirect them.
if($userRole === "Administrator" || $userRole === "administrator"){

}
elseif ($belongsRazred == false) {
    echo '<script type="text/javascript">window.location.href = "home.php?page=classes";</script>';
    exit;
}

?>