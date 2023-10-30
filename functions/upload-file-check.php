<?php
$taskId = $_POST['nalogaId'];

if ($_SESSION['user_vloga'] != 'Dijak') {
    die("Unauthorized access!");
}

if (isset($_POST['nalogaId'])) {
    $sql = "SELECT Razred_ID FROM naloge WHERE Naloga_ID = $taskId";
    $result = $link->query($sql);

    if ($result === false) {
        die("Error in SQL query: " . $link->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $classId = $row['Razred_ID'];

        $userId = $_SESSION['user_id'];

        $sql = "SELECT * FROM uporabniki_razredi WHERE Uporabnik_ID = $userId AND Razred_ID = $classId";
        $result = $link->query($sql);

        if ($result === false) {
            die("Error in SQL query: " . $link->error);
        }

        if ($result->num_rows == 0) {
            die("You are not part of the class associated with this task.");
        }
    } else {
        die("Task with ID $taskId not found.");
    }
} else {
    die("Task ID is missing in the request.");
}
?>
