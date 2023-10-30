<?php
    if ($_SESSION['user_vloga'] != 'Dijak') {
        die("Unauthorized access!");
    }

    $taskId = $_POST['taskId'];
    $sql = "SELECT Razred_ID FROM naloge WHERE Naloga_ID = $taskId";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    $classId = $row['class_id'];

    $sql = "SELECT * FROM uporabniki_razredi WHERE Uporabnik_ID = $_SESSION['user_id'] AND Razred_ID = $classId";
    $result = $link->query($sql);
    if ($result->num_rows == 0) {
        die("You are not part of the class associated with this task.");
    }

?>