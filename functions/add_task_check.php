<?php 
if ($_SESSION['user_vloga'] != 'Profesor' && $_SESSION['user_vloga'] != 'Administrator') {
    die("Unauthorized access!");
}

$classId = $_POST['classId']; 
$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM ucitelji_razredi WHERE Ucitelj_ID = $userId AND Razred_ID = $classId";
$result = $link->query($sql);
if ($result->num_rows == 0) {
    die("You do not have permission to upload material for this class.");
}
?>