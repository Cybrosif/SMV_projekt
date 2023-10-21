<?php
include '../../db.php';
include '../session_start.php';

// Ensure that a student ID is set in the session
if (!isset($_SESSION['user_id'])) {
    die('User ID not set in session.');
}

$student_id = $_SESSION['user_id'];

// Handle the file upload when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Check if the naloga_id is set in the POST request
    if (isset($_POST['Naloga_ID'])) {
        $naloga_id = $_POST['Naloga_ID'];
    } else {
        die('Naloga ID not provided.');
    }

    // Loop through each uploaded file
    for ($i = 0; $i < count($_FILES['fileToUpload']['name']); $i++) {
        $original_filename = basename($_FILES["fileToUpload"]["name"][$i]);
        $fileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        $newFileName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8) . '_' . $student_id . '.' . $fileType;
        $target_file = "../uploads/" . $newFileName;

        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
            $insertQuery = "INSERT INTO student_naloge (Student_ID, Naloga_ID, Datum_Oddaje, Pot_Do_Datoteke, Original_Filename) VALUES ('$student_id', '$naloga_id', NOW(), '$newFileName', '$original_filename')";

            if (!mysqli_query($link, $insertQuery)) {
                die("Error inserting into database: " . mysqli_error($link));
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Redirect back to the specific_class page after processing all files
    header('Location: ../views/home.php?page=classes');
}
?>
