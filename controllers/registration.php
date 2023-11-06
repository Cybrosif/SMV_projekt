<?php
    include '../../db.php';
    include '../session_start.php';

    if (isset($_POST['registration'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
    }
    else{
        header("Location: ../index.php");

    }
    $stmt = $link->prepare("SELECT * FROM uporabniki WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); 
    if ($stmt->num_rows > 0) {
        header('Location: ../index.php');
        exit();
    }  
    $stmt->fetch();


    if  ($password == null || $confirmPassword == null || $email== null || $surname == null) 
    {
        header('Location: ../index.php');
        exit();
    } 
    else if ($password != $confirmPassword)
    {
        header('Location: ../index.php');
        exit();
    }
    else {
        $hash = password_hash($password, PASSWORD_BCRYPT);


        $stmt = $link->prepare("INSERT INTO uporabniki (Ime, Priimek, Email, Geslo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $surname, $email, $hash);
        $stmt->execute();


        $stmt = $link->prepare("SELECT id, ime, priimek, geslo, vloga  FROM uporabniki WHERE Email = ?");
        $stmt->bind_param("s", $email,);
        $stmt->execute();
        $stmt->bind_result($id, $ime, $priimek, $geslo, $vloga);
        $stmt->fetch();
        $stmt->close();

        $_SESSION['prijavljen'] = true;
        $_SESSION['user_id'] = $id;
        $_SESSION['user_ime'] = $ime;
        $_SESSION['user_priimek'] = $priimek;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_vloga'] = $vloga;

        header("Location: ../views/home.php?page=dashboard");
        exit();

    }
    exit();
?>