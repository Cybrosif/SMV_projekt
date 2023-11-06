<?php
include '../session_start.php';

include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password_confirm = filter_input(INPUT_POST, 'password-confirm', FILTER_SANITIZE_STRING);

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Proceed only if the passwords match
        if ($password !== $password_confirm) {
            echo "Error: Passwords do not match!";
            exit();
        }

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL statement to update user
        if ($_SESSION['user_role'] !== 'Profesor') {
            $sql = "UPDATE uporabniki SET Ime = ?, Priimek = ?, Geslo = ? WHERE ID = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param('sssi', $username, $surname, $password_hash, $user_id);
        } else {
            $sql = "UPDATE uporabniki SET Geslo = ? WHERE ID = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param('si', $password_hash, $user_id);
        }
        
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Password updated, now log the user out and redirect to login page
            include '../functions/logout.php';
            header('Location: ../views/login_page.php');
            exit();
        } else {
            echo "Error: Failed to update user information!";
        }
    } else {
        echo "Error: No user is logged in.";
    }
} else {
    echo "Error: Invalid request method.";
}
?>
