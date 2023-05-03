<?php
    
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=sae303','root','');
        // $bdd = new PDO('mysql:host=localhost;dbname=db-veronic','usr-veronic','9pIyUVIl3X');
    } catch (Exception $e) { die('Erreur : ' . $e->getMessage()); }		

?>