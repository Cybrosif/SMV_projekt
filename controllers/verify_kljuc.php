<?php
     $razredId = $_GET['razred_id'];
     $providedKljucVpisa = $_GET['kljucVpisa'];
         
     // Fetch the Kljuc Vpisa from the database for the specific razred
     $sql = "SELECT Kljuc_Vpisa FROM Razredi WHERE Razred_ID = ?";
     $stmt = $link->prepare($sql);
     $stmt->bind_param("i", $razredId);
     $stmt->execute();
     $result = $stmt->get_result();
     $razred = $result->fetch_assoc();
         
     if ($razred && $razred['Kljuc_Vpisa'] == $providedKljucVpisa) {
         echo "Pravilni kljuc vpisa"; 
     } else {
         echo "Napacni Kljuc Vpisa!";
     }
?>