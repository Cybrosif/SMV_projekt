<?php
    include '../functions/check_if_admin.php';
    include '../session_start.php';
    include '../../db.php';
?>
<h1 class='text-center primary-text'>Upravljanje uporabnikov</h1>
<body>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Ime</th>
        <th scope="col">Priimek</th>
        <th scope="col">Vloga</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <form method="post" action="" id="myForm">
        <?php
            $user_id = $_SESSION['user_id'];
            $i = 1;
            $query = "SELECT * FROM Uporabniki WHERE  ID != $user_id";
            $result = mysqli_query($link, $query);   
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $row['Ime'] . '</td>
                    <td>' . $row['Priimek'] . '</td>
                    <td>
                        <input type="hidden" name="user_id[]" value="'.$row['ID'].'">
                        <select style="border:none" name="vloga[]">
                            <option value="učenec" ' . ($row['Vloga'] == 'učenec' ? 'selected' : '') . '>Dijak</option>
                            <option value="učitelj" ' . ($row['Vloga'] == 'učitelj' ? 'selected' : '') . '>Profesor</option>
                        </select>
                    </td>
                    <td>
                    </td>
                    </tr>
                ';
                $i++;
            }
            
        ?>
        <button type="submit" class="btn btn-primary">Shrani</button>
        </form>
    </tbody>
    </table>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').on('submit', function(event){
            event.preventDefault(); // Prevent the default form submission
            var formData = $(this).serialize(); // Serialize form data
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: '../controllers/user_administration.php', // Replace 'processing.php' with your actual PHP processing file
                data: formData,
                success: function(response){
                    // Handle the response from the server if needed
                    //console.log(response);
                }
            });
        });
    });
</script>

<style>
    .col{
        border:1px solid black;
        border-radius: 5px;
        margin:5px;
    }
</style>





