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
        .nsl {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 1px;
            padding-top: 5px;
            padding-bottom: 10px;
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

    </style>
</head>
<body>
    <h1 class='text-center primary-text'>Nadzorna plošča</h1>
    <div class="container">
        <div class="row">
            <div class="col">
            <p class="nsl">Moji predmeti</p>
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
                            echo '<li><a href="#">' . $ime_razreda . '</a></li>';
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
            <div class="col">
                <p class="nsl">Dodeljene naloge</p>
                <?php
                  include("../../db.php");

                  if (isset($_SESSION['user_id'])) {
                      $uporabnik_id = $_SESSION['user_id'];
                  
                      $sql = "SELECT n.Naslov, n.Opis, n.Rok
                              FROM naloge AS n
                              INNER JOIN uporabniki_razredi AS ur ON n.Razred_ID = ur.Razred_ID
                              WHERE ur.Uporabnik_ID = $uporabnik_id
                              AND n.Rok <= DATE_ADD(CURDATE(), INTERVAL 1 WEEK)
                              ORDER BY n.Rok ASC";
                      $result = $link->query($sql);
                  
                      if ($result->num_rows > 0) {
                          echo '<table class="table">';
                          echo '<thead>';
                          echo '<tr>';
                          echo '<th scope="col">#</th>';
                          echo '<th scope="col">Naslov</th>';
                          echo '<th scope="col">Opis</th>';
                          echo '<th scope="col">Rok</th>';
                          echo '</tr>';
                          echo '</thead>';
                          echo '<tbody>';
                          $stevilcenje = 1;
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
                              echo '<th scope="row">' . $stevilcenje . '</th>';
                              echo '<td><a href="#">' . $naslov . '</a></td>';
                              echo '<td>' . $opis . '</td>';
                              echo '<td>' . $rok . '</td>';
                              echo '</tr>';
                              $stevilcenje++;
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
</body>
</html>
