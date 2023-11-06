<?php
include '../session_start.php';
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['taskId'])) {
        $taskId = mysqli_real_escape_string($link, $_POST['taskId']);

        mysqli_begin_transaction($link);

        try {
            $studentFilesStmt = mysqli_prepare($link, "SELECT Pot_Do_Datoteke FROM student_naloge WHERE Naloga_ID = ?");
            mysqli_stmt_bind_param($studentFilesStmt, 'i', $taskId);
            mysqli_stmt_execute($studentFilesStmt);
            $studentFilesResult = mysqli_stmt_get_result($studentFilesStmt);

            while ($studentFile = mysqli_fetch_assoc($studentFilesResult)) {
                $studentFilePath = "../uploads/" . $studentFile['Pot_Do_Datoteke'];
                if (file_exists($studentFilePath)) {
                    unlink($studentFilePath);
                }
            }

            $deleteStudentFilesStmt = mysqli_prepare($link, "DELETE FROM student_naloge WHERE Naloga_ID = ?");
            mysqli_stmt_bind_param($deleteStudentFilesStmt, 'i', $taskId);
            mysqli_stmt_execute($deleteStudentFilesStmt);

            $teacherFilesStmt = mysqli_prepare($link, "SELECT Pot_Do_Datoteke FROM gradiva WHERE Gradivo_ID IN (SELECT Gradiva_ID FROM naloge WHERE Naloga_ID = ?)");
            mysqli_stmt_bind_param($teacherFilesStmt, 'i', $taskId);
            mysqli_stmt_execute($teacherFilesStmt);
            $teacherFilesResult = mysqli_stmt_get_result($teacherFilesStmt);

            while ($teacherFile = mysqli_fetch_assoc($teacherFilesResult)) {
                $teacherFilePath = "../uploads/" . $teacherFile['Pot_Do_Datoteke'];
                if (file_exists($teacherFilePath)) {
                    unlink($teacherFilePath);
                }
            }

            $deleteTeacherFilesStmt = mysqli_prepare($link, "DELETE FROM gradiva WHERE Gradivo_ID IN (SELECT Gradiva_ID FROM naloge WHERE Naloga_ID = ?)");
            mysqli_stmt_bind_param($deleteTeacherFilesStmt, 'i', $taskId);
            mysqli_stmt_execute($deleteTeacherFilesStmt);

            $deleteTaskStmt = mysqli_prepare($link, "DELETE FROM naloge WHERE Naloga_ID = ?");
            mysqli_stmt_bind_param($deleteTaskStmt, 'i', $taskId);
            mysqli_stmt_execute($deleteTaskStmt);

            mysqli_commit($link);
            echo "Task and all associated files have been deleted.";

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($link);
            throw $exception;
        }

    } else {
        echo "Task ID is missing in the request.";
    }
} else {
    echo "Invalid request method.";
}
?>
