@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console | Grand Oral - Nouvel entraînement</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-2px;">console</div>
					</div>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown">
							
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<div class="dropdown-menu dropdown-menu-right p-1" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>							

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
								
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<?php
			$user = Auth::user();
			?>

			<div class="container">
				
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
																	
						<?php						
						$formatage = '
							<div class="text-muted"><p class="mb-1"><b>Formatage du texte</b></p>
							*italique* <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <em>italique</em><br />
							**gras** <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <b>gras</b><br />
							__souligné__ <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <u>souligné</u></div>
						';
						?>
						
						<h1>Entraînement au Grand Oral</h1>
						
						<form method="POST" action="{{route('grandoral-creer-post')}}">
							
							@csrf
														
							<div class="form-row pb-3 mt-4">
								<div class="col-2 text-secondary">titre</div>
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
								<div class="col-2 text-secondary">préparation</div>
								<div class="col">
									<input type="range" class="custom-range" value="{{ old('temps_prep','20') }}" min="0" max="20" step="1" name="temps_prep" oninput="temps_preparation(this.value);">
								</div>
								<div class="col-auto text-secondary" id="temps_preparation" style="text-align:right;width:70px;">{{ old('temps_prep','20') }} min.</div>
							</div>
							
							<div class="form-row pb-3">
								<div class="col-2 text-secondary">
									<div>consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></div>
									<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
								</div>
								<div class="col">
									<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="5">{{ old('consignes') }}</textarea>
									@error('consignes')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror	
								</div>

							</div>	
							
							<?php
							/*
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="echange_check">
								<label class="custom-control-label text-secondary" for="echange_check">Échange avec le candidat <span class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</span></label>
							</div>

							<div id="echange" style="display:none">
								<div class="form-group">
									<label class="text-secondary"> questions du jury<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></label>
									@error('sujets.0')
										<span class="invalid-feedback d-block m-0 pb-1" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

									<div style="clear:both;">
										<textarea name="sujets[]" class="form-control mb-2 @error('sujets.0') is-invalid d-block @enderror" rows="4"></textarea>
									</div>

								</div>
							</div>
							
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="orientation_check">
								<label class="custom-control-label text-secondary" for="orientation_check">Échange sur le projet d'orientation du candidat <span class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</span></label>
							</div>	

							<div id="orientation" style="display:none">
								<div class="form-group">
									<label class="text-secondary"> questions du jury<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></label>
									@error('sujets.0')
										<span class="invalid-feedback d-block m-0 pb-1" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

									<div style="clear:both;">
										<textarea name="sujets[]" class="form-control mb-2 @error('sujets.0') is-invalid d-block @enderror" rows="4"></textarea>
									</div>

								</div>
							</div>

							Code javascript à ajouter en bas de la page :
							<script>
							const echange_check = document.getElementById('echange_check');
							echange_check.addEventListener("change", function() {
							  document.getElementById("echange").style.display = echange_check.checked ? "block" : "none";
							});
							
							const orientation_check = document.getElementById('orientation_check');
							orientation_check.addEventListener("change", function() {
							  document.getElementById("orientation").style.display = orientation_check.checked ? "block" : "none";
							});				
							</script>								
							*/
							?>
							
							<input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
							
							<button type="submit" class="btn btn-primary mt-4 pl-4 pr-4"><i class="fas fa-check"></i></button>

						</form>				

					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->
	
		@include('inc-bottom')
		@include('inc-bottom-js')
			
		<script>		
		function temps_preparation(t) {
			document.getElementById("temps_preparation").innerHTML = t + " min.";
			document.getElementById("code").style.width = t + " min.";
		}		
		</script>
		
	</body>
</html>