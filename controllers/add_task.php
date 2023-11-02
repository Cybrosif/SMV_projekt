<?php
include '../../db.php';
include '../session_start.php';
include '../functions/add_task_check.php'


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deadline = null;
    if (isset($_POST['classId']) && isset($_POST['name']) && isset($_POST['deadline']) && isset($_POST['isVisible'])) {
        $classId = $_POST['classId'];
        $name = $_POST['name'];
        $deadline = $_POST['deadline'];
        $isVisible = $_POST['isVisible'];
        $user_id = $_SESSION['user_id'];

        $fileId = null; // Initialize fileId as null

        // Check if file is uploaded
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
            $original_filename = basename($_FILES["fileToUpload"]["name"]);
            $fileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
            $newFileName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8) . '_' . $user_id . '.' . $fileType;
            $target_file = "../uploads/" . $newFileName;

            // Try to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // Insert file information into the gradiva table
                $insertFileQuery = "INSERT INTO gradiva (Razred_ID, Naslov, Pot_Do_Datoteke) VALUES ('$classId', '$original_filename', '$newFileName')";
                if (mysqli_query($link, $insertFileQuery)) {
                    // Get the ID of the inserted file
                    $fileId = mysqli_insert_id($link);
                } else {
                    echo "Error inserting file information into the database: " . mysqli_error($link);
                    exit(); // Exit the script to prevent further execution
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit(); // Exit the script to prevent further execution
            }
        }
        $visibility = 0;
        if($isVisible == "true")
        {
            $visibility = 1;
        }else
        {

            $visibility = 0;
        }


        
        if($fileId == null)
        {
            if (empty($deadline)) {
                $insertTaskQuery = "INSERT INTO naloge (Razred_ID, Naslov, Rok, Visible) VALUES ('$classId', '$name', null, '$visibility')";

            } 
            else{
                $insertTaskQuery = "INSERT INTO naloge (Razred_ID, Naslov, Rok, Visible) VALUES ('$classId', '$name', '$deadline', '$visibility')";

            }
            
        }
        else{
            if (empty($deadline)) {
                $insertTaskQuery = "INSERT INTO naloge (Razred_ID, Gradiva_ID, Naslov, Rok, Visible) VALUES ('$classId', $fileId, '$name', null, '$visibility')";

            } 
            else{
                $insertTaskQuery = "INSERT INTO naloge (Razred_ID, Gradiva_ID, Naslov, Rok, Visible) VALUES ('$classId', $fileId, '$name', '$deadline', '$visibility')";

            }

        }
        if (mysqli_query($link, $insertTaskQuery)) {
            echo "Data inserted into the database successfully.";
        } else {
            echo "Error inserting task information into the database: " . mysqli_error($link);
        }
    } else {
        echo "Invalid request parameters.";
    }
}
?>
