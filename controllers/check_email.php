<?php
include '../../db.php';

$response = array('status' => 'error', 'message' => 'Invalid request');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $link->prepare("SELECT * FROM uporabniki WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response = 'exists';
    } else {
        $response = 'not_exists';
    }
    
    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>