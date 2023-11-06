<?php
include '../../db.php';
include '../session_start.php';
include '../functions/check_if_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classId = $_POST['classId'];
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $key = mysqli_real_escape_string($link, $_POST['key']);
    $teachers = isset($_POST['teachers']) ? $_POST['teachers'] : array();

    $updateClassSql = "UPDATE razredi SET Ime_razreda = '$name', Kljuc_Vpisa = '$key' WHERE Razred_ID = $classId";
    if ($link->query($updateClassSql) === TRUE) {
        $deleteTeachersSql = "DELETE FROM ucitelji_razredi WHERE Razred_ID = $classId";
        $link->query($deleteTeachersSql);
        
        foreach ($teachers as $teacherId) {
            $insertTeacherSql = "INSERT INTO ucitelji_razredi (Razred_ID, Ucitelj_ID) VALUES ($classId, $teacherId)";
            $link->query($insertTeacherSql);
        }

        echo 'Class information updated successfully!';
    } else {
        echo 'Error updating class information: ' . $link->error;
    }
} else {
    echo 'Invalid request';
}

?>
