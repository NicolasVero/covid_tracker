<?php

    // Si aucune date renseignee, alors prend toute la periode
    if(!isset($_SESSION['date_d'])) {
        $_SESSION['date_d'] = '2020-03-18';
        $_SESSION['date_f'] = '2022-11-10';
        $_SESSION['date_s'] = '2022-W44';
    }

    if(isset($_POST['date_d'])) {
        $_SESSION['date_d'] = $_POST['date_d'];
        $_SESSION['date_f'] = $_POST['date_f'];
    }
    
    if(isset($_POST['date_s'])) {
        $_SESSION['date_s'] = $_POST['date_s'];
    }

    
?>