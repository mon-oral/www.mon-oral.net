<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Commentaire Audio - Sauvegarde</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Commentaire Audio - Sauvegarde</div>
					</div>
				</div>
			</nav>		
		
			<div class="container">
									
				<div class="row mt-5">
				
					<div class="col-md-6 offset-md-3">
					
						<h2 class="mb-4">{{ session()->get('commentaire_titre') }}</h2>
			
						<table>
							<tr style="line-height:10px">
								<td style="font-size:150%;"><i class="fas fa-volume-up mr-4 text-dark"></i></td>
								<td style="width:100%">
									<audio controls style="width:100%"><source src="/console/commentaire-sauvegarder-ecoute" type="audio/mpeg"></audio>
								</td>
								<td><a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-commentaire/{{session()->get('code_commentaire')}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
								</td>									
							</tr>
							<tr>
								<td></td>
								<td style="width:100%">
									<p class="mt-1 p-0 text-monospace text-center small" style="color:silver;">attendez quelques secondes que le lecteur se charge</p>
								</td>
								<td></td>
							</tr>							
							<tr>
								<td class="pt-4" style="font-size:150%"><i class="fas fa-link mr-4 text-muted"></i></td>
								<td class="pt-4" style="width:100%">
								Lien à conserver : <a href="https://www.mon-oral.net/c/{{ session()->get('code_commentaire') }}" target="_blank">mon-oral.net/c/{{ session()->get('code_commentaire') }}</a>
								</td>
							</tr>
							<tr>
								<td class="pt-4" style="font-size:180%"><i class="fas fa-qrcode mr-4 text-muted"></i></td>
								<td class="pt-4"style="width:100%">QR code à conserver : <img src="https://api.qrserver.com/v1/create-qr-code/?data={{urlencode('mon-oral.net/c/' . session()->get('code_commentaire'))}}&amp;size=100x100" alt="mon-oral.net/c/{{ session()->get('code_commentaire') }}" data-toggle="tooltip" data-placement="right" title="clic droit + 'Enregistrer l'image sous...' pour sauvegarder l'image du code" />
									
								</td>
							</tr>							
							<tr>
								<td class="pt-4" style="font-size:150%"><i class="fas fa-download mr-4 text-muted"></i></td>
								<td class="pt-4 text-muted text-justify">Pour télécharger votre fichier audio, cliquez sur les trois petits points verticaux à droite du lecteur. Si les trois petits points verticaux n'apparaissent pas (cela dépend des navigateurs), faites un clic droit sur le lecteur. Le fichier audio est au format mp3.</td>
							</tr>								
						</table>
						
						<p class="text-center mt-4">
							<a class="btn btn-light btn-sm mr-3" href="/console/commentaire-creer" role="button"><i class="fas fa-sync-alt align-middle pr-2"></i>faire un nouvel enregistrement</a>
							<a class="btn btn-dark btn-sm" href="/console/commentaires" role="button"><i class="fas fa-times align-middle pr-2"></i>quitter</a>
						</p>

					</div>

				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')	
		
	</body>
</html>