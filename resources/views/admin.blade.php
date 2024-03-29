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
				$utilisateurs = App\User::where('is_checked', '=', '1')->get();

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
					<div class="col-md-3">
						<div class="text-muted">Utilisateurs : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_utilisateurs }}<span></div>
						<div class="text-muted">Entraînements : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_entrainements }}<span></div>
						<div class="text-muted">Activités : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_activites }}<span></div>
						<div class="text-muted">Sujets : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_sujets }}<span></div>
						<div class="text-muted">Enr. entraînements : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_entrainements_enregistrements }}<span></div>
						<div class="text-muted">Enr. activités : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_activites_enregistrements }}<span></div>
						<div class="text-muted">Enr. commentaires : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_commentaires_enregistrements }}<span></div>
						<div class="text-muted">Enr. capsules : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_capsules_enregistrements }}<span></div>
						<div class="text-muted">Total enr. : <span class="badge badge-pill badge-success" style="padding-bottom:1px;">{{ $nb_total_capsules_enregistrements + $nb_total_commentaires_enregistrements + $nb_total_entrainements_enregistrements +$nb_total_activites_enregistrements }}<span></div>
						<br />
						<br />
					</div>
					
					<div class="col-md-9">
				
						<div class="">
							<table>
							<?php
							$n = 1;
							foreach($utilisateurs as $utilisateur) {
								?>
								<tr>
									<td valign="top" class="pb-4 pt-1">
										<a class="btn btn-success" href="/admin/compte_accepter/{{$utilisateur -> id}}" role="button"><i class="fa fa-check" aria-hidden="true"></i></a>
									</td>
									<td valign="top" class="pb-4 pt-1">	
										<a class="btn btn-danger ml-2" href="/admin/compte_refuser/{{$utilisateur -> id}}" role="button"><i class="fa fa-times" aria-hidden="true"></i></a>
									</td>
									<td valign="top" class="pb-4 pl-2">
										<span class="text-muted">{{$utilisateur -> name}}</span><br />
										<b>{{$utilisateur -> email}}</b>
									</td>
								</tr>
								<?php
							}
							?>
							</table>

														
						</div>				
						
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 pt-5">
					<?php
					/*

						$stats = App\Stat::select('log')->get();
								
						
						$date_minus7 = Carbon\Carbon::today()->subDays(7);
						$last7days = App\Stat::where('created_at', '>=', $date_minus7)->get();
						$last7days_count = $last7days->count();
						echo 'Since ' . $date_minus7 . ' : ' . $last7days_count;

						echo '<table class="small table table-bordered">';
						foreach ($stats as $stat) {
							echo '<tr>';
							$items = json_decode($stat->log);
							foreach ($items as $item) {
								echo '<td>'.substr($item,0,30).'</td>';	
							}
							echo '</tr>';
						}
						echo '</table>';
					*/
					?>
					</div>
				</div>				
				
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')
		
	</body>
</html>