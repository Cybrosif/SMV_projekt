<?php

if ($_SESSION['user_vloga'] != 'Dijak') {
    die("Unauthorized access!");
}

$classId = $_POST['razredId'];
$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM uporabniki_razredi WHERE Uporabnik_ID = $userId AND Razred_ID = $classId";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    die("You are already enrolled in this class.");
}

?>