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
            header('Location: ../home.php?page=settings&error=password_mismatch');
            exit();
        }

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "UPDATE Uporabniki SET Ime = :username, Geslo = :password_hash WHERE ID = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['user_ime'] = $username;
            header('Location: ../home.php?page=settings&success=password_updated');
        } else {
            header('Location: ../home.php?page=settings&error=update_failed');
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
