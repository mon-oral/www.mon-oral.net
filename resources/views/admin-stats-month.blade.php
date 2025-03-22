<?php
use Carbon\Carbon; // si vous préférez utiliser Carbon plutôt que DateTime

if (Auth::user() && Auth::user()->is_admin == 0) {
    exit;
}
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta')
    <title>Console - Admin</title>
</head>
<body>
<div id="app">

    <!-- Votre navbar et autres éléments -->

    <div class="container">

        <?php
        // Quelques stats globales (inchangées)
        $nb_total_utilisateurs = App\User::count();
        $nb_total_entrainements = App\Entrainement::count();
        $nb_total_activites = App\Activite::count();
        $nb_total_sujets = App\Sujet::count();
        $nb_total_entrainements_enregistrements = App\Log::where('code_audio', '!=', '')->count();
        $nb_total_activites_enregistrements = App\Activites_enregistrement::count();
        $nb_total_commentaires_enregistrements = App\Commentaire::count();
        $nb_total_capsules_enregistrements = App\Logs_capsule::count() + 10000;
        ?>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="text-muted">Utilisateurs : <span class="badge badge-pill badge-success">{{ $nb_total_utilisateurs }}</span></div>
                <div class="text-muted">Entraînements : <span class="badge badge-pill badge-success">{{ $nb_total_entrainements }}</span></div>
                <div class="text-muted">Activités : <span class="badge badge-pill badge-success">{{ $nb_total_activites }}</span></div>
                <div class="text-muted">Sujets : <span class="badge badge-pill badge-success">{{ $nb_total_sujets }}</span></div>
                <div class="text-muted">Enregistrements entraînements : <span class="badge badge-pill badge-success">{{ $nb_total_entrainements_enregistrements }}</span></div>
                <div class="text-muted">Enregistrements activités : <span class="badge badge-pill badge-success">{{ $nb_total_activites_enregistrements }}</span></div>
                <div class="text-muted">Enregistrements commentaires : <span class="badge badge-pill badge-success">{{ $nb_total_commentaires_enregistrements }}</span></div>
                <div class="text-muted">Enregistrements capsules : <span class="badge badge-pill badge-success">{{ $nb_total_capsules_enregistrements }}</span></div>
                <div class="text-muted">Total enregistrements : 
                    <span class="badge badge-pill badge-success">
                        {{ $nb_total_capsules_enregistrements 
                           + $nb_total_commentaires_enregistrements 
                           + $nb_total_entrainements_enregistrements
                           + $nb_total_activites_enregistrements }}
                    </span>
                </div>
                <br /><br />
            </div>
        </div>

        <div>
        <?php
        // ======================
        //  A) CHOIX DE LA PÉRIODE
        // ======================
        // Remplacez l'intervalle en semaines (P1W) par un intervalle en mois (P1M)

        $start_month    = new DateTime('2020-04-01');  // Exemple de date de début
        $end_month      = new DateTime('NOW');
        $interval_month = new DateInterval('P1M');     // 1 mois
        $period_month   = new DatePeriod($start_month, $interval_month, $end_month);

        // ======================
        //  B) FONCTION UTILE
        // ======================
        // Petite fonction qui génère un tableau de points (t, y) pour un dataset Chart.js
        // selon un regroupement mensuel
        function buildMonthlyData($modelClass, $start, $period, $dateFormat='%Y-%m') {
            // 1) Récupération des données groupées par mois
            $counts = [];
            // On attend que $modelClass soit un modèle Eloquent (App\User, App\Entrainement, etc.)
            $collection = $modelClass::selectRaw("DATE_FORMAT(created_at, '$dateFormat') AS month_number, COUNT(id) AS id_count")
                ->groupBy("month_number")
                ->get();
            // On stocke dans un tableau associatif, ex: ['2023-08' => 123, ...]
            $collection->each(function($item) use (&$counts){
                $counts[$item->month_number] = $item->id_count;
            });

            // 2) Construire la liste d'objets {t: 'YYYY-MM', y: X}
            $result = [];
            foreach ($period as $dt) {
                $key = $dt->format("Y-m");   // ex. "2023-08"
                $val = isset($counts[$key]) ? $counts[$key] : 0;
                $result[] = '{t:"'.$key.'",y:'.$val.'}';
            }

            return "[" . implode(",", $result) . "]";
        }

        // ======================
        //  C) CRÉATION DES DATASETS
        // ======================

        // -- INSCRIPTIONS
        $chart_inscriptions_data = buildMonthlyData(App\User::class, $start_month, $period_month, '%Y-%m');

        // -- ENTRAINEMENTS
        $chart_entrainements_data = buildMonthlyData(App\Entrainement::class, $start_month, $period_month, '%Y-%m');

        // -- ACTIVITÉS
        $chart_activites_data = buildMonthlyData(App\Activite::class, $start_month, $period_month, '%Y-%m');

        // -- ENTRAINEMENTS - ENREGISTREMENTS
        $chart_entrainements_enregistrements_data = buildMonthlyData(App\Log::class, $start_month, $period_month, '%Y-%m');

        // -- ACTIVITÉS - ENREGISTREMENTS
        $chart_activites_enregistrements_data = buildMonthlyData(App\Activites_enregistrement::class, $start_month, $period_month, '%Y-%m');

        // -- COMMENTAIRES - ENREGISTREMENTS
        $chart_commentaires_enregistrements_data = buildMonthlyData(App\Commentaire::class, $start_month, $period_month, '%Y-%m');

        // -- CAPSULES - ENREGISTREMENTS
        $chart_capsules_enregistrements_data = buildMonthlyData(App\Logs_capsule::class, $start_month, $period_month, '%Y-%m');
        ?>

        <!-- Les canvases -->
        <canvas id="chart_inscriptions"></canvas>
        <canvas id="chart_entrainements"></canvas>
        <canvas id="chart_activites"></canvas>
        <canvas id="chart_entrainements_enregistrements"></canvas>
        <canvas id="chart_activites_enregistrements"></canvas>
        <canvas id="chart_commentaires_enregistrements"></canvas>
        <canvas id="chart_capsules_enregistrements"></canvas>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

        <script>
            // Exemple : config pour Inscriptions / Mois
            var config_inscriptions = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_inscriptions_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1,
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"INSCRIPTIONS PAR MOIS"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY-MM',
                                displayFormats:{
                                    month: 'YYYY-MM'
                                },
                                unit:'month'
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display:true,
                                labelString:'Nombre d\'inscriptions'
                            }
                        }]
                    }
                }
            };

            // Adaptez chaque config pour vos autres datasets
            var config_entrainements = {
                type:'line',
                data:{
                    datasets:[{
                        data: <?php echo $chart_entrainements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1,
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENTRAÎNEMENTS PAR MOIS"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY-MM',
                                displayFormats:{
                                    month: 'YYYY-MM'
                                },
                                unit:'month'
                            },
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display:true,
                                labelString:'Nombre d\'entraînements'
                            }
                        }]
                    }
                }
            };

            var config_activites = {
                type:'line',
                data:{
                    datasets:[{
                        data: <?php echo $chart_activites_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1,
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ACTIVITÉS PAR MOIS"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY-MM',
                                displayFormats:{
                                    month: 'YYYY-MM'
                                },
                                unit:'month'
                            },
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display:true,
                                labelString:'Nombre d\'activités'
                            }
                        }]
                    }
                }
            };

            var config_entrainements_enregistrements = {
                type:'line',
                data:{
                    datasets:[{
                        data: <?php echo $chart_entrainements_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1,
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS D'ENTRAÎNEMENTS PAR MOIS"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY-MM',
                                displayFormats:{
                                    month: 'YYYY-MM'
                                },
                                unit:'month'
                            },
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display:true,
                                labelString:'Nombre d\'enregistrements'
                            }
                        }]
                    }
                }
            };

            var config_activites_enregistrements = {
                type:'line',
                data:{
                    datasets:[{
                        data: <?php echo $chart_activites_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1,
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS D'ACTIVITÉS PAR MOIS"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY-MM',
                                displayFormats:{
                                    month: 'YYYY-MM'
                                },
                                unit:'month'
                            },
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display:true,
                                labelString:'Nombre d\'enregistrements'
                            }
                        }]
                    }
                }
            };

            var config_commentaires_enregistrements = {
                type:'line',
                data:{
                    datasets:[{
                        data: <?php echo $chart_commentaires_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1,
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS DE COMMENTAIRES PAR MOIS"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY-MM',
                                displayFormats:{
                                    month: 'YYYY-MM'
                                },
                                unit:'month'
                            },
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display:true,
                                labelString:'Nombre de commentaires'
                            }
                        }]
                    }
                }
            };

            var config_capsules_enregistrements = {
                type:'line',
                data:{
                    datasets:[{
                        data: <?php echo $chart_capsules_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1,
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS DE CAPSULES PAR MOIS"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY-MM',
                                displayFormats:{
                                    month: 'YYYY-MM'
                                },
                                unit:'month'
                            },
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display:true,
                                labelString:'Nombre de capsules'
                            }
                        }]
                    }
                }
            };

            window.onload = function () {
                var ctx_inscriptions = document.getElementById("chart_inscriptions").getContext("2d");
                var ctx_entrainements = document.getElementById("chart_entrainements").getContext("2d");
                var ctx_activites = document.getElementById("chart_activites").getContext("2d");
                var ctx_entrainements_enregistrements = document.getElementById("chart_entrainements_enregistrements").getContext("2d");
                var ctx_activites_enregistrements = document.getElementById("chart_activites_enregistrements").getContext("2d");
                var ctx_commentaires_enregistrements = document.getElementById("chart_commentaires_enregistrements").getContext("2d");
                var ctx_capsules_enregistrements = document.getElementById("chart_capsules_enregistrements").getContext("2d");

                window.chart_inscriptions = new Chart(ctx_inscriptions, config_inscriptions);
                window.chart_entrainements = new Chart(ctx_entrainements, config_entrainements);
                window.chart_activites = new Chart(ctx_activites, config_activites);
                window.chart_entrainements_enregistrements = new Chart(ctx_entrainements_enregistrements, config_entrainements_enregistrements);
                window.chart_activites_enregistrements = new Chart(ctx_activites_enregistrements, config_activites_enregistrements);
                window.chart_commentaires_enregistrements = new Chart(ctx_commentaires_enregistrements, config_commentaires_enregistrements);
                window.chart_capsules_enregistrements = new Chart(ctx_capsules_enregistrements, config_capsules_enregistrements);
            };
        </script>
        </div>

    </div><!-- /container -->

</div><!-- /app -->

@include('inc-bottom-js')
</body>
</html>
