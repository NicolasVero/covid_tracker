<script>

    // Graphique n°1 
    //? Nombre de contaminés / deces par jour

    new Chart(document.getElementById("chart_1"), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($data_shart1['date']); ?>,
            datasets: [{ 
                data: <?php echo json_encode($data_shart1['hosp']); ?>,
                label: "Nombre de personnes hospitalisées",
                borderColor: "#3e95cd",
                fill: false,
                yAxisID: 'y1'
            }, { 
                data: <?php echo json_encode($data_shart1['incid_dchosp']); ?>,
                label: "Nombre de decès",
                borderColor: "#8e5ea2",
                fill: false,
                yAxisID: 'y2'
            }]
        },
        options: {
            scales: {
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                },
                y2: {
                    type: 'linear',
                    display: true,
                    position: 'right',

                    grid: {
                        drawOnChartArea: false, 
                    },
                }
            },
            elements: {
                point: {
                    radius: 0
                },
                line: {
                    tension: 0.2
                }
            }
        }
    });


    // Graphique n°2
    //? Nombre de personne admisent a l'hopital et le nombre de reanimations

    new Chart(document.getElementById("chart_2"), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($data_shart2['date']) ?>,
            datasets: [{
                label: "Nombre de personnes admisent en réanimation",
                type: "line",
                borderColor: "#8e5ea2",
                data: <?php echo json_encode($data_shart2['rea']) ?>,
                fill: false
            }, {
                label: "Nombre de personnes hospitalisées",
                type: "bar",
                backgroundColor: "rgba(0,0,0,0.2)",
                data: <?php echo json_encode($data_shart2['hosp']) ?>,
            }
        ]
        },
        options: {
            title: {
                display: true,
                text: 'Population growth (millions): Europe & Africa'
            },
            legend: { display: false },
            elements: {
                point: {
                    radius: 0
                },
                line: {
                    tension: 0.2
                }
            }
        }
    });
   

    // Graphique n°3 
    //?Nombre de personnes ayant été vaccinées et avec quel type de vaccin

    new Chart(document.getElementById("chart_3"), {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($data_shart3['type_vaccin']) ?>,
            datasets: [{
                label: "Nombre de personnes ayant été vaccinées et avec quel type de vaccin (1ère dose)",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                data: <?php echo json_encode($data_shart3['effectif_cumu_1_inj']) ?>
            }]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
            }
        }
    });


    // Graphique n°4
    //? Nombre de gens s'étant fait vacciner en fonction de leur tranche d'age

    new Chart(document.getElementById("chart_4"), {
        type: 'radar',
        data: {
            labels: <?php echo json_encode($data_shart4['libelle_classe_age']) ?>,
            datasets: [{
                label: "Schéma vaccinal complet",
                fill: true,
                backgroundColor: "rgba(179,181,198,0.2)",
                borderColor: "rgba(179,181,198,1)",
                pointBorderColor: "#fff",
                pointBackgroundColor: "rgba(179,181,198,1)",
                data: <?php echo json_encode($data_shart4['effectif_cumu_termine']) ?>
            },{
                label: "1ère dose reçue",
                fill: true,
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointBackgroundColor: "rgba(255,99,132,1)",
                data: <?php echo json_encode($data_shart4['effectif_cumu_1_inj']) ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Nombre de gens s\'étant fait vacciner en fonction de leur tranche d\'age'
            }
        }
    });


</script>