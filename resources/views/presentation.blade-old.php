@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')
		
		<title>Mon Oral - Présentation</title>
		
	</head>
		
	<body data-spy="scroll" data-target="#menu" data-offset="120" style="position:relative;">

		<nav class="navbar navbar-expand-md navbar-light fixed-top">
			<div class="container">
				<div>
					<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
					<div class="text-monospace small text-danger" style="padding-left:40px;margin-top:-15px;">bêta</div>
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
			
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
			
				<div class="col-md-3 text-muted mt-2">
					<nav id="menu" class="navbar navbar-light bg-light small sticky-top" style="top:80px;">
						<nav class="nav nav-pills flex-column">
							<a class="nav-link" href="#item-1">Entraînements</a>
							<nav class="nav nav-pills flex-column">
								<a class="nav-link ml-2 my-0" href="#item-1-1">Interface élève</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-4 my-0" href="#item-1-1-1">Étape 1</a>
										<a class="nav-link ml-4 my-0" href="#item-1-1-2">Étape 2</a>
										<a class="nav-link ml-4 my-0" href="#item-1-1-3">Étape 3</a>
										<a class="nav-link ml-4 my-0" href="#item-1-1-4">Étape 4</a>
										<a class="nav-link ml-4 my-0" href="#item-1-1-5">Étape 5</a>
									</nav>
								<a class="nav-link ml-2 my-0" href="#item-1-2">Interface enseignant</a>
									<nav class="nav nav-pills flex-column">
										<a class="nav-link ml-4 my-0" href="#item-1-2-1">Console</a>
										<a class="nav-link ml-4 my-0" href="#item-1-2-2">Nouvel entraînement</a>
										<a class="nav-link ml-4 my-0" href="#item-1-2-3">Modification d'un entraînement</a>
										<a class="nav-link ml-4 my-0" href="#item-1-2-4">Activer / désactiver un entraînement</a>
									</nav>								
							</nav>
							<a class="nav-link" href="#item-2">Capsules audio</a>
							<nav class="nav nav-pills flex-column">
								<a class="nav-link ml-2 my-0" href="#item-2-1">Enregistrement</a>
								<a class="nav-link ml-2 my-0" href="#item-2-2">Écoute & téléchargement</a>
							</nav>
						</nav>
					</nav>
				</div>
	
				<div class="col-md-9" style="position:relative;top:85px;">
				
					<p>Préparation aux épreuves orales de collège et de lycée (grand oral, français, langues...) avec des <a href="/entrainement-etape1">travaux préparés par les enseignants</a> (avec phases de préparation et d'oral chronométrés) ou de <a href="/capsule-enregistrement">façon autonome</a>.</p>
					<p>Enregistrez-vous, écoutez-vous, corrigez vos erreurs et recommencez.</p>
					<p>Pas de compte à créer, pas de logiciel à installer.</p>
					<p>Multiplateforme : Windows, MacOS, Linux, téléphones ou tablettes (iOS ou Android)...</p>	
					
					
					<div id="item-1" class="n1">Entraînements</div>
					<p>Entraînements proposés par les enseignants pour développer l'expression orale et préparer les épreuves orales de collège et de lycée avec phases de préparation et d'oral en temps limité et tirage au sort de sujets.</p>
					<div id="item-1-1" class="n2">Interface élève</div>
					<div id="item-1-1-1" class="n3">Étape 1</div>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape1.png') }}" class="img-fluid capture" alt="Interface élève - Étape 1"></p>
					
					<div id="item-1-1-2" class="n3">Étape 2</div>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape2-1.png') }}" class="img-fluid capture" alt="Interface élève - Étape 2 - 1"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape2-2.png') }}" class="img-fluid capture" alt="Interface élève - Étape 2 - 2"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape2-3.png') }}" class="img-fluid capture" alt="Interface élève - Étape 2 - 3"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape2-4.png') }}" class="img-fluid capture" alt="Interface élève - Étape 2 - 4"></p>
					
					<div id="item-1-1-3" class="n3">Étape 3</div>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape3.png') }}" class="img-fluid capture" alt="Interface élève - Étape 3"></p>
					
					<div id="item-1-1-4" class="n3">Étape 4</div>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-1.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 1"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-2.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 2"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-3.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 3"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-4.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 4"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-5.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 5"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-6.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 6"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-7.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 7"></p>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape4-8.png') }}" class="img-fluid capture" alt="Interface élève - Étape 4 - 8"></p>
					
					<div id="item-1-1-5" class="n3">Étape 5</div>
					<p class="text-center"><img src="{{ asset('img/captures/eleve_etape5.png') }}" class="img-fluid capture" alt="Interface élève - Étape 5"></p>
					

					<div id="item-1-2" class="n2">Interface enseignant</div>
					<div id="item-1-2-1" class="n3">Console</div>
					<p class="text-center"><img src="{{ asset('img/captures/enseignant_console.png') }}" class="img-fluid capture" alt="Interface enseignant - Console"></p>
					<div id="item-1-2-2" class="n3">Nouvel entraînement</div>
					<p class="text-center"><img src="{{ asset('img/captures/enseignant_nouvel_entrainement.png') }}" class="img-fluid capture" alt="Interface enseignant - Nouvel entraînement"></p>
					<div id="item-1-2-3" class="n3">Modification d'un entraînement</div>
					<p class="text-center"><img src="{{ asset('img/captures/enseignant_modifier.png') }}" class="img-fluid capture" alt="Interface enseignant - Modification d'un entraînement"></p>
					<div id="item-1-2-4" class="n3">Activer / désactiver un entraînement</div>
					<p class="text-center"><img src="{{ asset('img/captures/enseignant_activer_desactiver.png') }}" class="img-fluid capture" alt="Interface enseignant - Activer / désactiver un entraînement"></p>
					
					<div id="item-2" class="n1">Capsules audio</div>
					<p>Enregistrement libre de capsules audio pour vos travaux scolaires, vos préparations aux épreuves orales, vos émissions webradio, la création de podcasts ou pour vous entraîner de façon autonome.</p>
					<div id="item-2-1" class="n2">Enregistrement</div>
					<p class="text-center"><img src="{{ asset('img/captures/capsule-enregistrement-1.png') }}" class="img-fluid capture" alt="Capsules audio - Enregistrement - 1"></p>
					<p class="text-center"><img src="{{ asset('img/captures/capsule-enregistrement-2.png') }}" class="img-fluid capture" alt="Capsules audio - Enregistrement - 2"></p>
					<p class="text-center"><img src="{{ asset('img/captures/capsule-enregistrement-3.png') }}" class="img-fluid capture" alt="Capsules audio - Enregistrement - 3"></p>
					<div id="item-2-2" class="n2">Écoute & téléchargement</div>
					<p class="text-center"><img src="{{ asset('img/captures/capsule-telechargement.png') }}" class="img-fluid capture" alt="Capsules audio - Téléchargement"></p>
				</div>

			</div>
		</div><!-- /container -->
	
		@include('inc-bottom')			
		@include('inc-bottom-js')			

    </body>
</html>