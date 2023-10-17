<?php
include '../../db.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $link->prepare("SELECT * FROM uporabniki WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "exists";
    } else {
        echo "not_exists";
    }
    $stmt->close();
}
