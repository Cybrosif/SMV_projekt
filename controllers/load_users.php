<?php
include '../../db.php';
include '../functions/check_if_admin.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classes = array();

    $sql = "SELECT ID, Ime, Priimek, Email, Vloga FROM uporabniki WHERE Vloga !='Administrator' AND ID != {$_SESSION['user_id']}";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($users);
    } else {
        echo "0 results";
    }
}
mysqli_close($link);
?>