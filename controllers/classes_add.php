<?php
include '../session_start.php';
include '../../db.php';

$userId = $_SESSION['user_id']; 

function validateKljucVpisa($razredId, $providedKljuc, $link) {
    $query = "SELECT Kljuc_Vpisa FROM Razredi WHERE Razred_ID = $razredId";
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
            $query = "INSERT IGNORE INTO Uporabniki_Razredi (Uporabnik_ID, Razred_ID) VALUES ($userId, $razredId)";
            mysqli_query($link, $query);
        } else {
            // Handle invalid "Kljuc_Vpisa" here, for instance:
            // echo "Invalid Kljuc_Vpisa provided!";
        }
    } elseif (isset($_POST['remove'])) {
        $removeId = $_POST['remove'];
        $query = "DELETE FROM Uporabniki_Razredi WHERE Uporabnik_ID = $userId AND Razred_ID = $removeId";
        mysqli_query($link, $query);
    }
}

$query = "SELECT * FROM Razredi";
$result = mysqli_query($link, $query);

$selectedQuery = "SELECT Razredi.* FROM Razredi JOIN Uporabniki_Razredi ON Razredi.Razred_ID = Uporabniki_Razredi.Razred_ID WHERE Uporabniki_Razredi.Uporabnik_ID = $userId";
$selectedResult = mysqli_query($link, $selectedQuery);


?>
