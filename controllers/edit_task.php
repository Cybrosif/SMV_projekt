<?php
include '../session_start.php';
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['taskId']) && isset($_POST['name']) && isset($_POST['deadline']) && isset($_POST['isVisible'])) {
        $taskId = $_POST['taskId'];
        $name = $_POST['name'];
        $deadline = $_POST['deadline'];
        $isVisible = $_POST['isVisible'];
        $classId = $_POST['classId'];

        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
            $existingFileQuery = "SELECT Gradiva_ID FROM naloge WHERE Naloga_ID=$taskId";
            $existingFileResult = mysqli_query($link, $existingFileQuery);
            if ($existingFileResult && mysqli_num_rows($existingFileResult) > 0) {
                $existingFileData = mysqli_fetch_assoc($existingFileResult);
                $existingFileId = $existingFileData['Gradivo_ID'];

                $deleteFileQuery = "DELETE FROM gradiva WHERE Gradivo_ID=$existingFileId";
                if (mysqli_query($link, $deleteFileQuery)) {
                    $existingFilePathQuery = "SELECT Pot_Do_Datoteke FROM gradiva WHERE Gradivo_ID=$existingFileId";
                    $existingFilePathResult = mysqli_query($link, $existingFilePathQuery);
                    if ($existingFilePathResult && mysqli_num_rows($existingFilePathResult) > 0) {
                        $existingFilePathData = mysqli_fetch_assoc($existingFilePathResult);
                        $existingFilePath = $existingFilePathData['Pot_Do_Datoteke'];

                        // Delete the file from the uploads folder
                        if (unlink("../uploads/$existingFilePath")) {
                            echo "Existing file deleted successfully.";
                        } else {
                            echo "Error deleting existing file.";
                        }
                    }
                }
            }

            $user_id = $_SESSION['user_id'];
            $original_filename = basename($_FILES["fileToUpload"]["name"]);
            $fileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
            $newFileName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8) . '_' . $user_id . '.' . $fileType;
            $target_file = "../uploads/" . $newFileName;

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $insertFileQuery = "INSERT INTO gradiva (Razred_ID, Naslov, Pot_Do_Datoteke) VALUES ('$classId', '$original_filename', '$newFileName')";
                if (mysqli_query($link, $insertFileQuery)) {
                    $fileId = mysqli_insert_id($link);
                } else {
                    echo "Error inserting file information into the database: " . mysqli_error($link);
                    exit(); 
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit(); 
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
        if (empty($deadline)) {
            if (!empty($fileId)) {
                $updateTaskQuery = "UPDATE naloge SET Naslov='$name', Gradiva_ID='$fileId', Rok=NULL, Visible='$visibility' WHERE Naloga_ID='$taskId'";
            } else {
                $updateTaskQuery = "UPDATE naloge SET Naslov='$name', Rok=NULL, Visible='$visibility' WHERE Naloga_ID='$taskId'";
            }
        } else {
            if (!empty($fileId)) {
                $updateTaskQuery = "UPDATE naloge SET Naslov='$name', Gradiva_ID='$fileId', Rok='$deadline', Visible='$visibility' WHERE Naloga_ID='$taskId'";
            } else {
                $updateTaskQuery = "UPDATE naloge SET Naslov='$name', Rok='$deadline', Visible='$visibility' WHERE Naloga_ID='$taskId'";
            }
        }
        
        if (mysqli_query($link, $updateTaskQuery)) {
            echo "Task updated successfully.";
        } else {
            echo "Error updating task: " . mysqli_error($link);
        }
        

        if (mysqli_query($link, $updateTaskQuery)) {
            echo "Task updated successfully.";
        } else {
            echo "Error updating task: " . mysqli_error($link);
        }
    } else {
        echo "Invalid request parameters.";
    }
}
?>
