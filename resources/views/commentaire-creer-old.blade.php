@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console | Nouveau commentaire</title>
		
	</head>
		
	<body>	
	
		<?php
		$user = Auth::user();
		?>
		
		<div id="app">
			
			@include('inc-nav-console')

			<div class="container mb-5">

				<div class="row">
				
					<div class="col-md-2 pt-5">
						<a class="btn btn-light btn-sm" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>					
					
					<div class="col-md-10 pt-5">

						@if (session('status'))
							<div class="text-success text-monospace text-center pb-4" role="alert">
								{{ session('status') }}
							</div>
						@endif		
							
						<h1>Nouvelle capsule</h1>
						<!--<h1 style="color:red;font-size:200%">EN TRAVAUX PENDANT UNE HEURE - NE PAS UTILISER CETTE PAGE</h1>-->
							
						<form method="POST" action="">
							
							@csrf
														
							<div class="form-row pb-3 mt-4">
								<div class="col-2 text-secondary">titre <sup style="color:red">*</sup></div>
								<div class="col">
									<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre') }}" autocomplete="titre" autofocus />
									@error('titre')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									<small class="form-text text-muted">visible seulement par les enseignants dans la console.</small>
								</div>
							</div>	
												
							<div class="form-row pb-3">
								<div class="col-2 text-secondary">
									<div>sous-titre</div>
									<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
								</div>
								<div class="col">
									<input id="soustitre" class="form-control @error('soustitre') is-invalid d-block @enderror" name="soustitre" type="text" value="{{ old('soustitre') }}" autocomplete="soustitre" autofocus />
									@error('soustitre')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror	
									<small class="form-text text-muted">visible par les élèves - exemples : "Exercice de lecture", "Récitation", "Podcast", "Emission webradio"...</small>
								</div>
							</div>										
														
							<input type="hidden" name="user_id" value="{{ $user->id }}">
							
							<button type="submit" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>

						</form>	

					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->
	
		@include('inc-bottom')
		@include('inc-bottom-js')
		
	</body>
</html>