<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>

  <style>
        .card {
            width: 500px;
            padding: 20px;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
        .container{
          position: absolute;
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
                    <form action="" id="registrationForm">
                        <svg class="form-control border-0 my-3" xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <input type="text" name="" id="" class="form-control my-4 py-2" placeholder="Ime" />
                        <input type="text" name="" id="" class="form-control my-4 py-2" placeholder="Priimek" />
                        <input type="text" name="" id="" class="form-control my-4 py-2" placeholder="Email" />
                        <input type="password" name="password" id="password" class="form-control my-4 py-2" placeholder="Geslo" />
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control my-2 py-2" placeholder="Ponovite geslo" />
                        <span id="passwordWarning" class="text-danger" style="margin-bottom: 215px;"></span>
                        <div class="text-center mt-1">
                            <button class="btn btn-primary">Registracija</button>
                            <a href="login_page.php" class="nav-link">Že imate profil?</a>
                        </div>
                    </form>
                </div>
          </div>
          <div class="vr line" style="height: 90%;"></div>
          <div class="info">
              <img src="../imgs/logo.png" alt="" class="logo">
          </div>
      </div>   

    <script src="../js/password_check.js?v=2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
