<?php
include '../session_start.php';
include '../../db.php';
//include '../functions/check_if_teacher.php';
if(!isset($_SESSION['user_vloga']))
    echo '<script type="text/javascript">window.location.href = "../functions/logout.php";</script>';
else if($_SESSION['user_vloga'] == 'Administrator' || $_SESSION['user_vloga'] == 'administrator')
    $sql = "SELECT * FROM razredi JOIN ucitelji_razredi ON razredi.Razred_ID = ucitelji_razredi.Razred_ID WHERE ucitelji_razredi.Ucitelj_ID = {$_SESSION['user_id']}";
else if($_SESSION['user_vloga'] == 'Profesor' || $_SESSION['user_vloga'] == 'profesor')
    $sql = "SELECT * FROM razredi JOIN ucitelji_razredi ON razredi.Razred_ID = ucitelji_razredi.Razred_ID WHERE ucitelji_razredi.Ucitelj_ID = {$_SESSION['user_id']}";
else if($_SESSION['user_vloga'] == 'Dijak' || $_SESSION['user_vloga'] == 'dijak')
    $sql = "SELECT razredi.* FROM razredi JOIN uporabniki_razredi ON razredi.Razred_ID = uporabniki_razredi.Razred_ID WHERE uporabniki_razredi.Uporabnik_ID = {$_SESSION['user_id']}";

$result = mysqli_query($link, $sql);
 
?>

<style>
      .hover:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
</style>
<div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
                    <!-- Modal content goes here -->
        </div>
    </div>
</div>
<h1 class='text-center primary-text my-4'>Moji predmeti</h1>
<div class="container text-center shadow-none bg-transparent">
    
    <div class="row row-cols-3">
    <?php
       
        if (mysqli_num_rows($result) > 0) {
            
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col mb-3" style="position: relative;">
                            <div class="container hover pointer" data-razredid="<?php echo htmlspecialchars($row['Razred_ID']); ?>">
                                <?php echo htmlspecialchars($row['Ime_razreda']); ?>
                            </div>
                            <?php
                            if ($_SESSION['user_vloga'] == 'Dijak') {
                                echo '<span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger hover pointer pointer-badge" data-razredid="' . htmlspecialchars($row['Razred_ID']) . '">
                                        <i class="bi bi-trash"></i>
                                        <span class="visually-hidden">unread messages</span>
                                    </span>';
                            }
                            ?>
                        </div>


                <?php
            }
        } else {
            
            if(!isset($_SESSION['user_vloga']))
                echo '<script type="text/javascript">window.location.href = "../functions/logout.php";</script>';
            else if($_SESSION['user_vloga'] == 'Administrator' || $_SESSION['user_vloga'] == 'administrator')
                echo "Ne učite nobenega predmeta.";
            else if($_SESSION['user_vloga'] == 'Profesor' || $_SESSION['user_vloga'] == 'profesor')
                echo "Ne učite nobenega predmeta.";
            else if($_SESSION['user_vloga'] == 'Dijak' || $_SESSION['user_vloga'] == 'dijak')
                echo "Niste prijavljeni v noben predmet.";
        }

        ?>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('.container.hover').on('click', function() {
            var razredID = $(this).data('razredid');
            var userRole = "<?php echo $_SESSION['user_vloga']; ?>"; // Assuming you have a PHP variable for user role
            console.log(userRole);
        if (userRole === "Dijak") {
            var redirectURL = '../views/home.php?page=classes-specific-student&razredID=' + razredID;
            window.location.href = redirectURL;
        } else if (userRole === "Profesor") {
            var redirectURL = '../views/home.php?page=classes-specific-teacher&razredID=' + razredID;
            window.location.href = redirectURL;
        } else if (userRole === "Administrator"){
            var redirectURL = '../views/home.php?page=classes-specific-teacher&razredID=' + razredID;
            window.location.href = redirectURL;
        }
    });

        $('.pointer-badge').on('click', function() {
            var classId = $(this).data('razredid');     
            $.ajax({
                type: 'POST',
                url: '../modal/leave-class-modal.php', 
                data: { classId: classId },
                success: function(response){
                    $('#editUserModal .modal-content').html(response);
                    $('#editUserModal').modal('show');
                    $('#editUserModal .modal-dialog').removeClass('modal');
                }
            });
        });

    });
</script>
