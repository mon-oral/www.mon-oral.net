@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')	
	
		<title>Mon Oral</title>
		
		<!-- Open Graph -->
		<meta property="og:title" content="mon-oral.net" />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="Pratique de l'oral au primaire et au secondaire - Préparation aux épreuves orales de collège et de lycée (brevet, français, langues, grand oral...)." />
		<meta property="og:url" content="https://www.mon-oral.net" />
		<meta property="og:image" content="{{ asset('img/opengraph_1200x630.png') }}" />
		<meta property="og:image:alt" content="mon-oral.net" />
		<meta property="og:image:type" content="image/png" />
		<meta property="og:image:width" content="1200" />
		<meta property="og:image:height" content="630" />
		
		<!-- Twitter Card -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@mon_oral">
		<meta name="twitter:creator" content="@mon_oral">
		<meta name="twitter:title" content="mon-oral.net">
		<meta name="twitter:description" content="Pratique de l'oral au primaire et au secondaire - Préparation aux épreuves orales de collège et de lycée (brevet, français, langues, grand oral...).">
		<meta name="twitter:image" content="{{ asset('img/opengraph_1200x630.png') }}">		

	</head>
		
	<body>
		<div id="app" class="mb-5">
		
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="60" /></a></div>
						<div class="text-monospace" style="font-size:60%;color:silver;margin-top:-6px;">mon-oral.net</div>
						<div class="text-monospace small text-danger" style="padding-left:70px;margin-top:-70px;">bêta</div>
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
				
				<?php
				if (isset($_GET['a']) AND $_GET['a'] == 'supprimer'){
					?>
					<div class="text-center text-danger text-monospace">votre compte a été supprimé !</div>
					<?php
				}
				?>

				<div class="row mt-5">

					<div class="col-md-3 mt-5 text-muted" style="padding:10px;">
						<p class="text-center"><img src="{{ asset('img/quote-left.svg') }}" style="valign:middle;margin-right:6px;" width="18" />Pratique de l'oral au primaire<br />et au secondaire, préparation aux épreuves orales de collège et<br />de lycée <span style="color:silver">&amp;</span> création de commentaires audio pour les élèves<img src="{{ asset('img/quote-right.svg') }}" style="valign:middle;margin-left:6px;" width="18" /></p>
						<p class="text-justify text-monospace small mt-5" style="color:silver">Pas de compte à créer, pas de logiciel à installer.</p>
						<p class="text-justify text-monospace small m-0" style="color:silver">Multiplateforme : Windows, MacOS, Linux, téléphones ou tablettes (iOS ou Android)...</p>
					</div>
					
										
					<div class="col-md-4 pl-md-5 pr-md-5" style="padding:10px;">
						<div class="pb-2 small text-monospace text-center" style="color:silver">&nbsp;</div>
						<div class="card-deck">

							<div class="card">
								<div class="text-center pt-4"><img src="{{ asset('img/logo-capsule-audio.png') }}" width="140" alt="Capsule Audio" /></div>
								<div class="card-body pt-0">
									<p class="card-text">
										<div style="position:absolute;top:10px;right:12px;cursor:help;">
										<i style="color:silver" class="fas fa-question-circle" data-placement="top" data-html="true" data-trigger="hover" data-toggle="popover" data-content="Enregistrement libre de capsules audio pour vos travaux scolaires, vos préparations aux épreuves orales, vos émissions webradio, la création de podcasts ou pour vous entraîner de façon autonome. Téléchargement des fichiers audio au format mp3."></i>
										</div>									
										<h2 class="text-center">Capsules audio</h2>
										<h3>enregistrements<br />libres</h3>
									</p>
									<div class="text-center mt-2"><a class="btn btn-primary btn-sm" href="/capsule" role="button"><i class="fas fa-check pl-2 pr-2"></i></a></div>
									
								</div>
							</div>								

						</div>						
					</div>	
					
					<div class="col-md-5" style="background-color:#f2f4f6;border-radius:5px;padding:10px 22px 14px 22px;">	
						<div class="pb-2 small text-monospace text-center" style="color:silver">entraînements et activités proposés par les enseignants</div>
						<div class="card-deck">					
													
							<div class="card" style="margin-left:7px;margin-right:7px;">
								<div class="text-center pt-4"><img src="{{ asset('img/logo-grand-oral.png') }}" width="140" alt="Entraînement Grand Oral" /></div>
								<div class="card-body pt-0">
									<p class="card-text">
										<h2 class="text-center">Entraînements</h2>
										<h3>français, langues, grand oral,<br />brevet...</h3>
									</p>
									<div class="text-center mt-2"><a class="btn btn-primary btn-sm" href="/entrainement" role="button"><i class="fas fa-check pl-2 pr-2"></i></a></div>
								</div>
							</div>							

							<div class="card" style="margin-left:7px;margin-right:7px;">
								<div class="text-center pt-4"><img src="{{ asset('img/logo-entrainement.png') }}" width="140" alt="Entraînement Grand Oral" /></div>
								<div class="card-body pt-0">
									<p class="card-text">
										<h2 class="text-center">Activités</h2>
										<h3>récitation, lecture expressive, explication orale...</h3>
									</p>
									<div class="text-center mt-2"><a class="btn btn-primary btn-sm" href="/activite" role="button"><i class="fas fa-check pl-2 pr-2"></i></a></div>
								</div>
							</div>								

						</div>						
					
					</div>
				</div>
			</div><!-- /container -->
		</div><!-- /app -->
				
		@include('inc-footer')			
		@include('inc-bottom-js')		
		@include('inc-bottom')		

    </body>
</html>
