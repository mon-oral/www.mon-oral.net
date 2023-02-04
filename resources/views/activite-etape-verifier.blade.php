<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Activité - Vérification</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Activité - Vérification</div>
					</div>
				</div>
			</nav>		
		
			<div class="container">
									
				<div class="row mt-5">
				
					<div class="col-md-6 offset-md-3 text-center">
			
						<audio controls style="width:100%"><source src="/activite-etape-verifier-ecoute" type="audio/mpeg"></audio>
						<p class="m-0 p-0 text-monospace text-center small" style="color:silver">attendez quelques secondes que le lecteur se charge</p>
						<p class="mt-5">
							<a class="btn btn-success" href="/activite-etape-sauvegarder" role="button" data-toggle="tooltip" data-placement="top" title="conserver cet enregistrement"><i class="fas fa-save align-middle"></i></a>
							<a class="btn btn-light ml-2 mr-2" href="/activite-etape-refaire" role="button" data-toggle="tooltip" data-placement="top" title="refaire l'enregistrement"><i class="fas fa-sync-alt align-middle"></i></a>
							<a class="btn btn-dark" href="/activite-etape-quitter" role="button" data-toggle="tooltip" data-placement="top" title="quitter"><i class="fas fa-times align-middle"></i></a>
						</p>

					</div>

				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')	
		
	</body>
</html>