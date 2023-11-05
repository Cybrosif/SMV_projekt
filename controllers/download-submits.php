<?php
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['email']) && isset($_GET['taskId'])) {
        $email = $_GET['email'];
        $taskId = $_GET['taskId'];
        
        $query = "SELECT Naslov FROM naloge WHERE Naloga_ID = $taskId";
        $result = mysqli_query($link, $query);

        if (!$result) {
            die("Error: " . mysqli_error($link)); // Print MySQL error if query fails
        }

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $naslov = $row['Naslov'];
            mysqli_free_result($result); // Free the result set

            // Rest of your code for creating the ZIP file and initiating download
        }

        // Fetch submission files from the database
        $stmt = $link->prepare("SELECT Pot_Do_Datoteke, Original_Filename
                                FROM student_naloge
                                WHERE Naloga_Id = ? 
                                AND Student_ID = (SELECT ID FROM uporabniki WHERE Email = ?)");
        $stmt->bind_param("is", $taskId, $email);
        $stmt->execute();
        $stmt->bind_result($potDoDatoteke, $originalFilename);
        
        // Initialize ZIP archive
        $zipFileName = $email.'-'.$naslov.'.zip';
        $zip = new ZipArchive();
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            // Add submission files to the ZIP archive
            while ($stmt->fetch()) {
                $sourceFilePath = '../uploads/' . $potDoDatoteke;
                $zip->addFile($sourceFilePath, $originalFilename);
            }
            $zip->close();
        }

        // Set headers to force download the zip file
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        readfile($zipFileName);

        // Delete the zip file after download
        unlink($zipFileName);
    } else {
        echo "Email or task ID is missing in the request.";
    }
} else {
    echo "Invalid request method.";
}
?>
