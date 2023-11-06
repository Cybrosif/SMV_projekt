<?php
include '../../db.php';
include '../session_start.php';

$classId = mysqli_real_escape_string($link, $_POST['classId']);

$userId = $_SESSION['user_id'];

$checkSql = "SELECT * FROM uporabniki_razredi WHERE uporabnik_id = '$userId' AND razred_id = '$classId'";
$checkResult = mysqli_query($link, $checkSql);

if (mysqli_num_rows($checkResult) > 0) {
    $deleteSql = "DELETE FROM uporabniki_razredi WHERE uporabnik_id = '$userId' AND razred_id = '$classId'";
    if (mysqli_query($link, $deleteSql)) {
        echo "success";
    } else {
        echo "error_with_delete";
    }
} else {
    echo "not_member";
}
?>
