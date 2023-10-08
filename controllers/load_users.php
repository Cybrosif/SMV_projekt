<?php
include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve filter and search values sent from AJAX request
    $filterValue = $_POST['filter'];
    $searchQuery = mysqli_real_escape_string($link, $_POST['search']); // Sanitize search input

    // Query the database based on the filter value and search query
    if ($filterValue === 'all') {
        $query = "SELECT * FROM Uporabniki WHERE (vloga = 'Profesor' OR vloga = 'dijak') AND (Ime LIKE '%$searchQuery%' OR Priimek LIKE '%$searchQuery%' OR Email LIKE '%$searchQuery%')";
    } else {
        // Assuming $filterValue can be 'profesor' or 'dijak'
        $query = "SELECT * FROM Uporabniki WHERE vloga = '$filterValue' AND (Ime LIKE '%$searchQuery%' OR Priimek LIKE '%$searchQuery%' OR Email LIKE '%$searchQuery%')";
    }

    $result = mysqli_query($link, $query);

    // Generate HTML content for the filtered users
    $output = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <tr>
                <th scope="row">' . $row['ID'] . '</th>
                <td>' . $row['Ime'] . '</td>
                <td>' . $row['Priimek'] . '</td>
                <td>' . $row['Email'] . '</td>
                <td>' . $row['Vloga'] . '</td>
                <td>
                    <button class="btn btn-primary edit-btn" style="border:none;" data-userid="' . $row['ID'] . '">Uredi</button>
                    <button class="btn btn-primary delete-btn" style="background-color:#D11A2A; border: none;" data-userid="' . $row['ID'] . '">Izbriši</button>
                </td>
            </tr>';
    }
    // Send the generated HTML content back to the client-side AJAX request
    echo $output;

    // Free the result set
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($link);
?>
