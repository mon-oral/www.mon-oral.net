@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
		@include('inc-meta')
		<title>Nuits de la lecture</title>
		<style>
		body {background-color:#2169b5;}
		</style>
	</head>

	<body>

		<div id="app">

			<div class="container mb-5">

				<div class="row mt-4">
					<div class="col-md-12">
						<div class="text-center"><img class="img-fluid" src="{{ asset('img/nuitsdelalecture-top.svg') }}" alt="Nuits de la lecture" width="800" /></div>
						<div class="text-center pl-4 pr-4"><img class="img-fluid" src="{{ asset('img/nuitsdelalecture-titre.svg') }}" alt="Nuits de la lecture" width="500" /></div>
					</div>
				</div>

				<div class="row mt-4">

					<div class="col-md-8 offset-md-2">

						<form method="post" action="{{ url()->current() }}" style="display:inline;" role="form">

							@csrf

							<div class="form-group">

								Saisir le titre de la lecture en respectant le format suivant :
								<div class="text-monospace text-center mt-1 mb-2" style="color:silver">ton nom # ton prénom # siècle de l'oeuvre # nom de l'auteur # titre de l'extrait</div>
								<div class="mt-1 mb-2" style="font-size:90%;color:#103d60">
									Exemple : <span class="text-monospace text-center mt-1 mb-2" style="font-size:85%;color:silver">Martin # Lucie # XVIe # Ronsard # Mignonne, allons voir si la rose</span>
								</div>


								<input id="nom" class="form-control @error('nom') is-invalid d-block @enderror" type="text" name="nom" value="{{ old('nom') }}"  />
								@error('nom')
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>

							<input type="hidden" id="code" name="code" value="{{ old('code', $code ?? '') }}" />
							@error('code')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror

							<p class="text-center mt-4">
								<button type="submit" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>
							</p>

						</form>

					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-12">
						<div class="text-center mb-5"><img class="img-fluid" src="{{ asset('img/nuitsdelalecture-bottom.svg') }}" alt="Nuits de la lecture" width="800" /></div>
						<div class="text-center small text-monospace text-muted pt-5" style="opacity:0.5">illustrations : <a href="https://all-free-download.com/" target="_blank">all-free-download.com</a></div>
					</div>

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom')

	</body>
</html>
