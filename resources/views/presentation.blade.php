@include('inc-top')
<!doctype html>
<html lang="fr">
<head>

	@include('inc-meta')

	<title>Mon Oral | Présentation</title>

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

	@include('inc-nav-with-register')

	<div class="container">

		<div class="row">

			<div class="col-md-6 offset-md-3 text-muted mt-3">
				<p class="text-center"><img src="{{ asset('img/quote-left.svg') }}" style="margin-right:6px;" width="18" />Pratique de l'oral au primaire et au secondaire, préparation aux épreuves orales de collège et de lycée <span style="color:silver">&amp;</span> création de commentaires audio pour les élèves<img src="{{ asset('img/quote-right.svg') }}" style="margin-left:6px;" width="18" /></p>
				<p class="text-justify text-monospace small mt-4" style="color:silver">Pas de compte à créer pour les élèves, pas de logiciel à installer.</p>
				<p class="text-justify text-monospace small m-0" style="color:silver">Multiplateforme : Windows, MacOS, Linux, téléphones ou tablettes (iOS ou Android)... Un navigateur web suffit.</p>
			</div>

		</div>

		<div class="row pt-5">

			<div class="col-md-1 text-center">
				<img src="{{ asset('img/icon-activites.png') }}" alt="Activités" width="48" class="mr-4 mb-5" />
				<img src="{{ asset('img/icon-commentaires.png') }}" alt="Commentaires" width="48" class="mr-4 mb-5" />
				<img src="{{ asset('img/icon-entrainements.png') }}" alt="Entraînements" width="48" class="mr-4 mb-5" />
				<img src="{{ asset('img/icon-lecture.png') }}" alt="Lecture" width="48" class="mr-4 mb-5" />
			</div>

			<div class="col-md-5 mb-5">
				<p class="text-success">ENSEIGNANTS</p>
				<div class="text-monospace small mb-1">ACTIVITÉS</div>
				<div class="text-justify small text-muted">Tout type d'activité orale à proposer aux élèves du secondaire ou du primaire : récitation, lecture expressive, explication linéaire, description d'image / schéma / graphique, exposé, podcast... Récupération automatique des enregistrements. Possibilité de correction / commentaires / conseils oraux ou écrits à partager avec les élèves (lien, QR code...).</div>
				<div class="text-monospace small mt-3 mb-1">ENTRAÎNEMENTS</div>
				<div class="text-justify small text-muted">Entraînements aux épreuves orales de collège et de lycée avec temps de préparation, tirage au sort de sujets et chronométrage. Récupération automatique des enregistrements. Possibilité de correction / commentaires / conseils oraux ou écrits à partager avec les élèves (lien, QR code...).<br />EAF, Grand Oral, langues, brevet...</div>
				<div class="text-monospace small mt-3 mb-1">COMMENTAIRES</div>
				<div class="text-justify small text-muted">Création de capsules audio pour les élèves : correction orale de copies, cours, consignes, explications... Différents moyens de distribution: lien, QR code, code unique, intégration dans un site ou une plateforme de partage...</div>
			</div>

			<div class="col-md-3 mb-5">
				<p class="text-success">ÉLÈVES</p>
				<div class="text-justify small text-muted"><i style="color:silver;">~ au secondaire ~</i><br />Avec un lien ou un code, l'élève accède aux activités orales ou aux entraînements de type examen proposés par l'enseignant afin d'améliorer l'expression et de préparer les épreuves de collège et de lycée (Épreuves Anticipées de Français, Grand Oral, langues, brevet...).</div>
				<div class="text-justify small text-muted mt-4"><i style="color:silver;">~ au primaire ~</i><br />Les élèves, individuellement ou en groupe, réalisent des activités préparées par l'enseignant, de façon autonome ou encadrée : récitation, lecture expressive, lecture dialoguée, comptine, chanson, jeux rythmiques, répétition de structures syntaxiques, exposé...</div>
			</div>

			<div class="col-md-3 mb-5">
				<p class="text-success">TOUT LE MONDE</p>
				<div class="text-monospace small mb-1">CAPSULES AUDIO</div>
				<div class="text-justify small text-muted">Enregistrement libre de capsules audio pour les travaux scolaires, les préparations aux épreuves orales, les émissions webradio, la création de podcasts ou pour s'entraîner de façon autonome. Téléchargement des fichiers audio au format mp3.</div>
				<div class="text-center text-monospace mt-3"><a class="btn btn-light btn-sm" href="capsule" role="button" style="color:gray"><i class="fas fa-microphone-alt mr-2"></i>créer une capsule audio</a></div>
			</div>

		</div><!-- /row -->

	</div><!-- /container -->

	<div class="container">
		<div class="row pt-5">
			<div class="col-md-8 offset-md-2">
				<p class="text-center text-muted text-monospace small">tutoriel vidéo réalisé par <a href="https://twitter.com/JohannNallet" target="_blank">Johann Nallet</a></p>
				<p class="text-center text-monospace small" style="color:silver;font-size:80%">attention : le site évoluant régulièrement, l'interface peut avoir légèrement changé sur certaines pages</p>
				<div class="embed-responsive embed-responsive-16by9" style="border-radius:5px;">
  					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/UCGT1POExrg?rel=0" allowfullscreen></iframe>
				</div>
			</div>
		</div><!-- /row -->
	</div><!-- /container -->	

	@include('inc-footer-welcome')
	@include('inc-bottom-js')
	@include('inc-bottom')

</body>
</html>
