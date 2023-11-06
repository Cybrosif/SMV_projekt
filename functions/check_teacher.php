<?php
$ime_razreda = null;
$userRole = $_SESSION['user_vloga'];
$userId = $_SESSION['user_id'];
$razredID = $_GET['razredID'];

$belongsRazred = false;
if ($userId && $razredID) {
    $sql = "SELECT 1 FROM ucitelji_razredi WHERE Ucitelj_ID = $userId AND Razred_ID = $razredID LIMIT 1";

    $result = mysqli_query($link, $sql);

    // Check for errors
    if (!$result) {
        die("Query failed: " . mysqli_error($link));
    }

    if (mysqli_num_rows($result) > 0) {
        $belongsRazred = true;
    }

    // Free the result
    mysqli_free_result($result);
}


if($userRole === "Administrator" || $userRole === "administrator"){

}
elseif ($belongsRazred == false) {
    echo '<script type="text/javascript">window.location.href = "home.php?page=classes";</script>';
    exit;
}

?>