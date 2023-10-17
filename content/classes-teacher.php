<?php
include '../session_start.php';
include '../../db.php';
include '../functions/check_if_teacher.php';
$sql = "SELECT * FROM razredi JOIN ucitelji_razredi ON razredi.Razred_ID = ucitelji_razredi.Razred_ID WHERE ucitelji_razredi.Ucitelj_ID = {$_SESSION['user_id']}";
$result = mysqli_query($link, $sql);
 
?>

<style>
      .hover:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
</style>

<div class="container text-center">
    <h3 class="mb-4 text-1">Moji predmeti</h3>
    <div class="row row-cols-3">
    <?php
       
        if (mysqli_num_rows($result) > 0) {
            
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col mb-3">
                    <div class="container hover" data-razredId="<?php echo $row['Razred_ID']?>">
                        <?php echo $row['Ime_razreda']; ?>
                    </div>
                </div>
                <?php
            }
        } else {
            
            echo "Ne učite nobenega razreda :(";
        }

        mysqli_close($link);
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('.container.hover').on('click', function() {
            var razredID = $(this).data('razredid');
            var redirectURL = '../views/home.php?page=classes-specific-teacher.php&razredID=' + razredID;

            window.location.href = redirectURL;
            
        });
    });
</script>
