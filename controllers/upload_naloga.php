<?php
include '../../db.php';

// Start the session to get the student ID
session_start();

// Ensure that a student ID is set in the session
if (!isset($_SESSION['user_id'])) {
    die('User ID not set in session.');
}

$student_id = $_SESSION['user_id'];

// Handle the file upload when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Check if the naloga_id is set in the POST request
    if (isset($_POST['Naloga_ID'])) {
        $naloga_id = mysqli_real_escape_string($link, $_POST['Naloga_ID']);
    } else {
        die('Naloga ID not provided.');
    }

    // Check if a file has already been uploaded for this assignment by this user
    $checkQuery = "SELECT Pot_Do_Datoteke FROM student_naloge WHERE Student_ID = '$student_id' AND Naloga_ID = '$naloga_id'";
    $checkResult = mysqli_query($link, $checkQuery);
    if(mysqli_num_rows($checkResult) > 0) {
        $oldFileData = mysqli_fetch_assoc($checkResult);
        $oldFilePath = "../uploads/" . $oldFileData['Pot_Do_Datoteke'];
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);  // Delete the old file
        }
        // Now delete the old record from the database
        $deleteOldRecord = "DELETE FROM student_naloge WHERE Student_ID = '$student_id' AND Naloga_ID = '$naloga_id'";
        mysqli_query($link, $deleteOldRecord);
        
    }
    
    // Extract file details
    $original_filename = basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
    $newFileName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8) . '_' . $student_id . '.' . $fileType;
    $target_file = "../uploads/" . $newFileName;

    // Try to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        
        $insertQuery = "INSERT INTO student_naloge (Student_ID, Naloga_ID, Datum_Oddaje, Pot_Do_Datoteke, Original_Filename) VALUES ('$student_id', '$naloga_id', NOW(), '$newFileName', '$original_filename')";

        if (!mysqli_query($link, $insertQuery)) {
            die("Error inserting into database: " . mysqli_error($link));
        }

        // Redirect back to the specific_class page
        header('Location: ../views/home.php?page=classes');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }


}
?>
