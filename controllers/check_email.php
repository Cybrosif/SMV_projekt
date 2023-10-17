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
        $response['status'] = 'exists';
        $response['message'] = 'Email is already in use.';
    } else {
        $response['status'] = 'not_exists';
        $response['message'] = 'Email is available.';
    }
    
    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>