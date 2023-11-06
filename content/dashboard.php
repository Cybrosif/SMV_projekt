<?php
include '../session_start.php';
    if(isset($_SESSION['user_vloga']))
        if($_SESSION['user_vloga'] == 'Administrator' || $_SESSION['user_vloga'] == 'Profesor')
            echo '<script>window.location.href = "../views/home.php?page=classes";</script>';
 ?>
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

        .gumb:hover {
            background-color: white;
        }
    </style>
</head>
    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <!-- Modal content goes here -->
                </div>
            </div>
    </div>

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
                            echo '<li class="text2"><a href="../views/home.php?page=classes-specific-student&razredID= '.$row['Razred_ID'].'">' . $ime_razreda . '</a></li>';
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

                    $sql = "SELECT n.Naslov, n.Rok, r.Ime_razreda, r.Razred_ID, n.Naloga_ID, sn.Student_Naloga_ID 
                    FROM naloge AS n
                    INNER JOIN uporabniki_razredi AS ur ON n.Razred_ID = ur.Razred_ID
                    LEFT JOIN student_naloge AS sn ON n.Naloga_ID = sn.Naloga_ID AND sn.Student_ID = $uporabnik_id
                    INNER JOIN razredi AS r ON n.Razred_ID = r.Razred_ID 
                    WHERE ur.Uporabnik_ID = $uporabnik_id
                    AND n.Rok >= CURDATE()
                    AND sn.Student_Naloga_ID IS NULL
                    AND naloge.Visible = 1
                    ORDER BY n.Rok ASC";

            


                
                    $result = $link->query($sql);
                    if (!$result) {
                        die("Error: " . $link->error);
                    }
                    if ($result->num_rows > 0) {
                        echo '<table class="table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col"></th>';
                        echo '<th scope="col" class="text2">Naslov</th>';
                        echo '<th scope="col" class="text2">Predmet</th>';
                        echo '<th scope="col" class="text2">Rok oddaje</th>';
                        echo '<th scope="col" class="text2"></th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = $result->fetch_assoc()) {
                            $rok = $row["Rok"];
                            $naslov = $row["Naslov"];
                            $datum_roka = strtotime($rok);
                            $student_naloga_id = $row["Student_Naloga_ID"];
                            
                        
                            if ($datum_roka < strtotime("today")) {
                                echo '<tr class="rok-potekel">';
                            } else {
                                echo '<tr>';
                            }
                            echo '<th scope="row" ></th>';
                            echo '<td class="text3">' . $naslov . '</td>';
                            echo '<td class="text3"><a href="../views/home.php?page=classes-specific-student&razredID= '.$row['Razred_ID'].'">' . $row['Ime_razreda'] . '</a></td>';
                            echo '<td class="text3">' . date('d.m.Y', $datum_roka) . '</td>';
                            echo '<td class="text3"><button class="btn btn-primary submit" data-nalogaid="' . $row['Naloga_ID'] . '">Oddaj</button></td>';
                           
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "Ni rezultatov.";
                    }
                } else {
                    echo "Uporabnik ni prijavljen.";
                }
                
                $link->close();
            ?>



        </div>
       </div>
    </div>

<script>
    $(document).ready(function() {
        $('table').on('click', '.submit', function(){
            var nalogaId = $(this).data('nalogaid');     
            $.ajax({
                type: 'POST',
                url: '../modal/upload-file-student.php', 
                data: { nalogaId: nalogaId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    console.log(nalogaId);
                }
            });
        });
    });
</script>
