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
				$nb_days = 30;			
				$entrainements = App\Entrainement::where('entrainements.updated_at', '>', now()->subDays($nb_days)->endOfDay())
					->join('users', 'users.id', '=', 'entrainements.user_id')
					->get(['users.name', 'users.email', 'users.etablissement', 'entrainements.updated_at'])
					->map(function ($item) {
						$item['type'] = 'entrainement';
						return $item;
				  	})
					->toArray();
				$activites = App\Activite::where('activites.updated_at', '>', now()->subDays($nb_days)->endOfDay())
					->join('users', 'users.id', '=', 'activites.user_id')
					->get(['users.name', 'users.email', 'users.etablissement', 'activites.updated_at'])
					->map(function ($item) {
						$item['type'] = 'activite';
						return $item;
				  	})					
					->toArray();
				$commentaires = App\Commentaire::where('commentaires.updated_at', '>', now()->subDays($nb_days)->endOfDay())
					->join('users', 'users.id', '=', 'commentaires.user_id')
					->get(['users.name', 'users.email', 'users.etablissement', 'commentaires.updated_at'])
					->map(function ($item) {
						$item['type'] = 'commentaire';
						return $item;
				  	})					
					->toArray();

				$connexions = array_merge($entrainements, $activites, $commentaires);
				$email = array_column($connexions, 'email');
				array_multisort($email, SORT_ASC, $connexions);
				?>
					
				<div class="row mt-4">
					<div class="col-md-12 small text-monospace">
						<table>
							@foreach ($connexions as $connexion)
							@if (strpos($connexion['email'], '@ac-') == false)
							<tr>
								<td>{{$connexion['name']}}</td>
								<td>{{$connexion['email']}}</td>
								<td>{{$connexion['etablissement']}}</td>
								<td>{{$connexion['type']}}</td>
								<td>{{substr($connexion['updated_at'], 0, 10)}}</td>
							</tr>
							@endif
							@endforeach
						</table>
						
					</div>
				</div>
								
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')
		
	</body>
</html>