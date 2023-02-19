<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Capsule Audio - Vérification</title>

	</head>

	<body>

		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light mt-2">
				<div class="container">
				<div>
						<div class="float-left"><img src="{{ asset('img/mon-oral.svg') }}" width="40" /></div>
						<div class="float-left text-monospace small pl-3" style="color:#c5c7c9;">Capsule Audio<br />Vérification</div>
					</div>
				</div>
			</nav>

			<div class="container">

				<div class="row mt-5">

					<div class="col-md-6 offset-md-3">

						<audio controls style="width:100%"><source src="/capsule-verifier-ecoute" type="audio/mpeg"></audio>
						<p class="m-0 p-0 text-monospace text-center small" style="color:silver;">attendre quelques secondes que le lecteur se charge</p>

						<form method="POST" action="{{ route('capsule-sauvegarder-post')}}">

							@csrf

							<p class="text-center mt-5">
								<button type="submit" class="btn btn-primary pl-4 pr-4" data-toggle="tooltip" data-placement="top" title="sauvegarder et partager cet enregistrement"><i class="fas fa-save"></i></button>
								<a class="btn btn-light ml-3 mr-3" href="/capsule" role="button" data-toggle="tooltip" data-placement="top" title="refaire l'enregistrement"><i class="fas fa-sync-alt"></i></a>
								<a class="btn btn-dark" href="/capsule-quitter" role="button" data-toggle="tooltip" data-placement="top" title="quitter"><i class="fas fa-times"></i></a>
							</p>
						</form>

					</div>

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom-js')

	</body>
</html>
