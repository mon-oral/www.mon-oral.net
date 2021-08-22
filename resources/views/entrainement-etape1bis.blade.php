@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Entraînement - Étape 1 bis</title>
					
	</head>
	
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Entraînement - Étape 1 bis</div>
					</div>
				</div>
			</nav>

			<div class="container mb-5">	

				<div class="row mt-5">
									
					<div class="col-md-6 offset-md-3">
						<form method="post" action="{{ url()->current() }}" style="display:inline;" role="form">
							
							@csrf
							
							@if(session()->get('entrainement_type') == 3)
							<div class="card bg-light">
								<div class="card-header">
									<b>Sujets</b>
									<small id="code-help" class="form-text text-muted">Saisir ci-dessous les deux sujets pour le Grand Oral. Un des deux sujets sera tiré au sort pour cet entraînement. Si un seul sujet a été défini, saisir deux fois le même sujet.</small>
								</div>
								<div class="card-body">							

									<div class="form-group">							
										<label for="code">Sujet 1 <sup style="color:red">*</sup></label>
										<textarea class="form-control @error('sujet1_go') is-invalid d-block @enderror" id="sujet1_go" name="sujet1_go" rows="4">{{ old('sujet1_go') }}</textarea>
										@error('sujet1_go')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
									</div>

									<div class="form-group mb-0">							
										<label for="code">Sujet 2 <sup style="color:red">*</sup></label>
										<textarea class="form-control @error('sujet2_go') is-invalid d-block @enderror" id="sujet2_go" name="sujet2_go" rows="4">{{ old('sujet2_go') }}</textarea>
										@error('sujet2_go')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
									</div>
							
								</div>							
							</div>	
							@endif
								
							@if(session()->get('entrainement_type') == 4)
							<div class="card bg-light">
								<div class="card-header">
									<b>Sujet <sup style="color:red">*</sup></b>
									<small id="code-help" class="form-text text-muted">Saisir ci-dessous le sujet de l'exposé.</small>
								</div>
								<div class="card-body">							

									<div class="form-group">							
										<textarea class="form-control @error('sujet_brevet') is-invalid d-block @enderror" id="sujet_brevet" name="sujet_brevet" rows="4">{{ old('sujet_brevet') }}</textarea>
										@error('sujet_brevet')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
									</div>
							
								</div>							
							</div>	
							@endif
								
							<p class="text-center mt-4">
								<button type="submit" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>
							</p>
							
						</form>			
					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->	
		
		@include('inc-bottom')	
				
	</body>
</html>	