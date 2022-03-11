<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Activité - Enregistrement sauvegardé</title>

	</head>

	<body>

		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Activité - Enregistrement sauvegardé</div>
					</div>
				</div>
			</nav>

			<div class="container">

				<div class="row mt-5">
					<div class="col-md-6 offset-md-3 text-success text-monospace text-center">
						<i class="fas fa-check-circle fa-2x mb-2"></i><br />
						Votre enregistrement est sauvegardé. Il apparaitra dans la console de l'enseignant.
					</div>
				</div>

				<div class="row mt-5">

					<div class="col-md-6 offset-md-3">

						<table>
							<tr style="line-height:10px;">
								<td style="font-size:150%"><i class="fas fa-volume-up mr-4 text-muted"></i></td>
								<td style="width:100%">
									<audio controls style="width:100%"><source src="/activite-etape-sauvegarder-ecoute" type="audio/mpeg"></audio>
								</td>
								<td>
									<a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-activite/{{session()->get('code_audio_activite')}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
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
								<td class="pt-3" style="font-size:150%;color:#e74c3c"><i class="fas fa-exclamation-circle mr-4"></i></td>
								<td colspan="2" class="pt-4 text-muted">
									<div class="card border-danger">
										<div class="card-body text-danger">
											<b>Si vous souhaitez conserver cet enregistrement, pensez à le télécharger.</b><br />Vous ne pourrez pas revenir sur cette page.
										</div>
									</div>
								</td>
							</tr>
						</table>

						<p class="text-center mt-5">
							<a class="btn btn-dark btn-sm" href="/" role="button"><i class="fas fa-times align-middle pr-2"></i>quitter</a>
						</p>

					</div>

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom-js')

	</body>
</html>
