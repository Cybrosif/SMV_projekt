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
    $key = $_POST["key"];

    if (empty($ime) || empty($key) ) {
        echo "Bo treba use spounat";
        exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO razredi (Ime_razreda, Kljuc_Vpisa) VALUES ('$ime', '$key')";

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
