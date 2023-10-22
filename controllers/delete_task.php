<?php
include '../session_start.php';
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['taskId'])) {
        $taskId = $_POST['taskId'];

        // Check if the task ID exists in the database
        $checkTaskQuery = "SELECT * FROM naloge WHERE Naloga_ID = $taskId";
        $checkTaskResult = mysqli_query($link, $checkTaskQuery);

        if ($checkTaskResult && mysqli_num_rows($checkTaskResult) > 0) {
            // Task found, proceed with deletion
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
