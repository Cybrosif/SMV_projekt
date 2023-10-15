<?php
include '../session_start.php';
include '../../db.php';

$userId = $_SESSION['user_id']; 

function validateKljucVpisa($razredId, $providedKljuc, $link) {
    $query = "SELECT Kljuc_Vpisa FROM razredi WHERE Razred_ID = $razredId";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Kljuc_Vpisa'] == $providedKljuc) {
            return true;
        }
    }
    return false;
}
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['razred'])) {
        $razredId = $_POST['razred'];
        if (validateKljucVpisa($razredId, $_POST['kljuc_vpisa'], $link)) {
            $query = "INSERT IGNORE INTO uporabniki_razredi (Uporabnik_ID, Razred_ID) VALUES ($userId, $razredId)";
            mysqli_query($link, $query);
        } else {
            // Handle invalid "Kljuc_Vpisa" here, for instance:
            // echo "Invalid Kljuc_Vpisa provided!";
        }
    } elseif (isset($_POST['remove'])) {
        $removeId = $_POST['remove'];
        $query = "DELETE FROM uporabniki_razredi WHERE Uporabnik_ID = $userId AND Razred_ID = $removeId";
        mysqli_query($link, $query);
    }
}

$query = "SELECT * FROM razredi";
$result = mysqli_query($link, $query);

$selectedQuery = "SELECT razredi.* FROM razredi JOIN uporabniki_razredi ON razredi.Razred_ID = uporabniki_razredi.Razred_ID WHERE uporabniki_razredi.Uporabnik_ID = $userId";
$selectedResult = mysqli_query($link, $selectedQuery);

?>
