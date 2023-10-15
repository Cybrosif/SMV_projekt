<?php
include '../session_start.php';
include '../../db.php';
include '../functions/check_if_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $classId = $_POST['classId'];

    // Check if the class exists in the database
    $checkSql = "SELECT * FROM razredi WHERE Razred_ID = $classId";
    $checkResult = $link->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Get list of assignments from naloge table
        $assignmentsSql = "SELECT Naloga_ID FROM naloge WHERE Razred_ID = $classId";
        $assignmentsResult = $link->query($assignmentsSql);

        while ($row = $assignmentsResult->fetch_assoc()) {
            $assignmentId = $row['Naloga_ID'];

            $assignmentsSql2 = "SELECT Pot_Do_Datoteke FROM student_naloge WHERE Naloga_ID = $assignmentId";
            $assignmentsResult2 = $link->query($assignmentsSql2);
            if ($assignmentsResult2 && $assignmentsResult2->num_rows > 0) {
                // Fetch the single row as an associative array
                $row = $assignmentsResult2->fetch_assoc();
            
                // Access the file path from the associative array
                $filePath = $row['Pot_Do_Datoteke'];
            
                // Now $filePath contains the file path returned from the query
                // You can use $filePath as needed
            } 

            $deleteStudentSubmissionSql = "DELETE FROM student_naloge WHERE Naloga_ID = $assignmentId";
            $studentSubmissionsResult = $link->query($deleteStudentSubmissionSql);

            $oldFilePath = "../uploads/" . $filePath;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);  // Deletes the old file from the server
            }
        }

        // Delete assignments and class
        $deleteAssignmentsSql = "DELETE FROM naloge WHERE Razred_ID = $classId";
        $deleteClassSql = "DELETE FROM razredi WHERE Razred_ID = $classId";

        if ($link->query($deleteAssignmentsSql) === TRUE && $link->query($deleteClassSql) === TRUE) {
            echo 'Class, related assignments, student submissions, and files deleted successfully!';
        } else {
            echo 'Error deleting class: ' . $link->error;
        }
    } else {
        echo 'Class not found!';
    }
} else {
    echo 'Invalid request';
}
?>
