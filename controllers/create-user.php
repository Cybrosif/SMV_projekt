<?php
include '../session_start.php';
include '../../db.php';
include '../functions/check_if_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_SESSION['user_vloga'] != 'Administrator' && $_SESSION['user_vloga'] != 'administrator')
    {
        header('Location: ../views/home.php?page=dashboard');
        exit();
    }
    $ime = $_POST["name"];
    $priimek = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $vloga = $_POST["vloga"];

    if (empty($ime) || empty($priimek) || empty($email) || empty($password) || empty($confirmPassword) || empty($vloga)) {
        echo "Bo treba use spounat";
        exit();
    }
    if ($password != $confirmPassword)
    {
        echo 'Passwords do not match';
        exit();
    }
    if ($vloga != 'Profesor' && $vloga != 'Dijak')
    {
        echo 'Nebo šlo :(';
        exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO uporabniki (Ime, Priimek, Email, Geslo, Vloga) VALUES ('$ime', '$priimek', '$email', '$hashedPassword', '$vloga')";

    if (mysqli_query($link, $query)) {
        echo "User created successfully";
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    mysqli_close($connection);
} else {
    echo "Invalid request";
}
?>
