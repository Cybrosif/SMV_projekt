<?php
include '../session_start.php';
include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the file ID from the POST data
    $fileId = $_POST['fileId'];

    // Check if the user is a teacher or student
    $role = $_SESSION['user_vloga']; // Assuming 'role' is the session variable indicating user role (teacher or student)

    // Define appropriate SQL query based on user role
    if ($role === 'Profesor' || $role === 'Administrator') {
        $sql = "SELECT * FROM gradiva WHERE Gradivo_ID = $fileId";
    } else if ($role === 'Dijak'){
        $sql = "SELECT * FROM student_naloge WHERE Student_Naloga_ID = $fileId AND Student_ID = {$_SESSION['user_id']}";
    }
    

    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // File exists and user has permission, proceed with deletion
        $row = mysqli_fetch_assoc($result);
        $filename = $row['Pot_Do_Datoteke'];

        // Delete the file from the server
        $file_path = '../uploads/' . $filename; // Update this with the actual file path
        if (unlink($file_path)) {
            // File deleted successfully, now delete the record from the database
            if ($role === 'Profesor' || $role === 'Administrator') {
                $delete_sql = "DELETE FROM gradiva WHERE Gradivo_ID = $fileId";
            } else if ($role === 'Dijak'){
                $delete_sql = "DELETE FROM student_naloge WHERE Student_Naloga_ID = $fileId";
            }

            $delete_result = mysqli_query($link, $delete_sql);

            if ($delete_result) {
                echo 'File deleted successfully.';
            } else {
                echo 'Error deleting file record from the database.';
            }
        } else {
            echo 'Error deleting the file from the server.';
        }
    } else {
        // File does not exist or user does not have permission
        echo 'File not found or you do not have permission to delete it.';
    }
} else {
    // Invalid request method
    echo 'Invalid request method.';
}
?>
