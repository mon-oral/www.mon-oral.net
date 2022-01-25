<?php
if (Auth::user() and Auth::user()->is_admin == 0){
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
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-2px;">admin</div>
					</div>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<!-- Authentication Links -->
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }} <span class="caret"></span>
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
						</ul>
					</div>
				</div>
			</nav>

			<div class="container">

				<?php
				//$capsules = File::allFiles(storage_path().'/app/public/audio-capsules/sfokasnejd');
				$entrainements = File::allFiles(storage_path().'/app/public/audio-entrainements/lrpxmensjw');

				$nb_total_utilisateurs = App\User::count();
				$nb_total_entrainements = App\Entrainement::count();
				$nb_total_activites = App\Activite::count();
				$nb_total_sujets = App\Sujet::count();
				$nb_total_capsules = App\Logs_capsule::where('duration', '>', 10)->count() + 10000;
				$nb_total_entrainements_enregistrements = App\Log::where('code_audio', '!=', '')->count();
				$nb_total_activites_enregistrements = App\Activites_enregistrement::count();

				//$utilisateurs = App\User::where('is_checked', '=', '2')->get();
				?>

				<div class="row mt-4">
					<div class="col-md-12">
						<div class="text-muted">Utilisateurs : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_utilisateurs }}<span></div>
						<div class="text-muted">Entraînements : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_entrainements }}<span></div>
						<div class="text-muted">Activités : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_activites }}<span></div>
						<div class="text-muted">Sujets : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_sujets }}<span></div>
						<div class="text-muted">Enregistrements entraînements : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_entrainements_enregistrements }}<span></div>
						<div class="text-muted">Enregistrements activités : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_activites_enregistrements }}<span></div>
						<div class="text-muted">Enregistrements capsules : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_capsules }}<span></div>
						<div class="text-muted">Total enregistrements : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_capsules + $nb_total_entrainements_enregistrements +$nb_total_activites_enregistrements }}<span></div>
						<br />
						<br />
					</div>
				</div>

				<div>
					<?php
					$start_week    = new DateTime('01-04-2020');
					$end_week      = (new DateTime('NOW'));
					$interval_week = new DateInterval('P1W');
					$period_week   = new DatePeriod($start_week, $interval_week, $end_week);

					/*
					$start    = new DateTime('01-04-2020');
					$end      = (new DateTime('NOW'));
					$interval = new DateInterval('P1D');
					$period   = new DatePeriod($start, $interval, $end);
					*/


					// INSCRIPTIONS
					$inscriptions = App\User::orderBy('created_at')->get()->groupBy(function($item) {
						return $item->created_at->format('Y-W');
					});
					$inscriptions_data = [];
					foreach ($period_week as $dt) {
						if (!empty($inscriptions[$dt->format("Y-W")])) {
							$inscriptions_data[] = '{t:"' . $dt->format("Y-W") . '",y:' . $inscriptions[$dt->format("Y-W")]->count() . '}';
						} else {
							$inscriptions_data[] = '{t:"' . $dt->format("Y-W") . '",y:0}';
						}
					}
					$chart_inscriptions_data = "[" . implode(",", $inscriptions_data) . "]";


					// ENTRAINEMENTS
					$entrainements = App\Entrainement::orderBy('created_at')->get()->groupBy(function($item) {
						return $item->created_at->format('Y-W');
					});
					$entrainements_data = [];
					foreach ($period_week as $dt) {
						if (!empty($entrainements[$dt->format("Y-W")])) {
							$entrainements_data[] = '{t:"' . $dt->format("Y-W") . '",y:' . $entrainements[$dt->format("Y-W")]->count() . '}';
						} else {
							$entrainements_data[] = '{t:"' . $dt->format("Y-W") . '",y:0}';
						}
					}
					$chart_entrainements_data = "[" . implode(",", $entrainements_data) . "]";


					// ENTRAINEMENTS - ENREGISTREMENTS
					$entrainements_enregistrements = App\Log::where('code_audio', '!=', '')->orderBy('created_at')->get()->groupBy(function($item) {
						return $item->created_at->format('Y-W');
					});
					$entrainements_enregistrements_data = [];
					foreach ($period_week as $dt) {
						if (!empty($entrainements_enregistrements[$dt->format("Y-W")])) {
							$entrainements_enregistrements_data[] = '{t:"' . $dt->format("Y-W") . '",y:' . $entrainements_enregistrements[$dt->format("Y-W")]->count() . '}';
						} else {
							$entrainements_enregistrements_data[] = '{t:"' . $dt->format("Y-W") . '",y:0}';
						}
					}
					$chart_entrainements_enregistrements_data = "[" . implode(",", $entrainements_enregistrements_data) . "]";


					// ACTIVITES - ENREGISTREMENTS
					$activites_enregistrements = App\Activites_enregistrement::where('code_audio', '!=', '')->orderBy('created_at')->get()->groupBy(function($item) {
						return $item->created_at->format('Y-W');
					});
					$activites_enregistrements_data = [];
					foreach ($period_week as $dt) {
						if (!empty($activites_enregistrements[$dt->format("Y-W")])) {
							$activites_enregistrements_data[] = '{t:"' . $dt->format("Y-W") . '",y:' . $activites_enregistrements[$dt->format("Y-W")]->count() . '}';
						} else {
							$activites_enregistrements_data[] = '{t:"' . $dt->format("Y-W") . '",y:0}';
						}
					}
					$chart_activites_enregistrements_data = "[" . implode(",", $activites_enregistrements_data) . "]";


					// CAPSULES
					$capsules = App\Logs_capsule::where('duration', '>', 10)->orderBy('created_at')->get()->groupBy(function($item) {
						return $item->created_at->format('Y-W');
					});
					$capsules_data = [];
					foreach ($period_week as $dt) {
						if (!empty($capsules[$dt->format("Y-W")])) {
							$capsules_data[] = '{t:"' . $dt->format("Y-W") . '",y:' . $capsules[$dt->format("Y-W")]->count() . '}';
						} else {
							$capsules_data[] = '{t:"' . $dt->format("Y-W") . '",y:0}';
						}
					}
					$chart_capsules_data = "[" . implode(",", $capsules_data) . "]";

					?>

					<canvas id="chart_inscriptions"></canvas>
					<canvas id="chart_entrainements"></canvas>
					<canvas id="chart_entrainements_enregistrements"></canvas>
					<canvas id="chart_activites_enregistrements"></canvas>
					<canvas id="chart_capsules"></canvas>

					<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
					<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
					<script>
						var config_inscriptions = {
							type:'line',
							data:{
								datasets:[
									{
										data: <?php echo $chart_inscriptions_data; ?>,
										backgroundColor: 'rgb(56, 193, 114)',
										borderColor: 'rgb(56, 193, 114)',
										borderWidth:1,
										pointRadius:1,
									}
								]
							},
							options: {
								responsive:true,
								title:{
									display:true,
									text:"INCRIPTIONS"
								},
								legend:{
									display:false
								},
								scales:{
									xAxes:[{
										type:"time",
										time:{
											parser:'YYYY-WW',
											displayFormats:{
												week: 'YYYY-MM-DD'
											},
											unit:'week'
										},
									}],
									yAxes: [{
										scaleLabel: {
											display:true,
											labelString:'nombre d\'inscriptions'
										}
									}]
								}
							}
						};
					</script>

					<script>
						var config_entrainements = {
							type:'line',
							data:{
								datasets:[
									{
										data: <?php echo $chart_entrainements_data; ?>,
										backgroundColor: 'rgb(56, 193, 114)',
										borderColor: 'rgb(56, 193, 114)',
										borderWidth:1,
										pointRadius:1,
									}
								]
							},
							options: {
								responsive:true,
								title:{
									display:true,
									text:"ENTRAÎNEMENTS"
								},
								legend:{
									display:false
								},
								scales:{
									xAxes:[{
										type:"time",
										time:{
											parser:'YYYY-WW',
											displayFormats:{
												week: 'YYYY-MM-DD'
											},
											unit:'week'
										},
									}],
									yAxes: [{
										scaleLabel: {
											display:true,
											labelString:'nombre d\'entraînements'
										}
									}]
								}
							}
						};
					</script>

					<script>
						var config_entrainements_enregistrements = {
							type:'line',
							data:{
								datasets:[
									{
										data: <?php echo $chart_entrainements_enregistrements_data; ?>,
										backgroundColor: 'rgb(56, 193, 114)',
										borderColor: 'rgb(56, 193, 114)',
										borderWidth:1,
										pointRadius:1,
									}
								]
							},
							options: {
								responsive:true,
								title:{
									display:true,
									text:"ENTRAINEMENTS ENREGISTREMENTS"
								},
								legend:{
									display:false
								},
								scales:{
									xAxes:[{
										type:"time",
										time:{
											parser:'YYYY-WW',
											displayFormats:{
												week: 'YYYY-MM-DD'
											},
											unit:'week'
										},
									}],
									yAxes: [{
										scaleLabel: {
											display:true,
											labelString:'nombre d\'enregistrements'
										}
									}]
								}
							}
						};
					</script>

					<script>
						var config_activites_enregistrements = {
							type:'line',
							data:{
								datasets:[
									{
										data: <?php echo $chart_activites_enregistrements_data; ?>,
										backgroundColor: 'rgb(56, 193, 114)',
										borderColor: 'rgb(56, 193, 114)',
										borderWidth:1,
										pointRadius:1,
									}
								]
							},
							options: {
								responsive:true,
								title:{
									display:true,
									text:"ACTIVITES ENREGISTREMENTS"
								},
								legend:{
									display:false
								},
								scales:{
									xAxes:[{
										type:"time",
										time:{
											parser:'YYYY-WW',
											displayFormats:{
												week: 'YYYY-MM-DD'
											},
											unit:'week'
										},
									}],
									yAxes: [{
										scaleLabel: {
											display:true,
											labelString:'nombre d\'enregistrements'
										}
									}]
								}
							}
						};
					</script>

					<script>
						var config_capsules = {
							type:'line',
							data:{
								datasets:[
									{
										data: <?php echo $chart_capsules_data; ?>,
										backgroundColor: 'rgb(56, 193, 114)',
										borderColor: 'rgb(56, 193, 114)',
										borderWidth:1,
										pointRadius:1,
									}
								]
							},
							options: {
								responsive:true,
								title:{
									display:true,
									text:"CAPSULES"
								},
								legend:{
									display:false
								},
								scales:{
									xAxes:[{
										type:"time",
										time:{
											parser:'YYYY-WW',
											displayFormats:{
												week: 'YYYY-MM-DD'
											},
											unit:'week'
										},
									}],
									yAxes: [{
										scaleLabel: {
											display:true,
											labelString:'nombre de capsules'
										}
									}]
								}
							}
						};
					</script>

					<script>
						window.onload = function () {
							var ctx_inscriptions = document.getElementById("chart_inscriptions").getContext("2d");
							var ctx_entrainements = document.getElementById("chart_entrainements").getContext("2d");
							var ctx_entrainements_enregistrements = document.getElementById("chart_entrainements_enregistrements").getContext("2d");
							var ctx_activites_enregistrements = document.getElementById("chart_activites_enregistrements").getContext("2d");
							var ctx_capsules = document.getElementById("chart_capsules").getContext("2d");
							window.chart_inscriptions = new Chart(ctx_inscriptions, config_inscriptions);
							window.chart_entrainements = new Chart(ctx_entrainements, config_entrainements);
							window.chart_entrainements_enregistrements = new Chart(ctx_enregistrements, config_entrainements_enregistrements);
							window.chart_activites_enregistrements = new Chart(ctx_enregistrements, config_activites_enregistrements);
							window.chart_capsules = new Chart(ctx_capsules, config_capsules);
						};
					</script>

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom-js')

	</body>
</html>
