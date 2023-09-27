<?php
include '../session_start.php';

try {
    include '../../db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password_confirm = filter_input(INPUT_POST, 'password-confirm', FILTER_SANITIZE_STRING);
        $user_id = $_SESSION['user_id'];

        if ($password !== $password_confirm) {
            echo "Error: Passwords do not match!";
            exit();
        }

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "UPDATE Uporabniki SET Ime = ?, Geslo = ? WHERE ID = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('ssi', $username, $password_hash, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            include '../logout.php'; // Assuming this file handles the session termination
            header('Location: ../views/login_page.php');
            include 'logout.php';
            exit();
        } else {
            echo "Error: Failed to update password!";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
