@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Entraînement Grand Oral - Étape 1</title>
					
	</head>
	
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Entraînement Grand Oral - Étape 1</div>
					</div>
				</div>
			</nav>

			<div class="container">	

				<div class="row mt-5">
									
					<div class="col-md-6 offset-md-3">
						<form method="post" action="{{ url()->current() }}" style="display:inline;" role="form">
							
							@csrf
							
							
							
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Prénom <sup style="color:red">*</sup></label>
      <input type="text" class="form-control" id="prenom">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Première lettre du nom <sup style="color:red">*</sup></label>
      <input type="text" class="form-control" id="inputPassword4">
    </div>
  </div>							

							
							
						
							<div class="form-group">
								<label for="code-entrainement">Prénom <sup style="color:red">*</sup></label>
								<input id="prenom" style="width:30%" class="form-control @error('prenom') is-invalid d-block @enderror" type="text" name="prenom" value="{{ old('prenom') }}"  />
								@error('prenom')
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror									
							</div>
							<div class="form-group">
								<label for="code-entrainement">Première lettre du nom <sup style="color:red">*</sup></label>
								<input id="nom" style="width:30%" class="form-control @error('nom') is-invalid d-block @enderror" type="text" name="nom" value="{{ old('nom') }}"  />
								@error('nom')
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror	
							</div>
							<div class="form-group">							
								<label for="code" style="margin-bottom:0">🗝️ Code de l'entraînement <sup style="color:red">*</sup></label>
								<small id="code-help" class="form-text text-muted">Saisir ci-dessous le code qui a été fourni pour cet entraînement.</small>
								<input id="code" class="form-control @error('code') is-invalid d-block @enderror" type="text" name="code" value="{{ old('code') }}"  />
								@error('code')
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								
							</div>
							
							<br />

							<div class="card bg-light">
								<div class="card-header">
									<b>Sujets pour le Grand Oral</b>
									<small id="code-help" class="form-text text-muted">Saisir ci-dessous les deux sujets pour le Grand Oral. Un des deux sujets sera tiré au sort pour cet entraînement. Si un seul sujet a été défini, saisir deux fois le même sujet.</small>
								</div>
								<div class="card-body">							

									<div class="form-group">							
										<label for="code">Sujet 1 <sup style="color:red">*</sup></label>
										<textarea class="form-control @error('sujet1') is-invalid d-block @enderror" id="sujet1" name="sujet1" rows="4">{{ old('sujet1') }}</textarea>
										@error('sujet1')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
									</div>

									<div class="form-group mb-0">							
										<label for="code">Sujet 2 <sup style="color:red">*</sup></label>
										<textarea class="form-control @error('sujet2') is-invalid d-block @enderror" id="sujet2" name="sujet2" rows="4">{{ old('sujet2') }}</textarea>
										@error('sujet2')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
									</div>
							
								</div>							
							</div>							
							
							<br />
							
							<div class="alert alert-warning" role="alert"><b style="font-weight:700">CONSEILS</b><br />
								<ul>
									<li>Préparez votre environnement de travail (feuilles, stylo, position confortable...)</li>
									<li>Assurez-vous de ne pas être dérangé et de rester seul dans un endroit silencieux</li>
									<li>Mettez-vous dans les conditions de l'examen : pas de téléphone portable, pas d'ordinateur...</li>
									<li>Vérifiez que votre appareil est suffisamment chargé ou qu'il est correctement branché sur le secteur.</li>
								</ul>
							</div>
							
							<p class="text-center mt-4">
								<button type="submit" class="btn btn-primary"><i class="fas fa-check pr-2"></i>validez</button>
							</p>
							
						</form>				
					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->	
		
		@include('inc-bottom')	
				
	</body>
</html>	