<?php
include '../session_start.php';
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['taskId'])) {
        $taskId = $_POST['taskId'];

        // Check if the task ID exists in the database
        $checkTaskQuery = "SELECT Gradiva_ID FROM naloge WHERE Naloga_ID = $taskId";
        $checkTaskResult = mysqli_query($link, $checkTaskQuery);

        if ($checkTaskResult && mysqli_num_rows($checkTaskResult) > 0) {
            // Task found, get Gradivo_ID and delete the file
            $taskData = mysqli_fetch_assoc($checkTaskResult);
            $gradivoId = $taskData['Gradiva_ID'];

            if ($gradivoId !== null) {
                // Fetch file information from the database
                $getFileQuery = "SELECT Pot_Do_Datoteke FROM gradiva WHERE Gradivo_ID = $gradivoId";
                $getFileResult = mysqli_query($link, $getFileQuery);

                if ($getFileResult && mysqli_num_rows($getFileResult) > 0) {
                    $fileData = mysqli_fetch_assoc($getFileResult);
                    $filePath = $fileData['Pot_Do_Datoteke'];

                    // Delete the file from the server
                    $fileFullPath = "../uploads/" . $filePath;
                    if (file_exists($fileFullPath)) {
                        unlink($fileFullPath);
                        // Delete the file information from the database
                        $deleteFileQuery = "DELETE FROM gradiva WHERE Gradivo_ID = $gradivoId";
                        mysqli_query($link, $deleteFileQuery);
                    } else {
                        echo "Error: File not found on the server.";
                    }
                } else {
                    echo "Error: File information not found in the database.";
                }
            }
            $getStudentNalogeFilesQuery = "SELECT Pot_Do_Datoteke FROM student_naloge WHERE Naloga_ID = $taskId";
            $getStudentNalogeFilesResult = mysqli_query($link, $getStudentNalogeFilesQuery);

            while ($studentNalogeData = mysqli_fetch_assoc($getStudentNalogeFilesResult)) {
                $studentNalogeFilePath = $studentNalogeData['Pot_Do_Datoteke'];

                // Delete the file from the server
                $studentNalogeFileFullPath = "../uploads/" . $studentNalogeFilePath;
                if (file_exists($studentNalogeFileFullPath)) {
                    unlink($studentNalogeFileFullPath);
                }
            }
            $deleteStudentNalogeQuery = "DELETE FROM student_naloge WHERE Naloga_ID = $taskId";
            if (!mysqli_query($link, $deleteStudentNalogeQuery)) {
                echo "Error deleting associated student_naloge records: " . mysqli_error($link);
                exit;
            }

            $deleteTaskQuery = "DELETE FROM naloge WHERE Naloga_ID = $taskId";
            if (mysqli_query($link, $deleteTaskQuery)) {
                echo "Task deleted successfully.";
            } else {
                echo "Error deleting task: " . mysqli_error($link);
            }
        } else {
            // Task not found, return an error message
            echo "Task with ID $taskId not found.";
        }
    } else {
        echo "Task ID is missing in the request.";
    }
} else {
    echo "Invalid request method.";
}
?>
