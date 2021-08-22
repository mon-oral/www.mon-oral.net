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
				
					<div class="col-md-6 offset-md-3">
			
						<table>
							<tr>
								<td style="font-size:150%"><i class="fas fa-volume-up mr-4 text-muted"></i></td>
								<td class="pt-4" style="width:100%">
									<audio controls style="width:100%"><source src="/activite-etape-verifier-ecoute" type="audio/mpeg"></audio>
									<p class="m-0 p-0 text-monospace text-center small" style="color:silver">attendez quelques secondes que le lecteur se charge</p>
								</td>							
							</tr>													
						</table>
						
						<p class="text-center mt-5">
							<a class="btn btn-success btn-sm mr-3" href="/activite-etape-sauvegarder" role="button"><i class="fas fa-save align-middle pr-2"></i>conserver cet enregistrement</a>
							<a class="btn btn-primary btn-sm mr-3" href="/activite-etape-refaire" role="button"><i class="fas fa-sync-alt align-middle pr-2"></i>refaire l'enregistrement</a>
							<a class="btn btn-dark btn-sm" href="/activite-etape-quitter" role="button"><i class="fas fa-times align-middle pr-2"></i>quitter</a>
						</p>

					</div>

				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')	
		
	</body>
</html>