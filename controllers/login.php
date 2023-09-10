<?php
          include '../links/db.php';

          if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        else{
            header("Location: ../index.php");
    
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

         $stmt = $link->prepare("SELECT * FROM Uporabniki WHERE Email = ? AND Geslo = ?");
          $stmt->bind_param("ss", $email, $hash);
          $stmt->execute();
          $stmt->bind_result($id, $ime, $priimek, $vloga, $geslo,$email);
          $stmt->close();

          echo 'id';
          exit();
        ?>