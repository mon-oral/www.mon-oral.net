@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />	

		<title>Dossier QR Codes Commentaires Audio</title>

	</head>
		
	<body>	

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
					
						<h2>NOUVEAU LOT DE LIENS / QR CODES</h2>
						
						<form method="POST" action="{{ route('commentaires-qrcodes-creer-post')}}">
							
							@csrf
														
							<div class="form-row mt-4">
								<div class="col-3 text-secondary text-right">
									nom du lot <sup style="color:red">*</sup>
									<span class="ml-1 small" style=""><i class="fas fa-question-circle" style="cursor:pointer" data-container="body" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="caractères autorisés: lettres, chiffres, espace, - et _" aria-hidden="true" data-original-title="" title=""></i></span>
								</div>
								<div class="col-6">
									<input id="nom" class="form-control @error('nom') is-invalid d-block @enderror" name="nom" type="text" value="{{ old('nom') }}" autocomplete="nom" autofocus />
									@error('nom')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>	
							<div class="form-row pt-2 pb-3">
								<div class="col-3 text-secondary text-right">nombre de liens / QR codes <sup style="color:red">*</sup></div>
								<div class="col-2">
									<input id="nb_qrcodes" class="form-control @error('nb_qrcodes') is-invalid d-block @enderror" name="nb_qrcodes" type="text" value="{{ old('nb_qrcodes') }}" autocomplete="nb_qrcodes" autofocus />
									@error('nb_qrcodes')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
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