<?php
include '../../db.php';
include '../session_start.php';
include '../functions/check_if_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classId = $_POST['classId'];
    $name = $_POST['name'];
    $key = $_POST['key'];

    // Perform necessary validation on $name and $key if needed

    // Update the class information in the database
    $sql = "UPDATE razredi SET Ime_razreda = '$name', Kljuc_Vpisa = '$key' WHERE Razred_ID = $classId";

    if ($link->query($sql) === TRUE) {
        echo 'Class information updated successfully!';
    } else {
        echo 'Error updating class information: ' . $link->error;
    }
} else {
    echo 'Invalid request';
}
?>





