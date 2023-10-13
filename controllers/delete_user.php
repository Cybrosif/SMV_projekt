<?php
include '../session_start.php';
include '../../db.php';
include '../functions/check_if_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    // Perform deletion operation in the database (Example query, update with your query)
    $sql = "DELETE FROM uporabniki WHERE ID = $userId";

    if ($link->query($sql) === true) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
} else {
    echo 'Invalid request';
}
?>
