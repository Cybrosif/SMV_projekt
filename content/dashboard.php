<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .custom-date-color {
            color: black !important;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-3">
        <h1 class="text-center text-primary mb-4">Nadzorna plošča</h1>

        <div class="row mt-3">
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>Moji predmeti</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        include("../../db.php");
                        if (isset($_SESSION['user_id'])) {
                            $uporabnik_id = $_SESSION['user_id'];
                            $sql = "SELECT r.Ime_razreda
                                    FROM uporabniki_razredi AS ur
                                    INNER JOIN razredi AS r ON ur.Razred_ID = r.Razred_ID
                                    WHERE ur.Uporabnik_ID = $uporabnik_id";
                            $result = $link->query($sql);
                            if ($result->num_rows > 0) {
                                echo '<ul class="list-group">';
                                while ($row = $result->fetch_assoc()) {
                                    $ime_razreda = $row["Ime_razreda"];
                                    echo '<li class="list-group-item"><a href="#">' . $ime_razreda . '</a></li>';
                                }
                                echo '</ul>';
                            } else {
                                echo '<div class="alert alert-warning">Ni rezultatov.</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">Uporabnik ni prijavljen.</div>';
                        }
                        $link->close();
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>Dodeljene naloge</h4>
                    </div>
                    <div class="card-body" style="max-height: 350px; overflow-y: auto;">
                        <div class="list-group">
                            <?php
                            include("../../db.php");
                            if (isset($_SESSION['user_id'])) {
                                $uporabnik_id = $_SESSION['user_id'];
                                $sql = "SELECT n.Naslov, n.Rok FROM naloge AS n
                                        INNER JOIN uporabniki_razredi AS ur ON n.Razred_ID = ur.Razred_ID
                                        WHERE ur.Uporabnik_ID = $uporabnik_id
                                        AND n.Rok <= DATE_ADD(CURDATE(), INTERVAL 1 WEEK)
                                        ORDER BY n.Rok ASC";
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $rok = $row["Rok"];
                                        $naslov = $row["Naslov"];
                                        $datum_roka = strtotime($rok);
                                        $class = ($datum_roka < strtotime("today")) ? 'list-group-item-danger' : '';
                                        echo '<a href="#" class="list-group-item list-group-item-action ' . $class . ' d-flex justify-content-between align-items-center">';
                                        echo $naslov;
                                        echo '<span class="badge badge-primary badge-pill custom-date-color">' . date('d.m.Y', $datum_roka) . '</span>';
                                        echo '</a>';
                                    }
                                } else {
                                    echo '<div class="alert alert-warning">Ni rezultatov.</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger">Uporabnik ni prijavljen.</div>';
                            }
                            $link->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
