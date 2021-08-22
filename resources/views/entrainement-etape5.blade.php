<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Entraînement - Étape 5</title>

	</head>
		
	<body>	
	
		<div class="p-2 mb-3 text-monospace text-center text-danger" style="color:#d9ae00;background-color:#f1c40f">
			<i class="fas fa-chevron-circle-right pr-2"></i>ne rechargez pas cette page - ne revenez pas en arrière<i class="fas fa-chevron-circle-left pl-2"></i>
		</div>		
	
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Entraînement - Étape 5</div>
					</div>
				</div>
			</nav>		
		
			<div class="container">
									
				<div class="row mt-5">
				
					<div class="col-md-6 offset-md-3">
			
						<table>
							<tr style="line-height:10px">
								<td style="font-size:150%;"><i class="fas fa-volume-up mr-4 text-dark"></i></td>
								<td style="width:100%">
									<audio controls style="width:100%"><source src="/entrainement-lecteur" type="audio/mpeg"></audio>
								</td>
								<td><a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-entrainement/{{session()->get('code_entrainement')}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
								</td>								
							</tr>
							<tr>
								<td></td>
								<td style="width:100%">
									<p class="mt-1 p-0 text-monospace text-center small" style="color:silver;">attendez quelques secondes que le lecteur se charge</p>
								</td>
								<td></td>
							</tr>							
							<!--
							<tr>
								<td class="pt-4" style="font-size:150%"><i class="fas fa-link mr-4 text-muted"></i></td>
								<td class="pt-4"><input class="form-inline form-control text-monospace" value="{{ url('/') . '/entrainement/' . session()->get('code_entrainement') }}" readonly /></td>
							</tr>
							-->
							<tr>
								<td class="pt-4" style="font-size:150%;color:#e74c3c"><i class="fas fa-exclamation-circle"></i></td>
								<td class="pt-4 text-muted" colspan="2"><div class="alert alert-danger" role="alert"><b>Vous ne pourrez pas revenir sur cette page.</b> Seuls les enseignants peuvent écouter vos enregistrements. Si vous souhaitez conserver votre enregistrement, téléchargez-le.</div></td>
							</tr>								
						</table>
						
						<p class="text-center mt-4">
							<a class="btn btn-dark" href="{{ url('/') }}" role="button"><i class="fas fa-times pr-2"></i>fermer cette page</a>
						</p>						

					</div>

				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		<!-- {{ session()->get('code_entrainement') }} -->
		
	</body>
</html>