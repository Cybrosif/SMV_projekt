<?php
include '../../db.php';
include '../session_start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['classId']) && isset($_POST['name']) && isset($_FILES['fileToUpload'])) {
        $classId = $_POST['classId'];
        $name = $_POST['name'];
        $user_id = $_SESSION['user_id'];

        $original_filename = basename($_FILES["fileToUpload"]["name"]);
        $fileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        $newFileName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8) . '_' . $user_id . '.' . $fileType;
        $target_file = "../uploads/" . $newFileName;

        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $insertQuery = "INSERT INTO gradiva (Razred_ID, Naslov, Pot_Do_Datoteke) VALUES ('$classId', '$name', '$newFileName')";

            if (mysqli_query($link, $insertQuery)) {
                echo "File uploaded successfully and data inserted into the database.";
            } else {
                echo "Error inserting into database: " . mysqli_error($link);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Invalid request parameters.";
    }
}
?>
