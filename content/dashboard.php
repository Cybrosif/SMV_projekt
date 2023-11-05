<head>
    <style>   
        .col {
            /*border: 1px solid black;
            border-radius: 5px;*/
            margin: 5px;
        }
        .col1{
            margin:5px;
            font-size: 22px;
        }
        .nsl {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 1px;
            padding-top: 5px;
            padding-bottom: 20px;
            padding-top: 30px;
        }
        .rok-potekel {
            color: red;
        }
        a {
            text-decoration: none;
            color: inherit;
            transition: color 0.2s ease;
        }
        a:hover {
            color: #007bff;
        }
        .container{
          font-size: 19px;
        }
        .table{
            border-bottom: solid 1px gray 0.8;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: none;
        }
        th {
            background-color: black;
            color: black;
        }
        .gumb-container {
            text-align: right; 
        }
        .gumb {
            background-color: #007bff;
            border: 1px solid #ededed;
            background-color: #ededed;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            white-space: nowrap;
            transition: background-color 0.5s;
        }

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .custom-date-color {
            color: black !important;
        }
    </style>
</head>

    <h1 class='text-center primary-text'>Nadzorna plošča</h1>
    <div class="row">
        <div class="col1">
        <div class="container">
            <p class="nsl text1">Moji predmeti</p>
            <?php
include("../../db.php"); 

if (isset($_SESSION['user_id'])) {
    $uporabnik_id = $_SESSION['user_id'];
    $sql = "SELECT r.Ime_razreda, r.Razred_ID
            FROM uporabniki_razredi AS ur
            INNER JOIN razredi AS r ON ur.Razred_ID = r.Razred_ID
            WHERE ur.Uporabnik_ID = $uporabnik_id";
    $result = $link->query($sql); 

    if ($result->num_rows > 0) {
        echo '<ul>';
        while($row = $result->fetch_assoc()) {
            $ime_razreda = $row["Ime_razreda"];
            $razred_id = $row["Razred_ID"];
            // Dodajte ID razreda v povezavo
            echo '<li class="text2"><a href="http://localhost/SMV_projekt/views/home.php?page=classes-specific-student&razredID=' . $razred_id . '">' . $ime_razreda . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo "<br>Ni rezultatov.";
    }
} else {
    echo "Uporabnik ni prijavljen.";
}

$link->close(); 
?>

        </div>
        </div>
        <div class="col1">
        <div class="container">
            <p class="nsl">Dodeljene naloge</p>
            <?php
                include("../../db.php");
                            
                if (isset($_SESSION['user_id'])) {
                    $uporabnik_id = $_SESSION['user_id'];

                    $sql = "SELECT n.Naslov, n.Rok, Student_naloga_ID, FROM naloge AS n
                            INNER JOIN uporabniki_razredi AS ur ON n.Razred_ID = ur.Razred_ID
                            WHERE ur.Uporabnik_ID = $uporabnik_id
                            AND n.Rok <= DATE_ADD(CURDATE(), INTERVAL 1 WEEK)
                            ORDER BY n.Rok ASC";
                
                    $result = $link->query($sql);
                
                    if ($result->num_rows > 0) {
                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col"></th>';
                        echo '<th scope="col" class="text2">Naslov</th>';
                        echo '<th scope="col" class="text2">Rok oddaje</th>';
                        
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = $result->fetch_assoc()) {
                            $rok = $row["Rok"];
                            $naslov = $row["Naslov"];
                            $datum_roka = strtotime($rok);
                            $student_naloga_id = $row["Student_Naloga_ID"];
                            
                        
                            if ($datum_roka < strtotime("today")) {
                                echo '<tr class="rok-potekel table-danger">'; // Added Bootstrap class for rows with expired dates
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
</html>
