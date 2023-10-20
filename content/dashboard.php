<!DOCTYPE html>
<html>
<head>
    <title>Nadzorna plošča</title>
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

        .gumb:hover {
            background-color: white;
        }
    </style>
</head>

<h1 class='text-center primary-text my-4'>Nadzorna plošča</h1>

    <div class="row">
        <div class="col1">
        <div class="container">
            <p class="nsl text1">Moji predmeti</p>
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
                        echo '<ul>';
                        while($row = $result->fetch_assoc()) {
                            $ime_razreda = $row["Ime_razreda"];
                            echo '<li class="text2"><a href="#">' . $ime_razreda . '</a></li>';
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

                    $sql = "SELECT n.Naslov, n.Opis, n.Rok FROM naloge AS n
                            INNER JOIN uporabniki_razredi AS ur ON n.Razred_ID = ur.Razred_ID
                            WHERE ur.Uporabnik_ID = $uporabnik_id
                            AND n.Rok <= DATE_ADD(CURDATE(), INTERVAL 1 WEEK)
                            ORDER BY n.Rok ASC";

                    $result = $link->query($sql);

                    if ($result && $result->num_rows > 0) {
                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col"></th>';
                        echo '<th scope="col" class="text2">Naslov</th>';
                        echo '<th scope="col" class="text2">Opis</th>';
                        echo '<th scope="col" class="text2">Rok oddaje</th>';
                        echo '<th scope="col" class="text2"></th>'; // Dodajte stolpec za gumb
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = $result->fetch_assoc()) {
                            $rok = $row["Rok"];
                            $naslov = $row["Naslov"];
                            $opis = $row["Opis"];
                            $datum_roka = strtotime($rok);

                            if ($datum_roka < strtotime("today")) {
                                echo '<tr class="rok-potekel">';
                            } else {
                                echo '<tr>';
                            }
                            echo '<th scope="row" ></th>';
                            echo '<td class="text3"><a href="#">' . $naslov . '</a></td>';
                            echo '<td class="text3">' . $opis . '</td>';
                            echo '<td class="text3">' . date('d.m.Y', $datum_roka) . '</td>';
                            echo '<td class="gumb-container text3"><a class="gumb" href="#">Oddaj nalogo</a></td>'; // Dodajte gumb za oddajo naloge
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
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
    </div>
</html>
