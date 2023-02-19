<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Capsule Audio - Informations</title>

	</head>

	<body>

		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light mt-2">
				<div class="container">
				<div>
				<div class="float-left"><a href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.svg') }}" width="40" /></a></div>
						<div class="float-left text-monospace small pl-3" style="color:#c5c7c9;">Capsule Audio<br />Informations</div>
					</div>
				</div>
			</nav>

			<div class="container">

				<div class="row mt-5">

					<div class="col-md-6 offset-md-3">

						<table>

							<tr>
								<td class="pt-3" style="font-size:140%"><i class="fa fa-link mr-2 text-muted"></i></td>
								<td class="pt-3" style="width:100%;color:silver;">
									lien: <a href="/{{ strtoupper(session('code_audio')) }}" class="text-monospace text-primary ml-1" target="_blank">www.mon-oral.net/{{ strtoupper(session('code_audio')) }}</a>
								</td>
							</tr>
							<tr>
								<td class="pt-4" style="font-size:180%"><i class="fas fa-qrcode mr-4 text-muted"></i></td>
								<td class="pt-4" style="width:100%;color:silver;">QR code: <img class="ml-1" src="https://api.qrserver.com/v1/create-qr-code/?data={{urlencode('mon-oral.net/' . strtoupper(session('code_audio')))}}&size=150x150" width="150" alt="mon-oral.net/{{ strtoupper(session('code_audio')) }}" data-toggle="tooltip" data-placement="right" title="clic droit + 'Enregistrer l'image sous...' pour sauvegarder l'image du QR code" />
								</td>
							</tr>
							<tr>
								<td class="pt-4" style="font-size:150%"><i class="fas fa-download mr-4 text-muted"></i></i></td>
								<td class="pt-4" style="width:100%;color:silver;">fichier <a href="/capsule-telechargement/{{session('code_audio')}}" class="text-primary" style="verticla-align:middle;">mp3</a>
								</td>
							</tr>							
							
						</table>

						<table>
							<tr>
								<td class="pt-3" style="font-size:150%;color:#e74c3c"><i class="fas fa-exclamation-circle mr-4"></i></td>
								<td colspan="2" class="pt-4 text-muted">
									<div class="card border-danger">
										<div class="card-body text-danger pl-0">
											<ul class="m-0">
												<li>Sauvegardez le lien et/ou le QR code car vous ne pourrez pas revenir sur cette page.</li>
												<li>Cet enregistrement sera supprimé dans 30 jours.</li>
											</ul>
										</div>
									</div>
								</td>
							</tr>
						</table>

						<p class="text-center mt-5">
							<a class="btn btn-light mr-3" href="/capsule" role="button" data-toggle="tooltip" data-placement="top" title="faire un nouvel enregistrement"><i class="fas fa-sync-alt"></i></a>
							<a class="btn btn-dark" href="/" role="button" data-toggle="tooltip" data-placement="top" title="quitter"><i class="fas fa-times"></i></a>
						</p>

					</div>

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom-js')

	</body>
</html>
