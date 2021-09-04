@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Entraînement - Étape 1</title>
</head>

<body>


	<nav class="navbar navbar-expand-md navbar-light">
		<div class="container">
			<div>
				<div><a href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
				<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Entraînement - Étape 1</div>
			</div>
		</div>
	</nav>

	<div class="container mb-5">

		<div class="row mt-5">

			<div class="col-md-4 offset-md-4">
				<form method="post" action="{{ url()->current() }}" style="display:inline;" role="form">

					@csrf

					<div class="form-group">
						<label for="code-entrainement" style="line-height:1em">Choisir un identifiant <sup style="color:red">*</sup><br /><span class="text-monospace" style="font-size:70%;color:silver">entre 4 et 6 lettres/chiffres</span></label>
						<input id="nom" class="form-control @error('nom') is-invalid d-block @enderror" type="text" name="nom" value="{{ old('nom') }}"  />
						@error('nom')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="code">Code de l'entraînement <sup style="color:red">*</sup></label>
						<input id="code" class="form-control @error('code') is-invalid d-block @enderror" type="text" name="code" value="{{ old('code', $code ?? '') }}" />
						@error('code')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror

					</div>

					<br />

					<div class="alert alert-warning text-justify pr-5" role="alert"><b style="font-weight:600">CONSEILS</b><br />
						<ul>
							<li>Préparez votre environnement de travail (feuilles, stylo, position confortable...)</li>
							<li>Assurez-vous de ne pas être dérangé et de rester seul dans un endroit silencieux</li>
							<li>Mettez-vous dans les conditions de l'examen : pas de téléphone portable, pas d'ordinateur...</li>
							<li>Vérifiez que votre appareil est suffisamment chargé ou qu'il est correctement branché sur le secteur.</li>
						</ul>
					</div>

					<p class="text-center mt-4">
						<button type="submit" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>
					</p>

				</form>
			</div>
		</div>

	</div><!-- /container -->

</body>
</html>
