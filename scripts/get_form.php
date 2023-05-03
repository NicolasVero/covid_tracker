<?php 

    function get_form_1($date_d, $date_f) {

        ?>
        
        <section id="container-date-period" class="container-date">
        <form action="index.php" method="POST">
            <label>Données calculées sur la période allant du </label>
            <input type="date" value="<?php echo $date_d ?>" min="2020-03-18" max="2022-11-09" id="date_d" name="date_d">
            <label> au </label>
            <input type="date" value="<?php echo $date_f ?>" min="2020-03-19" max="2022-11-10" id="date_f" name="date_f">
        
            <input type="submit" value="Re-calculer">
        </form>
        </section>

        <?php
    }

    function get_form_2($date_s) {

        ?>
        
        <section id="container-date-week" class="container-date">
        <form action="index.php" method="POST">
            <label>Données calculées jusqu'à la semaine </label>
            <input type="week" value="<?php echo $date_s ?>" min="2021-W01" max="2022-W44" id="date_s" name="date_s">

            <input type="submit" value="Re-calculer">
        </form>
        </section>

        <?php
    }

?>


