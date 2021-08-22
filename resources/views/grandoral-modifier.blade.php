<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console | Grand Oral - Modifier l'entraînement</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-5px;">console</div>
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
			$grandoral = App\Grandoral_entrainement::where([['user_id', $user->id],['id', $grandoral_id]])->first();
			?>

			<div class="container">
				<div class="row">
				
					<div class="col-md-2 pt-5">
						<a class="btn btn-light btn-sm" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>
					
					<div class="col-md-10 pt-5">

						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif		
								
						<?php
						if ($grandoral === null){
							?>
							<div class="text-danger text-monospace text-center">Cet entraînement n'existe pas !</div>
							<?php
						} else {
							
							$formatage = '
								<div class="text-muted"><p class="mb-1"><b>Formatage du texte</b></p>
								*italique* <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <em>italique</em><br />
								**gras** <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <b>gras</b><br />
								__souligné__ <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <u>souligné</u></div>
							';								
							?>
						
							<h1>{{$grandoral->titre}}</h1>
							
							<form method="POST" action="{{route('grandoral-modifier-post')}}">
								
								@csrf
														
								<div class="form-row pb-3 mt-4">
									<div class="col-2 text-secondary">titre</div>
									<div class="col">
										<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre', $grandoral->titre) }}" autocomplete="titre" autofocus />
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
										<input type="range" class="custom-range" value="{{ old('temps_prep', $grandoral->temps_prep) }}" min="1" max="20" step="1" name="temps_prep" oninput="temps_preparation(this.value);">
									</div>
									<div class="col-auto text-secondary" id="temps_preparation" style="text-align:right;width:70px;">{{ old('temps_prep', $grandoral->temps_prep) }} min.</div>
								</div>
								
								<div class="form-row pb-3">
									<div class="col-2 text-secondary">
										<div>consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></div>
										<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
									</div>
									<div class="col">
										<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="5">{{ old('consignes', $grandoral->consignes) }}</textarea>
										@error('consignes')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror	
									</div>
								</div>		
								
								<input type="hidden" id="grandoral_id" name="grandoral_id" value="<?php echo $grandoral_id ?>">
								
								<button type="submit" class="btn btn-primary mt-4 pl-4 pr-4"><i class="fas fa-check"></i></button>

							</form>							
							

							<?php
						}
						?>

					</div>

				</div><!-- /row -->
				
			</div><!-- /container -->

		</div><!-- /app -->
	
		@include('inc-bottom-js')	
			
		<script>		
		function temps_preparation(t) {
			document.getElementById("temps_preparation").innerHTML = t + " min.";
			document.getElementById("code").style.width = t + " min.";
		}		
		</script>
		
	</body>
</html>