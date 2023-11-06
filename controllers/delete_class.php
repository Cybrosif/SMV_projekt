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
    $classId = $_POST['classId'];

    mysqli_begin_transaction($link);

    try {
        $gradivaSql = "SELECT Pot_Do_Datoteke FROM gradiva WHERE Razred_ID = ?";
        if ($gradivaStmt = mysqli_prepare($link, $gradivaSql)) {
            mysqli_stmt_bind_param($gradivaStmt, "i", $classId);
            mysqli_stmt_execute($gradivaStmt);
            $gradivaResult = mysqli_stmt_get_result($gradivaStmt);

            while ($row = mysqli_fetch_assoc($gradivaResult)) {
                deleteFileFromServer($row['Pot_Do_Datoteke']);
            }
            mysqli_stmt_close($gradivaStmt);
        }

        $studentNalogeSql = "SELECT sn.Pot_Do_Datoteke FROM student_naloge sn INNER JOIN naloge n ON sn.Naloga_ID = n.Naloga_ID WHERE n.Razred_ID = ?";
        if ($studentNalogeStmt = mysqli_prepare($link, $studentNalogeSql)) {
            mysqli_stmt_bind_param($studentNalogeStmt, "i", $classId);
            mysqli_stmt_execute($studentNalogeStmt);
            $studentNalogeResult = mysqli_stmt_get_result($studentNalogeStmt);

            while ($row = mysqli_fetch_assoc($studentNalogeResult)) {
                deleteFileFromServer($row['Pot_Do_Datoteke']);
            }
            mysqli_stmt_close($studentNalogeStmt);
        }

        $deleteMaterialsSql = "DELETE FROM gradiva WHERE Razred_ID = ?";
        if ($deleteMaterialsStmt = mysqli_prepare($link, $deleteMaterialsSql)) {
            mysqli_stmt_bind_param($deleteMaterialsStmt, "i", $classId);
            mysqli_stmt_execute($deleteMaterialsStmt);
            mysqli_stmt_close($deleteMaterialsStmt);
        }

        $deleteAssignmentsSql = "DELETE FROM naloge WHERE Razred_ID = ?";
        if ($deleteAssignmentsStmt = mysqli_prepare($link, $deleteAssignmentsSql)) {
            mysqli_stmt_bind_param($deleteAssignmentsStmt, "i", $classId);
            mysqli_stmt_execute($deleteAssignmentsStmt);
            mysqli_stmt_close($deleteAssignmentsStmt);
        }

        $deleteClassSql = "DELETE FROM razredi WHERE Razred_ID = ?";
        if ($deleteClassStmt = mysqli_prepare($link, $deleteClassSql)) {
            mysqli_stmt_bind_param($deleteClassStmt, "i", $classId);
            mysqli_stmt_execute($deleteClassStmt);
            mysqli_stmt_close($deleteClassStmt);
        }

        mysqli_commit($link);
        echo 'Class, related materials, assignments, student submissions, and files deleted successfully!';
    } catch (Exception $e) {
        mysqli_rollback($link);
        error_log("Error: " . $e->getMessage());
        echo 'Error deleting class and related data: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request';
}
?>