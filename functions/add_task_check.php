<?php 
if ($_SESSION['user_vloga'] != 'Profesor' && $_SESSION['user_vloga'] != 'Admin') {
    die("Unauthorized access!");
}

$classId = $_POST['classId']; 
$sql = "SELECT * FROM ucitelji_razredi WHERE Ucitelj_ID = {$_SESSION['user_id']} AND Razred_ID = $classId";
$result = $link->query($sql);
if ($result->num_rows == 0) {
    die("You do not have permission to upload material for this class.");
}
?>