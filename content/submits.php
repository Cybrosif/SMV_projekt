<?php
    include '../../db.php';
    include '../session_start.php';

    if(isset($_GET['Naloga_ID'])) {
        $taksId = $_GET['Naloga_ID'];
    }
?>

<h1 class='text-center primary-text'>Oddaje</h1>
<div class="container">
<table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text2">#</th>
                        <th scope="col" class="text2">Email učenca</th>
                        <th scope="col" class="text2">Ime in prrimek</th>
                        <th scope="col" class="text2">Datum oddaje</th>
                        <th scope="col" class="text2"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                   $sql = "SELECT uporabniki.Email, uporabniki.Ime, uporabniki.Priimek, MAX(student_naloge.Datum_Oddaje) AS Latest_Submission_Date
                   FROM student_naloge
                   JOIN naloge ON student_naloge.Naloga_ID = naloge.Naloga_ID
                   JOIN uporabniki ON student_naloge.Student_ID = uporabniki.ID
                   LEFT JOIN gradiva ON naloge.Gradiva_ID = gradiva.Gradivo_ID
                   WHERE student_naloge.Naloga_ID = $taksId
                   GROUP BY uporabniki.Email, uporabniki.Ime, uporabniki.Priimek";
           
                    $result = mysqli_query($link, $sql);
                    $i = 1;
                    if ($result) {
                        
                        while ($row = mysqli_fetch_assoc($result)) {           
                            echo "<tr>"; 
                            echo "<td>".$i."</td>";
                            echo "<td>".$row['Email']."</td>";
                            echo "<td>".$row['Ime'].' '. $row['Priimek']."</td>";
                            echo "<td>".$row['Latest_Submission_Date']."</td>";
                            echo "<td><button class='btn btn-primary download-files' data-taskid='".$taksId."' data-email='".$row['Email']."'>Naloži oddaje</button></td>";
                            echo "</tr>";
                        }
                    
                        // Free the result set
                        mysqli_free_result($result);
                    } else {
                        // Handle query error
                        echo "Error: " . mysqli_error($link);
                    }
                ?>
                </tbody>
            </table>
</div>

<script>
    $(document).ready(function() {
    $('.download-files').on('click', function() {
        var taskId = $(this).data('taskid');
        var email = $(this).data('email');

        window.location.href = '../controllers/download-submits.php?email=' + email + '&taskId=' + taskId;

    });
});


</script>
