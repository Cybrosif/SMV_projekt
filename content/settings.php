<h1 class='text-center primary-text my-4'>Nastavitve</h1>

<div class='container'>
    <form id='settingsForm' action='../controllers/settings.php' method='post'>
        <div class='row mb-3'>
            <div class='col-md-6'>
                <label for='username' class='form-label'>Ime</label>
                <input type='text' class='form-control' id='username' name='username' value='<?php echo $_SESSION['user_ime']; ?>'>
                <label for='surname' class='form-label'>Priimek</label>
                <input type='text' class='form-control' id='surname' name='surname' value='<?php echo $_SESSION['user_priimek']; ?>'>
                <label for='password' class='form-label'>Geslo</label>
                <input type='password' class='form-control' id='password' name='password'>
                <label for='password-confirm' class='form-label'>Potrdi Geslo</label>
                <input type='password' class='form-control' id='password-confirm' name='password-confirm'>
                <button type='submit' class='btn btn-primary my-3' id='saveButton'>Shrani</button>

                <div id='passwordWarning' style='color: red;'></div>
            </div>
        </div>
    </form>
</div>


<!-- Including the jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Including your external JavaScript file -->
<script src="../js/settings_check.js"></script>

</body>
</html>
