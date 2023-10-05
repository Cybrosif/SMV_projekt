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
    <form method="post" action="">
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
                        <select style="border:none" name="vloga[' . $row['ID'] . ']">
                            <option value="uporabnik" ' . ($row['Vloga'] == 'uporabnik' ? 'selected' : '') . '>Uporabnik</option>
                            <option value="Učitelj" ' . ($row['Vloga'] == 'Učitelj' ? 'selected' : '') . '>Učitelj</option>
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
<script>
</script>
<style>
    .col{
        border:1px solid black;
        border-radius: 5px;
        margin:5px;
    }
</style>





