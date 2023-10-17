<?php
  include '../session_start.php';
  //include '../functions/status_check_false.php';
  if(!empty($_SESSION['prijavljen']) && $_SESSION['prijavljen'] == true){
    header("Location: home.php?page=dashboard");
}
?>
<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


</head>
  <style>
         body {
            background-color: #f5f5f5;
        }
        .card {
            width: 500px;
            padding: 20px;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        .container{
          position: absolute;
          background-color: white;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          width: 1200px;
          height: 600px;
        }
        .line{
          position: relative;
          top: 50%;
          transform: translateY(-50%);
        }
        .info{
          padding: 20px;
        }
        .logo{
          width: 400px;
          margin-top: 100px;
          margin-left: 140px;
        }

  </style>

  <body> 
        <div class="container d-flex flex-row border-0 shadow rounded">
            <div class="card border-0">
                <div class="card-body">
                    <form action="../controllers/registration.php" id="registrationForm" method="POST">
                        <svg class="form-control border-0 my-3" xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <input type="text" name="name" id="" class="form-control my-1 py-2" placeholder="Ime" />
                        <input type="text" name="surname" id="" class="form-control my-1 py-2" placeholder="Priimek" />
                        <input type="text" name="email" id="email" class="form-control my-3 py-2" placeholder="Email" />
                        <div id="email-error" class="text-danger"></div>
                        <input type="password" name="password" id="password" class="form-control my-1 py-2" placeholder="Geslo" />
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control my-1 py-2" placeholder="Ponovite geslo" />
                        <span id="passwordWarning" class="text-danger" style="margin-bottom: 215px;"></span>
                        <div class="my-4"></div>
                        <div class="text-center mt-1">
                            <button class="btn btn-primary" name="registration">Registracija</button>
                            <a href="login_page.php" class="nav-link my-2">Že imate profil?</a>
                        </div>
                    </form>
                </div>
          </div>
          <div class="vr line" style="height: 90%;"></div>
          <div class="info">
              <img src="../imgs/logo.png" alt="" class="logo">
          </div>
      </div>   
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="../js/input_check_reg.js"></script>
  </body>
</html>

<script>
 $(document).ready(function() {
    // Add event listener to the email input field
    $('#email').on('input', function() {
        var email = $(this).val();
        // Send AJAX request to check if the email is in use
        $.ajax({
            url: '../controllers/check_email.php', // Path to your PHP script for email checking
            method: 'POST',
            data: { email: email },
            success: function(response) {
                console.log(response);
                if (response.status === 'exists') {
                    //$('#email').addClass('is-invalid'); // Add a CSS class to indicate the email is in use
                   $('#email-error').text('Email je že v uporabi.'); // Display error message
                } else {
                    //$('#email').removeClass('is-invalid'); // Remove the CSS class if the email is not in use
                    $('#email-error').text('');// Hide error message
                }
            }
        });
    });
});


</script>
