<h1 class='text-center primary-text my-4'>Nastavitve</h1>

<div class='container'>
    <form id='settingsForm' action='../controllers/settings.php' method='post'>
        <div id='passwordWarning' class='row mb-3'>
            <div class='col-md-6'>
                <label for='username' class='form-label'>Uporabniško ime</label>
                <input type='text' class='form-control' id='username' name='username' value='<?php echo $_SESSION['user_ime']; ?>'>
                <label for='password' class='form-label'>Geslo</label>
                <input type='password' class='form-control' id='password' name='password'>
                <label for='password-confirm' class='form-label'>Potrdi geslo</label>
                <input type='password' class='form-control' id='password-confirm' name='password-confirm'>
                <button type='submit' class='btn btn-primary my-3' id='saveButton' disabled>Shrani</button>
            </div>
        </div>
    </form>
</div>

<script>
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
</script>

<div id='emptyFieldsError' style='color: red;'></div>
<div id='passwordMismatchError' style='color: red;'></div>

<div class='mt-4'>
    <h3 class='text-center primary-text'>Dark Mode</h3>
    <div class='text-center'>
        <label class='switch'>
            <input type='checkbox' id='darkModeToggle'>
            <span class='slider round'></span>
        </label>
    </div>
</div>

<script>
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
</script>
