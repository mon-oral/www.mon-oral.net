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
									
				<div class="row mt-5 text-center">
					<div class="col-md-6 offset-md-3">
						<div class="mb-2 text-danger">Vérifiez votre enregistrement avant de l'envoyer</div>
						<audio controls style="width:100%"><source src="/activite-etape-verifier-ecoute" type="audio/mpeg"></audio>
						<p class="m-0 p-0 text-monospace small" style="color:silver">attendez quelques secondes que le lecteur se charge</p>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-4 offset-md-4 text-center">
						<div class="row">
							<div class="col-md-12 p-2">
								<a class="btn btn-success d-block" href="/activite-etape-sauvegarder" role="button"><i class="fas fa-check mr-1"></i> envoyer cet enregistrement à l'enseignant</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 p-2">
								<a class="btn btn-light d-block" href="/activite-etape-refaire" role="button"><i class="fas fa-sync-alt align-middle mr-1"></i> refaire l'enregistrement</a>
							</div>
							<div class="col-md-4 p-2">
								<a class="btn btn-dark d-block" href="/activite-etape-quitter" role="button"><i class="fas fa-times align-middle mr-1"></i> quitter</a>
							</div>
						</div>
					</div>
				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')	
		
	</body>
</html>