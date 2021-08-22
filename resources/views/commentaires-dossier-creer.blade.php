@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />	

		<title>Commentaire Audio</title>

		<!-- Scripts -->
		<script src="{{ asset('js/DetectRTC.min.js') }}"></script>
			
		<!-- Recorder -->
		<script src="{{ asset('js/recorder.min.js') }}"></script>

	</head>
		
	<body>	
	
		<?php
		$user = Auth::user();
		?>	

		<div id="app">

			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Commentaire Audio</div>
					</div>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto" style="padding-left:100px;">
							@if (Route::has('login'))				
								@auth
									<li class="nav-item"><a class="btn btn-outline-secondary btn-sm" style="font-size:80%;opacity:0.4;margin:2px 0px 0px 4px" href="{{ url('/console') }}">console</a></li>
								@else
									<li class="nav-item" style="font-size:80%;opacity:0.3;padding:6px 0px 0px 4px">Enseignants :</li>
									<li class="nav-item"><a class="btn btn-outline-secondary btn-sm" style="font-size:80%;opacity:0.4;margin:2px 0px 0px 4px" href="{{ route('login') }}">se connecter</a></li>
									@if (Route::has('register'))
										<li class="nav-item"><a class="btn btn-outline-secondary btn-sm " style="font-size:80%;opacity:0.4;margin:2px 0px 0px 4px" href="{{ route('register') }}">créer un compte</a></li>
									@endif
								@endauth					
							@endif				
						</ul>
					</div>
				</div>
			</nav>
		
			<div class="container mt-5">
									
				<div class="row">
					<div class="col-md-2">
						<a class="btn btn-light btn-sm" href="/console/commentaires" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>
				
					<div class="col-md-10">
					
						<h2>NOUVEAU DOSSIER</h2>
						
						<form method="POST" action="{{ route('commentaires-dossier-creer-post')}}">
							
							@csrf
														
							<div class="form-row pb-3 mt-4">
								<div class="col-2 text-secondary">nom du dossier <sup style="color:red">*</sup></div>
								<div class="col">
									<input id="nom" class="form-control @error('nom') is-invalid d-block @enderror" name="nom" type="text" value="{{ old('nom') }}" autocomplete="nom" autofocus />
									@error('nom')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									<input type="hidden" name="user_id" value="{{ $user->id }}">
									<button type="submit" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>
								</div>
							</div>	

						</form>												
						
					</div>
										
				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->			

		@include('inc-bottom')		
		@include('inc-bottom-js')		
		
	</body>
</html>