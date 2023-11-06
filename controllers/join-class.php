<?php
include '../../db.php';
include '../session_start.php';

$enteredKey = mysqli_real_escape_string($link, $_POST['enteredKey']);
$classId = mysqli_real_escape_string($link, $_POST['classId']);

$sql = "SELECT Kljuc_Vpisa FROM razredi WHERE Razred_ID = '$classId'";
$result = mysqli_query($link, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $classKey = $row['Kljuc_Vpisa'];

    
    if ($enteredKey === $classKey) {
        $userId = $_SESSION['user_id'];
        $insertSql = "INSERT INTO uporabniki_razredi (uporabnik_id, razred_id) VALUES ('$userId', '$classId')";
        if (mysqli_query($link, $insertSql)) {
            echo "success";
        } else {
            echo "Error with insert";
        }
    } else {
        
        echo "error";
    }
} else {

    echo "error";
}

?>
