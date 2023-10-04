<?php
include '../session_start.php';
include '../../db.php';

$userId = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['razredi'])) {
        $razredi = $_POST['razredi'];
   
        foreach ($razredi as $razredId) {
            $query = "INSERT IGNORE INTO Uporabniki_Razredi (Uporabnik_ID, Razred_ID) VALUES ($userId, $razredId)";
            mysqli_query($link, $query);
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