<?php
use Carbon\Carbon; // si vous voulez utiliser Carbon (facultatif)

if (Auth::user() && Auth::user()->is_admin == 0) {
    exit; // Empêche les non-admin d'accéder à cette page
}
?>
<!doctype html>
<html lang="fr">
<head>
    @include('inc-meta') 
    <!-- Include vos meta, CSS, etc. -->
    <title>Console - Admin (Statistiques par Année)</title>
</head>
<body>
<div id="app">
    <!-- Navbar / Menu admin (optionnel) -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/mon-oral.png') }}" width="40" alt="Logo"/>
            </a>
            <span class="text-monospace small" style="color:#c5c7c9;">admin</span>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @if (Auth::check())
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" 
                       role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-1" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        // -------------------------------------------------------------------------------------
        // 1) Quelques statistiques globales (inchangées) :
        // -------------------------------------------------------------------------------------
        $nb_total_utilisateurs = App\User::count();
        $nb_total_entrainements = App\Entrainement::count();
        $nb_total_activites = App\Activite::count();
        $nb_total_sujets = App\Sujet::count();
        $nb_total_entrainements_enregistrements = App\Log::where('code_audio', '!=', '')->count();
        $nb_total_activites_enregistrements = App\Activites_enregistrement::count();
        $nb_total_commentaires_enregistrements = App\Commentaire::count();
        $nb_total_capsules_enregistrements = App\Logs_capsule::count() + 10000; // +10000 d'après votre code

        $total_enregistrements = $nb_total_capsules_enregistrements
                               + $nb_total_commentaires_enregistrements
                               + $nb_total_entrainements_enregistrements
                               + $nb_total_activites_enregistrements;
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="text-muted">Utilisateurs : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_utilisateurs }}</span>
                </div>
                <div class="text-muted">Entraînements : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_entrainements }}</span>
                </div>
                <div class="text-muted">Activités : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_activites }}</span>
                </div>
                <div class="text-muted">Sujets : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_sujets }}</span>
                </div>
                <div class="text-muted">Enregistrements entraînements : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_entrainements_enregistrements }}</span>
                </div>
                <div class="text-muted">Enregistrements activités : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_activites_enregistrements }}</span>
                </div>
                <div class="text-muted">Enregistrements commentaires : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_commentaires_enregistrements }}</span>
                </div>
                <div class="text-muted">Enregistrements capsules : 
                    <span class="badge badge-pill badge-success">{{ $nb_total_capsules_enregistrements }}</span>
                </div>
                <div class="text-muted">Total enregistrements : 
                    <span class="badge badge-pill badge-success">{{ $total_enregistrements }}</span>
                </div>
            </div>
        </div>

        <hr/>

        <?php
        // -------------------------------------------------------------------------------------
        // 2) On définit une période en années
        // -------------------------------------------------------------------------------------
        $start_year    = new DateTime('2020-01-01');  // début de vos stats
        $end_year      = new DateTime('NOW');         // aujourd'hui
        $interval_year = new DateInterval('P1Y');     // 1 an
        $period_year   = new DatePeriod($start_year, $interval_year, $end_year);

        // -------------------------------------------------------------------------------------
        // 3) Petite fonction pour générer les data {t:"YYYY", y: N}
        // -------------------------------------------------------------------------------------
        function buildYearlyData($modelClass, $start, $period, $dateFormat = '%Y')
        {
            $counts = [];

            // GROUP BY année : ex. SELECT DATE_FORMAT(created_at, '%Y') AS year_number, COUNT(id) ...
            $collection = $modelClass::selectRaw("DATE_FORMAT(created_at, '$dateFormat') AS year_number, COUNT(id) AS id_count")
                ->groupBy('year_number')
                ->get();

            // On construit un tableau associatif : [ "2020" => 123, "2021" => 45, ... ]
            $collection->each(function($item) use (&$counts) {
                $counts[$item->year_number] = $item->id_count;
            });

            // On prépare la sortie pour Chart.js
            $result = [];
            foreach ($period as $dt) {
                $yearKey = $dt->format("Y"); // ex: "2023"
                $val = isset($counts[$yearKey]) ? $counts[$yearKey] : 0;
                $result[] = '{t:"'.$yearKey.'",y:'.$val.'}';
            }

            return "[" . implode(",", $result) . "]";
        }

        // -------------------------------------------------------------------------------------
        // 4) Création des data sets pour chaque entité / stat
        // -------------------------------------------------------------------------------------
        // Inscriptions (User)
        $chart_inscriptions_data = buildYearlyData(App\User::class, $start_year, $period_year);

        // Entraînements
        $chart_entrainements_data = buildYearlyData(App\Entrainement::class, $start_year, $period_year);

        // Activités
        $chart_activites_data = buildYearlyData(App\Activite::class, $start_year, $period_year);

        // Enregistrements d'entraînements (Logs)
        $chart_entrainements_enregistrements_data = buildYearlyData(App\Log::class, $start_year, $period_year);

        // Enregistrements d'activités
        $chart_activites_enregistrements_data = buildYearlyData(App\Activites_enregistrement::class, $start_year, $period_year);

        // Enregistrements de commentaires
        $chart_commentaires_enregistrements_data = buildYearlyData(App\Commentaire::class, $start_year, $period_year);

        // Enregistrements de capsules
        $chart_capsules_enregistrements_data = buildYearlyData(App\Logs_capsule::class, $start_year, $period_year);
        ?>

        <!-- -----------------------------------------------------------------------------------
             5) Les <canvas> pour chaque graphique
        ------------------------------------------------------------------------------------- -->
        <canvas id="chart_inscriptions"></canvas>
        <canvas id="chart_entrainements"></canvas>
        <canvas id="chart_activites"></canvas>
        <canvas id="chart_entrainements_enregistrements"></canvas>
        <canvas id="chart_activites_enregistrements"></canvas>
        <canvas id="chart_commentaires_enregistrements"></canvas>
        <canvas id="chart_capsules_enregistrements"></canvas>

        <!-- -----------------------------------------------------------------------------------
             6) Script JS pour Chart.js
        ------------------------------------------------------------------------------------- -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script>
            // INSCRIPTIONS
            var config_inscriptions = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_inscriptions_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"INSCRIPTIONS PAR ANNÉE"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY',           // parse le champ t:"2023"
                                displayFormats:{
                                    year:'YYYY'         // affiche "2023"
                                },
                                unit:'year'              // groupement = année
                            }
                        }],
                        yAxes:[{
                            scaleLabel:{
                                display:true,
                                labelString:'Nombre d\'inscriptions'
                            }
                        }]
                    }
                }
            };

            // ENTRAINEMENTS
            var config_entrainements = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_entrainements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENTRAÎNEMENTS PAR ANNÉE"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY',
                                displayFormats:{
                                    year:'YYYY'
                                },
                                unit:'year'
                            }
                        }],
                        yAxes:[{
                            scaleLabel:{
                                display:true,
                                labelString:'Nombre d\'entraînements'
                            }
                        }]
                    }
                }
            };

            // ACTIVITÉS
            var config_activites = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_activites_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ACTIVITÉS PAR ANNÉE"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY',
                                displayFormats:{
                                    year:'YYYY'
                                },
                                unit:'year'
                            }
                        }],
                        yAxes:[{
                            scaleLabel:{
                                display:true,
                                labelString:'Nombre d\'activités'
                            }
                        }]
                    }
                }
            };

            // ENREGISTREMENTS ENTRAINEMENTS
            var config_entrainements_enregistrements = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_entrainements_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS D'ENTRAÎNEMENTS PAR ANNÉE"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY',
                                displayFormats:{
                                    year:'YYYY'
                                },
                                unit:'year'
                            }
                        }],
                        yAxes:[{
                            scaleLabel:{
                                display:true,
                                labelString:'Nombre d\'enregistrements'
                            }
                        }]
                    }
                }
            };

            // ENREGISTREMENTS ACTIVITÉS
            var config_activites_enregistrements = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_activites_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS D'ACTIVITÉS PAR ANNÉE"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY',
                                displayFormats:{
                                    year:'YYYY'
                                },
                                unit:'year'
                            }
                        }],
                        yAxes:[{
                            scaleLabel:{
                                display:true,
                                labelString:'Nombre d\'enregistrements'
                            }
                        }]
                    }
                }
            };

            // ENREGISTREMENTS COMMENTAIRES
            var config_commentaires_enregistrements = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_commentaires_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS DE COMMENTAIRES PAR ANNÉE"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY',
                                displayFormats:{
                                    year:'YYYY'
                                },
                                unit:'year'
                            }
                        }],
                        yAxes:[{
                            scaleLabel:{
                                display:true,
                                labelString:'Nombre de commentaires'
                            }
                        }]
                    }
                }
            };

            // ENREGISTREMENTS CAPSULES
            var config_capsules_enregistrements = {
                type: 'line',
                data: {
                    datasets: [{
                        data: <?php echo $chart_capsules_enregistrements_data; ?>,
                        backgroundColor: 'rgb(56, 193, 114)',
                        borderColor: 'rgb(56, 193, 114)',
                        borderWidth:1,
                        pointRadius:1
                    }]
                },
                options: {
                    responsive:true,
                    title:{
                        display:true,
                        text:"ENREGISTREMENTS DE CAPSULES PAR ANNÉE"
                    },
                    legend:{
                        display:false
                    },
                    scales:{
                        xAxes:[{
                            type:"time",
                            time:{
                                parser:'YYYY',
                                displayFormats:{
                                    year:'YYYY'
                                },
                                unit:'year'
                            }
                        }],
                        yAxes:[{
                            scaleLabel:{
                                display:true,
                                labelString:'Nombre de capsules'
                            }
                        }]
                    }
                }
            };

            // -----------------------------------------------------------------------------------
            // 7) Initialisation des charts
            // -----------------------------------------------------------------------------------
            window.onload = function () {
                // Sélection de chaque canvas + création du chart correspondant
                var ctx_inscriptions = document.getElementById("chart_inscriptions").getContext("2d");
                window.chart_inscriptions = new Chart(ctx_inscriptions, config_inscriptions);

                var ctx_entrainements = document.getElementById("chart_entrainements").getContext("2d");
                window.chart_entrainements = new Chart(ctx_entrainements, config_entrainements);

                var ctx_activites = document.getElementById("chart_activites").getContext("2d");
                window.chart_activites = new Chart(ctx_activites, config_activites);

                var ctx_entrainements_enregistrements = document.getElementById("chart_entrainements_enregistrements").getContext("2d");
                window.chart_entrainements_enregistrements = new Chart(ctx_entrainements_enregistrements, config_entrainements_enregistrements);

                var ctx_activites_enregistrements = document.getElementById("chart_activites_enregistrements").getContext("2d");
                window.chart_activites_enregistrements = new Chart(ctx_activites_enregistrements, config_activites_enregistrements);

                var ctx_commentaires_enregistrements = document.getElementById("chart_commentaires_enregistrements").getContext("2d");
                window.chart_commentaires_enregistrements = new Chart(ctx_commentaires_enregistrements, config_commentaires_enregistrements);

                var ctx_capsules_enregistrements = document.getElementById("chart_capsules_enregistrements").getContext("2d");
                window.chart_capsules_enregistrements = new Chart(ctx_capsules_enregistrements, config_capsules_enregistrements);
            };
        </script>
    </div><!-- /container -->
</div><!-- /app -->

@include('inc-bottom-js') 
<!-- Vos scripts supplémentaires si besoin -->
</body>
</html>
