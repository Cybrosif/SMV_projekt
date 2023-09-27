<?php
$page = $_GET['page'];
include '../../db.php';
include '../session_start.php';


switch ($page) {
    case 'dashboard':
        echo "<h1 class='text-center primary-text'>Nadzorna plošča</h1>";

        break;

    case 'users':
        echo "<h1 class='text-center primary-text'>Upravljanje uporabnikov</h1>";
        // Your users management content logic
        break;

    case 'subjects':
        echo "<h1 class='text-center primary-text'>Upravljanje predmetov</h1>";
        // Your subjects management content logic
        break;

    case 'upload':
        echo "<h1 class='text-center primary-text'>Nalaganje gradiv</h1>";
        // Your upload content logic
        break;

    case 'classes':
        echo "<h1 class='text-center primary-text mb-5'>Razredi</h1>";  // Increased bottom margin

        // Include the Poppins font for modern text appearance
        echo '<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">';
  
    
        // Fetch classes from the database
        $sql = "SELECT * FROM Razredi"; // Assuming your table name is Razredi
        $result = $link->query($sql);
    
        if ($result->num_rows > 0) {
            echo "<div class='container'>";
            echo "<div class='row row row-no-padding'>";
            while($row = $result->fetch_assoc()) {
                echo "<div class='custom-col mb-3'>";  // Adjusted for 5 boxes in a row
                echo "<a href='content.php?data-page=" . $row['Ime_razreda'] . "' class='d-block p-3 text-center class-link modern-box custom-side-shadow' style='background-color: #3394e1; font-family: Poppins, sans-serif;'>";
                echo $row['Ime_razreda'];
                echo "</a>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p class='text-center second-text'>No classes found!</p>";
        }
    break;


    case 'logout':
        echo "<h1 class='text-center primary-text'>Odjava</h1>";
        // Your logout content logic
        break;

        case 'profile':
            echo "<h1 class='text-center primary-text'>Profil</h1>";
            // Your profile content logic
            break;
    
    case 'settings':
        echo "<h1 class='text-center primary-text my-4'>Nastavitve</h1>";            
        echo "<div class='container'>";
        echo "<form id='settingsForm' action='../controllers/settings.php' method='post'>";
        echo "<div id='passwordWarning' class='row mb-3'>";
        echo "<div class='col-md-6'>";
        echo "<label for='username' class='form-label'>Uporabniško ime</label>";
        echo "<input type='text' class='form-control' id='username' name='username' value='" . $_SESSION['user_ime'] . "'>";
        echo "<label for='password' class='form-label'>Geslo</label>";
        echo "<input type='password' class='form-control' id='password' name='password'>";
        echo "<label for='password-confirm' class='form-label'>Potrdi geslo</label>";
        echo "<input type='password' class='form-control' id='password-confirm' name='password-confirm'>";
        echo "<button type='submit' class='btn btn-primary my-3' id='saveButton' disabled>Shrani</button>";
        echo "</div>";
        echo "</div>";
        echo "</form>";
        echo "</div>";
        
        echo "<script>
            $(document).ready(function () {
                $('#username, #password, #password-confirm').on('keyup', function () {
                    let username = $('#username').val();
                    let password = $('#password').val();
                    let confirmPassword = $('#password-confirm').val();
                    if (username === '' || password === '' || confirmPassword === '') {
                        $('#emptyFieldsError').text('Vsa polja so obvezna.');
                        $('#saveButton').prop('disabled', true);
                    } else {
                        $('#emptyFieldsError').text('');
                    }
                    if (password !== confirmPassword) {
                        $('#passwordMismatchError').text('Gesla se ne ujemata.');
                        $('#saveButton').prop('disabled', true);
                    } else {
                        $('#passwordMismatchError').text('');
                    }
                    if (username !== '' && password !== '' && confirmPassword !== '' && password === confirmPassword) {
                        $('#saveButton').prop('disabled', false);
                    }
                });
            });
        </script>";

        echo "<div id='emptyFieldsError' style='color: red;'></div>";
        echo "<div id='passwordMismatchError' style='color: red;'></div>";

        echo "<div class='mt-4'>";
        echo "<h3 class='text-center primary-text'>Dark Mode</h3>";
        echo "<div class='text-center'>";
        echo "<label class='switch'>";
        echo "<input type='checkbox' id='darkModeToggle'>";
        echo "<span class='slider round'></span>";
        echo "</label>";
        echo "</div>";
        echo "</div>";

        echo "<script>
            $(document).ready(function () {
                // Check if dark mode is already enabled
                if (localStorage.getItem('darkMode') === 'enabled') {
                    $('body').addClass('dark-mode');
                    $('#darkModeToggle').prop('checked', true);
                }

                // Toggle dark mode
                $('#darkModeToggle').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('body').addClass('dark-mode');
                        localStorage.setItem('darkMode', 'enabled');
                    } else {
                        $('body').removeClass('dark-mode');
                        localStorage.setItem('darkMode', 'disabled');
                    }
                });
            });
        </script>";



           
        break;

    default:
        echo "<h1 class='text-center primary-text'>Nadzorna plošča</h1>";
        break;
}
?>
