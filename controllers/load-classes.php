<?php
include '../../db.php';
include '../functions/check_if_admin.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classes = array();

    $sql = "SELECT Kljuc_Vpisa, Ime_Razreda FROM razredi";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        // Send the users data as a JSON response
        header('Content-Type: application/json');
        echo json_encode($users);
    } else {
        // No users found
        echo "0 results";
    }
}
mysqli_close($link);
?>
