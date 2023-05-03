<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Covid Tracker | Pyrénées-Atlantiques</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?php
        
        session_start();

        include 'scripts/connect_bdd.php';
        include 'scripts/get_data.php';
        include 'scripts/get_date.php';

        $total_contamination = give_total_contamination($bdd);
        $total_death = give_total_death($bdd);

    ?>
    
    <h1>Données liées au covid dans la région des Pyrénées-Atlantiques</h1>
    <p>Depuis le début de la pandémie, dans ce département, <?php echo $total_contamination ?> personnes ont été contaminées et <?php echo $total_death ?> sont décédées.</p>

    <section id="main-container">

        <?php 

            // Création des différents canvas et leurs formulaires
            include 'scripts/get_form.php';
            include 'scripts/get_charts_text.php';

            for($i = 1; $i < 5; $i++) {
                if($i == 1) echo get_form_1($_SESSION['date_d'], $_SESSION['date_f']);
                if($i == 3) echo get_form_2($_SESSION['date_s']); 
                
                echo '<section id="section_chart_' . $i . '">';
                echo '<canvas id="chart_' . $i . '">Désolé, votre navigateur ne prend pas en charge &lt;canvas&gt;.</canvas>';
                echo '<div class="infos_button"><p>+</p><span data-descr="' . $textes[$i - 1] . '"></span></div>';
                echo '</section>';

            }

        ?>
    
    </section>      

    <?php
    
        // Récuperation des données
        $data_shart1 = give_data_shart1($bdd, $_SESSION['date_d'], $_SESSION['date_f']);
        $data_shart2 = give_data_shart2($bdd, $_SESSION['date_d'], $_SESSION['date_f']);
        $data_shart3 = give_data_shart3($bdd, $_SESSION['date_s']);
        $data_shart4 = give_data_shart4($bdd, $_SESSION['date_s']);

        include 'scripts/draw_graphics.php';
       
    ?>

</body>
</html>