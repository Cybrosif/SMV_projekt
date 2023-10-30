<?php
include '../../db.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['email']) && isset($_GET['taskId'])) {
        $email = $_GET['email'];
        $taskId = $_GET['taskId'];

        $stmt = $link->prepare("SELECT Pot_Do_Datoteke, Original_Filename
                                FROM student_naloge
                                WHERE Naloga_Id = ? 
                                AND Student_ID = (SELECT ID FROM uporabniki WHERE Email = ?)");
        $stmt->bind_param("is", $taskId, $email);
        $stmt->execute();
        $stmt->bind_result($potDoDatoteke, $originalFilename);
        
        // Fetch the results
        $filePaths = [];
        while ($stmt->fetch()) {
            // Add fetched file paths to the array
            $filePaths[] = ['path' => '../uploads/'.$potDoDatoteke, 'filename' => $originalFilename];
        }

        // Create a temporary directory to store the files
        $tempDir = '../temp/temp_zip_' . uniqid();
        mkdir($tempDir);
        
        // Copy the files from the fetched paths to the temporary directory
        foreach ($filePaths as $file) {
            $sourceFilePath = $file['path'];
            $destinationFilePath = $tempDir . '/' . $file['filename'];
            copy($sourceFilePath, $destinationFilePath);
        }

        // Create a zip file containing the copied files
        $zipFileName = 'user_files.zip';
        $zip = new ZipArchive();
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            // Add files to the zip archive
            $dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tempDir));
            foreach ($dir as $file) {
                // Skip directories
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($tempDir) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
        }

        // Delete the temporary directory
        deleteDirectory($tempDir);

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

// Recursive function to delete a directory and its contents
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}
?>