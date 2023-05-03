<?php

    function give_total_contamination($bdd) {
        $requete = $bdd -> prepare("SELECT SUM(pos) as pos FROM sae303_table_indicateurs_64 WHERE date BETWEEN ? AND ?");
        $requete -> execute(array('2020-03-18', '2022-11-10'));

        return generate_separator($requete -> fetch()['pos']);
    }

    function give_total_death($bdd) {
        $requete = $bdd -> prepare("SELECT dchosp FROM sae303_table_indicateurs_64 WHERE date = '2022-11-10'");
        $requete -> execute();

        return generate_separator($requete -> fetch()['dchosp']);
    }

    function generate_separator($n) {
        $n_to_string = strval($n);
        $s = "";

        for($i = 0; $i < strlen($n_to_string); $i++) {
            if($i % 3 == 0 && $i != 0)
                $s .= " ";
            
            $s .= $n_to_string[$i];
        }

        return $s;
    }

    function get_sliding_average($data) {

	    // Permet de decaller la moyenne glissante pour qu'elle soit alignee avec l'autre courbe
        $averages = array("","","","");

        for($i = 5; $i < count($data) - 5; $i++) {
            $average = 0;

            for($j = -2; $j < 2; $j++)   
                $average += $data[$i + $j];
            
            $averages[] = $average / 5; 
        }

        return $averages;
    }

    function formate_string($str) {
        return str_replace('W', '', $str);
    }


    function give_data_shart1($bdd, $date_d = '2020-03-18', $date_f = '2022-11-10') {

        $donnees_date         = array();
        $donnees_hosp         = array();
        $donnees_incid_dchosp = array();
     
        $requete = $bdd -> prepare("SELECT date, incid_dchosp, hosp FROM sae303_table_indicateurs_64 WHERE date BETWEEN ? AND ?");
        $requete -> execute(array($date_d, $date_f));
        
        while($donnee = $requete -> fetch()) {
            $donnees_date[]         = $donnee['date'        ]; 
            $donnees_hosp[]         = $donnee['hosp'        ]; 
            $donnees_incid_dchosp[] = $donnee['incid_dchosp']; 
        }

        // return ['date' => $donnees_date, 'hosp' => $donnees_hosp, 'incid_dchosp' => $donnees_incid_dchosp];
        return ['date' => $donnees_date, 'hosp' => $donnees_hosp, 'incid_dchosp' => get_sliding_average($donnees_incid_dchosp)];
    }


    function give_data_shart2($bdd, $date_d = '2020-03-18', $date_f = '2022-11-10') {

        $date      = array();
        $rea       = array();
        $incid_rea = array();

        $requete = $bdd -> prepare("SELECT date, hosp, rea FROM sae303_table_indicateurs_64 WHERE date BETWEEN ? AND ?");
        $requete -> execute(array($date_d, $date_f));

        while($donnee = $requete -> fetch()) {
            $date[] = $donnee['date'];
            $rea[]  = $donnee['rea' ];
            $hosp[] = $donnee['hosp'];
        }

        return ['date' => $date, 'rea' => $rea, 'hosp' => $hosp];
    }


    function give_data_shart3($bdd, $date_s = '2022-44') {

        $effectif_cumu_1_inj = array();
        $type_vaccin         = array();

        $requete = $bdd -> prepare("SELECT type_vaccin, effectif_cumu_1_inj FROM sae303_vaccination WHERE type_vaccin != 'Tout vaccin' AND classe_age = 'TOUT_AGE' AND semaine_injection = ?");
        $requete -> execute(array(formate_string($date_s)));

        while($donnee = $requete -> fetch()) {
            $effectif_cumu_1_inj[] = $donnee['effectif_cumu_1_inj'];
            $type_vaccin[]         = $donnee['type_vaccin'        ];
        }

        return ['effectif_cumu_1_inj' => $effectif_cumu_1_inj, 'type_vaccin' => $type_vaccin];
    }

    
    function give_data_shart4($bdd, $date_s = '2022-44') {

        $donnees_classe_age            = array();
        $donnees_effectif_cumu_termine = array();
        $donnees_effectif_1_inj        = array();

        $requete = $bdd -> prepare("SELECT libelle_classe_age, effectif_cumu_1_inj, effectif_cumu_termine FROM sae303_vaccination WHERE type_vaccin = 'Tout vaccin' AND classe_age != 'TOUT_AGE' AND semaine_injection = ?");
        $requete -> execute(array(formate_string($date_s)));

        while($donnee = $requete -> fetch()) {
            $donnees_classe_age[]            = $donnee['libelle_classe_age'   ];
            $donnees_effectif_cumu_termine[] = $donnee['effectif_cumu_termine'];
            $donnees_effectif_1_inj[]        = $donnee['effectif_cumu_1_inj'  ];
        }

        return ['libelle_classe_age' => $donnees_classe_age, 'effectif_cumu_1_inj' => $donnees_effectif_1_inj, 'effectif_cumu_termine' => $donnees_effectif_cumu_termine]; 
    }
    
?>