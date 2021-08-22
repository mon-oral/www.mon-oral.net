<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Entraînement - Inactif</title>
		
	</head>
	
	<body>	
	
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
					</div>
				</div>
			</nav>
		
			<div class="container">
									
				<div class="row mt-5">
				
					<div class="col-md-6 offset-md-3">
						<div class="alert alert-light" role="alert">
							<p class="text-center p-4">Cet entraînement n'est plus disponible.</p>
							</ul>
							<p class="text-center"><a class="btn btn-primary btn-sm" href="{{ url('/') }}" role="button"><i class="fas fa-arrow-left align-middle pr-2"></i>retour</a></p>
						</div>
					</div>

				</div>
		
			</div><!-- /container -->
		</div><!-- /app -->
		
	</body>
</html>