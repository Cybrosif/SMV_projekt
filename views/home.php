<?php 
    include '../session_start.php';
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Šolska Podpora</title>
    <style>
        :root {
            --main-bg-color: #0066cc;
            --main-text-color: #0066cc;
            --second-text-color: #bbbec5;
            --second-bg-color: #c1efde;
        }

        .primary-text {
            color: var(--main-text-color);
        }

        .second-text {
            color: var(--second-text-color);
        }

        .primary-bg {
            background-color: var(--main-bg-color);
        }

        .secondary-bg {
            background-color: var(--second-bg-color);
        }

        .rounded-full {
            border-radius: 100%;
        }

        #wrapper {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            -webkit-transition: margin 0.25s ease-out;
            -moz-transition: margin 0.25s ease-out;
            -o-transition: margin 0.25s ease-out;
            transition: margin 0.25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #page-content-wrapper {
            min-width: 100vw;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #menu-toggle {
            cursor: pointer;
        }

        .list-group-item {
            border: none;
            padding: 20px 30px;
        }

        .list-group-item.active {
            background-color: transparent;
            color: var(--main-text-color);
            font-weight: bold;
            border: none;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: #e0e0e0; /* General text color for dark mode */
        }

        body.dark-mode .bg-transparent {
            background-color: #242424 !important;
        }

        body.dark-mode .navbar-light .navbar-toggler-icon {
            background-color: #ffffff;
        }

        body.dark-mode #wrapper {
            background-color: #242424 !important; /* This ensures the entire sidebar goes dark */
        }

        body.dark-mode #sidebar-wrapper,
        body.dark-mode #sidebar-wrapper .bg-white {
            background-color: #242424 !important;
        }

        body.dark-mode #sidebar-wrapper .list-group-item {
            color: #e0e0e0; /* Sidebar item text color */
            background-color: #242424 !important;
        }

        body.dark-mode #sidebar-wrapper .list-group-item.active {
            color: #0066cc; /* Active sidebar item text color */
            background-color: #121212 !important;
        }

        body.dark-mode #sidebar-wrapper .sidebar-heading {
            color: #ffffff;
            background-color: #121212 !important;
        }

        body.dark-mode .navbar-light .navbar-toggler-icon {
            background-color: #ffffff;
        }
        body.dark-mode .dropdown-menu {
            background-color: #242424 !important;
        }

        body.dark-mode .dropdown-item {
            color: #e0e0e0 !important;
        }

        body.dark-mode .dropdown-item:hover, 
        body.dark-mode .dropdown-item:focus {
            color: #ffffff !important;
            background-color: #121212 !important;
        }


        /* Modern Toggle Styles */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        body.dark-mode .switch .slider {
            background-color: #555;
        }

        body.dark-mode input:checked + .slider {
            background-color: #bbb;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
                $("#menu-toggle").click(function (e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });

                // Update this selector to include .dropdown-item
                $(".list-group-item, .dropdown-item").click(function (e) {
                    e.preventDefault();
                    $(".list-group-item.active").removeClass("active");
                    $(this).addClass("active");
                    let page = $(this).data("page");
                    if (page === 'logout') {
                        $.ajax({
                            type: "POST",
                            url: "../controllers/logout.php",
                            success: function (data) {
                                window.location.href = 'login_page.php';
                            }
                        });
                    } else {
                        $.get("content.php", { page: page }, function (data) {
                            $("#content").html(data);
                        });
                    }
                });
            });
    </script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white shadow rounded" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas"></i>CLASSORBIT</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" data-page="dashboard" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Nadzorna plošča</a>

                <a href="#" data-page="users" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-user-edit me-2"></i>Upravljanje uporabnikov</a>
                
                <?php        
                    if($_SESSION['user_vloga']=='administrator'){
                        echo '<a href="#" data-page="subjects" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-book me-2"></i>Upravljanje predmetov</a>';
                    }
                ?>
                <?php 
                    $user_vloga = $_SESSION['user_vloga'];
                    if ($user_vloga == 'učitelj' || $user_vloga == 'administrator'){
                        echo '<a href="#" data-page="upload" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-file-upload me-2"></i>Nalaganje gradiv</a>';
                    }
                ?>



                <a href="#" data-page="tasks" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tasks me-2"></i>Pregled nalog</a>
                <a href="#" data-page="logout" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-sign-out-alt me-2"></i>Odjava</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="h5 mb-0 primary-text">Meni</h2>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['user_ime'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-secondary text-center" href="#" data-page="profile">Profil</a></li>
                                <li><a class="dropdown-item text-secondary text-center" href="#" data-page="settings">Nastavitve</a></li>
                                <!-- <a href="#" data-page="logout" class="list-group-item list-group-item-action bg-transparent second-text fw-bold" id="logout"><i
                                    class="fas fa-sign-out-alt me-2"></i>Odjava</a> -->
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid" id="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="text-center primary-text">Dobrodošli na nadzorni plošči</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

</html>
