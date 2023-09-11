<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".ajax-link").click(function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                $.get("content.php", {
                    page: page
                }, function(data) {
                    $("main").html(data);
                });
            });
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Šolski sistem</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link ajax-link" data-page="home" href="#">Domov</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ajax-link" data-page="profil" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ajax-link" data-page="nastavitve" href="#">Nastavitve</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container mt-4">
        <!-- Content will be loaded here -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
