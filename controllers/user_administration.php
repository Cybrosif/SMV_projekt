<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    include('../session_start.php');
    include('../../db.php'); // Include your database connection file
    $admin_id = $_SESSION['user_id'];

    // Check if the logged-in user is an administrator (you may want to implement additional checks here)
    // Example: You can have a 'role' column in your database where user roles are stored, and you check if the user has 'administrator' role.

    // Get data from the form
    $user_ids = $_POST['user_id'];
    $roles = $_POST['vloga'];

    // Loop through the submitted data and update roles
    for ($i = 0; $i < count($user_ids); $i++) {
        $user_id = mysqli_real_escape_string($link, $user_ids[$i]);
        $role = mysqli_real_escape_string($link, $roles[$i]);

        // Update the user role in the database
        $query = "UPDATE Uporabniki SET Vloga = '$role' WHERE ID = '$user_id'";
        $result = mysqli_query($link, $query);

        // Check if the update was successful
        if ($result) {
            echo "User with ID $user_id updated successfully to role: $role<br>";
        } else {
            echo "Error updating user with ID $user_id<br>";
        }
    }
} else {
    echo "Invalid request";
}
?>
