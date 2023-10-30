<?php
if ($_SESSION['user_vloga'] != 'Profesor') {
    die("Unauthorized access!");
}

// If user is a professor, check if they are associated with the class
if ($_SESSION['user_vloga'] == 'Profesor') {
    $classId = $_POST['razredId'];
    $sql = "SELECT * FROM ucitelji_razredi WHERE Ucitelj_ID = $_SESSION['user_id'] AND Razred_ID = $classId";
    $result = $link->query($sql);
    if ($result->num_rows == 0) {
        die("You do not have permission to delete this class.");
    }
}

?>