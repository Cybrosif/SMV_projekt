<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../session_start.php';
    include '../../db.php';

    if (isset($_POST['vloga'])) {
        foreach ($_POST['vloga'] as $user_id => $vloga) {

            $user_id = mysqli_real_escape_string($link, $user_id);
            $vloga = mysqli_real_escape_string($link, $vloga);

            $update_query = "UPDATE Uporabniki SET Vloga = '$vloga' WHERE ID = $user_id";
            mysqli_query($link, $update_query);
        }

        
        header("Location: ../index.php");
        exit();
    } else {
        
        echo "Form data not received!";
    }

    
    mysqli_close($link);
} else {
    
    echo "Invalid request method!";
}
?>
