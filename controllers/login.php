<?php
        include '../../db.php';
        include '../session_start.php';


        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        else{
            header("Location: ../index.php");
    
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $link->prepare("SELECT id, ime, priimek, geslo, vloga FROM Uporabniki WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $ime, $priimek, $hashedPassword, $vloga);
        $stmt->fetch();
        $stmt->close();
          
          if(password_verify($password, $hashedPassword)){
            $_SESSION['prijavljen'] = true;
            $_SESSION['user_id'] = $id;
            $_SESSION['user_ime'] = $ime;
            $_SESSION['user_priimek'] = $priimek;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_vloga'] = $vloga;

            header("Location: ../views/home.php?page=dashboard");
          }
          else{
            $_SESSION['prijavljen'] = false;
            $_SESSION['user_id'] = "";
            $_SESSION['user_ime'] = "";
            $_SESSION['user_priimek'] = "";
            $_SESSION['user_email'] = "";
            $_SESSION['user_vloga'] = "";

            header("Location: ../index.php");
          }
          exit();
        ?>