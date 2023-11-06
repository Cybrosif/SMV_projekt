<?php
include '../session_start.php';
include '../../db.php';
include '../functions/check_if_admin.php';

function deleteFileFromServer($filePath) {
    $baseDir = '../uploads/'; 
    $fullPath = $baseDir . $filePath;

    if (file_exists($fullPath)) {
        if (!unlink($fullPath)) {
            error_log("Failed to delete file: " . $fullPath);
        }
    } else {
        error_log("File not found: " . $fullPath);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];

    $query = "SELECT Pot_Do_Datoteke FROM student_naloge WHERE Student_ID = ?";
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            deleteFileFromServer($row['Pot_Do_Datoteke']);
        }
        mysqli_stmt_close($stmt);
    }

    $sql = "DELETE FROM uporabniki WHERE ID = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        if (mysqli_stmt_execute($stmt)) {
            echo "User and associated files deleted successfully";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo 'Invalid request';
}
?>
