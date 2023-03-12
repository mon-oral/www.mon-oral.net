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
				$nb_days = 7;			
				$entrainements = App\Entrainement::where('entrainements.updated_at', '>', now()->subDays($nb_days)->endOfDay())
					->join('users', 'users.id', '=', 'entrainements.user_id')
					->get(['users.name', 'users.email', 'users.etablissement', 'users.is_checked', 'users.is_valid'])
					->toArray();
				$activites = App\Activite::where('activites.updated_at', '>', now()->subDays($nb_days)->endOfDay())
					->join('users', 'users.id', '=', 'activites.user_id')
					->get(['users.name', 'users.email', 'users.etablissement', 'users.is_checked', 'users.is_valid'])				
					->toArray();
				$commentaires = App\Commentaire::where('commentaires.updated_at', '>', now()->subDays($nb_days)->endOfDay())
					->join('users', 'users.id', '=', 'commentaires.user_id')
					->get(['users.name', 'users.email', 'users.etablissement', 'users.is_checked', 'users.is_valid'])				
					->toArray();

				$connexions_merge = array_merge($entrainements, $activites, $commentaires);
				$connexions = array_unique($connexions_merge, SORT_REGULAR);
				$email = array_column($connexions, 'email');
				array_multisort($email, SORT_ASC, $connexions);
				?>
					
				<div class="row mt-4">
					<div class="col-md-12 small text-monospace">
						<table class="table table-bordered table-hover">
							@foreach ($connexions as $connexion)
							@if ($connexion['is_checked'] != 0)
							@if (preg_match('(@ac-|@aefe|@AEFE)', $connexion['email']) !== 1)
							@if (count(array_keys($connexions_merge, $connexion)) > 1)
							@if (!in_array($connexion['email'], [
								'cyril.vinot@mlfmonde.org',
								'laura.jambou@mfr.asso.fr',
								'llemaitre@lfelsalvador.org',
								'nicolas.ducasse@lyceemermozdakar.org',
								'pierre.lanquetin@stanislas.qc.ca',
								'samira.bouacheria@liad-alger.fr',
							]))
							<tr @if ($connexion['is_valid'] !== NULL OR $connexion['is_checked'] == 3) class="text-danger" @endif>
								<td>{{count(array_keys($connexions_merge, $connexion))}}</td>
								<td>{{$connexion['name']}}</td>
								<td>{{$connexion['email']}}</td>
								<td>{{$connexion['etablissement']}}</td>
								<td>{{$connexion['is_checked']}}</td>
								<td>{{$connexion['is_valid']}}</td>
							</tr>
							@endif
							@endif
							@endif
							@endif
							@endforeach
						</table>
						
					</div>
				</div>
								
			</div><!-- /container -->
			
		</div><!-- /app -->

		<br />
		<br />
		
		@include('inc-bottom-js')
		
	</body>
</html>