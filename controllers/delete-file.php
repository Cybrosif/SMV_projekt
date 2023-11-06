<?php
include '../session_start.php';
include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileId = $_POST['fileId'];

    $role = $_SESSION['user_vloga']; 

    if ($role === 'Profesor' || $role === 'Administrator') {
        $sql = "SELECT * FROM gradiva WHERE Gradivo_ID = $fileId";
    } else if ($role === 'Dijak'){
        $sql = "SELECT * FROM student_naloge WHERE Student_Naloga_ID = $fileId AND Student_ID = {$_SESSION['user_id']}";
    }
    

    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filename = $row['Pot_Do_Datoteke'];

        $file_path = '../uploads/' . $filename; 
        if (unlink($file_path)) {
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
        echo 'File not found or you do not have permission to delete it.';
    }
} else {
    echo 'Invalid request method.';
}
?>
