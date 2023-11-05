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

    $userId = $_POST['userId'];
    $ime = $_POST["name"];
    $priimek = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    if(isset($_POST["subjects"]))
        $selectedSubjects = $_POST["subjects"];

    if($password == "")
        {
            $sql = "UPDATE uporabniki SET Ime='$ime', Priimek='$priimek', Email='$email' WHERE ID = $userId AND Vloga != 'Administrator'";
        }
    else
        {
            $sql = "UPDATE uporabniki SET Ime='$ime', Priimek='$priimek', Email='$email', Geslo='$hash' WHERE ID = $userId AND Vloga != 'Administrator'";
        }
    
    if ($link->query($sql) === true) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }

    $deleteQuery = "DELETE FROM uporabniki_razredi WHERE Uporabnik_ID = $userId";
    $link->query($deleteQuery);
    if(isset($selectedSubjects))
    {
        foreach ($selectedSubjects as $subjectId) {
            $insertQuery = "INSERT INTO uporabniki_razredi (Uporabnik_ID, Razred_ID) VALUES ($userId, $subjectId)";
            $link->query($insertQuery);
        }
    }
    $link->close();
}
?>
