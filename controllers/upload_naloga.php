<?php
include '../../db.php';
include '../session_start.php';

if (!isset($_SESSION['user_id'])) {
    die('User ID not set in session.');
}

$student_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST['Naloga_ID'])) {
        $naloga_id = $_POST['Naloga_ID'];
    } else {
        die('Naloga ID not provided.');
    }

    for ($i = 0; $i < count($_FILES['fileToUpload']['name']); $i++) {
        $original_filename = basename($_FILES["fileToUpload"]["name"][$i]);
        $fileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        $newFileName = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 8) . '_' . $student_id . '.' . $fileType;
        $target_file = "../uploads/" . $newFileName;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
            $insertQuery = "INSERT INTO student_naloge (Student_ID, Naloga_ID, Datum_Oddaje, Pot_Do_Datoteke, Original_Filename) VALUES ('$student_id', '$naloga_id', NOW(), '$newFileName', '$original_filename')";

            if (!mysqli_query($link, $insertQuery)) {
                die("Error inserting into database: " . mysqli_error($link));
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    header('Location: ../views/home.php?page=classes');
}
if(isset($_POST['uredi'])){
    $id = $_POST['id'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["gradivoFile"]["name"]);
    $uploadOk = 1;

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }


    if ($uploadOk) {
        if (move_uploaded_file($_FILES["gradivoFile"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["gradivoFile"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $sql = "UPDATE gradiva SET ime='$ime', prezime='$prezime', file_path='$target_file' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>
