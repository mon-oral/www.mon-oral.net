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

	<!-- MODAL -->
	<div id="modal-info" tabindex="-1" aria-labelledby="odal-info" aria-hidden="true" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="fermer">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-4">
					<div class="text-danger text-justify">
					<b>IMPORTANT</b><br />Utiliser un appareil relativement récent et à jour, vérifier la batterie avant de commencer et s'assurer que l'appareil ne se mettra pas en veille.
					</div>
					<div class="card border-success mt-3 mb-3">
						<div class="card-body text-success">
							Conseil : avant de faire un enregistrement de plusieurs minutes, faites un enregistrement de quelques secondes pour vérifier que votre microphone et vos haut-parleurs ou écouteurs fonctionnent correctement.
						</div>
					</div>
					<div>
						<b>Configurations recommandées</b>
						<ul>
							<li>Chrome / Firefox + Windows</li>
							<li>Chrome / Firefox / Safari + macOS</li>
							<li>Chromebook</li>
							<li>Chrome + Android</li>
							<li>Safari + iOS (le micro ne fonctionne pas avec d\'autres navigateurs)</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- /MODAL -->

	@include('inc-nav-with-register')

	<div class="container">

		<?php
		if (isset($_GET['a']) AND $_GET['a'] == 'supprimer'){
			echo '<div class="text-center text-danger text-monospace">votre compte a été supprimé !</div>';
		}
		?>

		<div class="row">

			<div class="col-md-3 text-muted mt-4">
				<p class="text-center"><img src="{{ asset('img/quote-left.svg') }}" style="margin-right:6px;" width="18" />Pratique de l'oral au primaire<br />et au secondaire, préparation aux épreuves orales de collège et<br />de lycée <span style="color:silver">&amp;</span> création de commentaires audio pour les élèves<img src="{{ asset('img/quote-right.svg') }}" style="margin-left:6px;" width="18" /></p>
				<p class="text-justify text-monospace small mt-5" style="color:silver">Pas de compte à créer pour les élèves, pas de logiciel à installer.</p>
				<p class="text-justify text-monospace small m-0" style="color:silver">Multiplateforme : Windows, MacOS, Linux, téléphones ou tablettes (iOS ou Android)... Un navigateur web suffit.</p>
				<div class="text-center mt-4"><a class="btn btn-primary btn-sm" href="/presentation" role="button">présentation</a></div>
			</div>

			<div class="col-md-4 text-muted pl-5 pr-5 mt-4">

				<!-- ENREGISTREMENT -->
				<div id="interface" class="text-center mb-4 h-100 d-inline-block" style="border:4px dashed #e8eaeb;border-radius:8px;padding:10px;position:relative">
					<div style="position:absolute;top:10px;right:12px;cursor:help;">
					<i style="color:silver" class="fas fa-question-circle" data-placement="top" data-html="true" data-trigger="hover" data-toggle="popover" data-content="Enregistrement libre de capsules audio pour des travaux scolaires, des préparations aux épreuves orales, des émissions webradio, la création de podcasts ou pour s'entraîner à l'oral de façon autonome. Téléchargement des fichiers audio au format mp3."></i>
					</div>
					<div id="start_rec">
						<div class="p-2"><span id="chrono" class="chrono">00:00</span></div>
						<div class="pb-3 text-monospace text-danger" style="opacity:0.4;font-size:70%" id="max">20 minutes maximum</div>
						<a href="/capsule?a=go" id="start_button" type="button" class="btn btn-success pt-2 mt-3 btn-lg"><i class="material-icons align-middle">&#xe31d</i></a>
						<div id="start_label" class="small mt-4 text-muted text-monospace">cliquer sur le bouton ci-dessus pour débuter un enregistrement audio téléchargeable au format mp3</div>
					</div>
					<div class="text-center text-danger mt-4" style="cursor:pointer">
						<i class="fas fa-exclamation-circle fa-lg" style="opacity:0.5" data-toggle="modal" data-target="#modal-info"></i>
					</div>
				</div>
				<!-- /ENREGISTREMENT -->

			</div>

			<div class="col-md-5 mt-4" style="background-color:#f2f4f6;border-radius:6px;padding:10px 22px 14px 22px;">
				<div class="pb-2 small text-monospace text-center" style="color:silver">sujets conçus par les enseignants <i style="color:silver;cursor:help;" class="fas fa-question-circle" data-placement="top" data-html="true" data-trigger="hover" data-toggle="popover" data-content="Pour créer des activités, des entraînements ou des commentaires audio à destination des élèves, les enseignants peuvent créer un compte en cliquant, en haut à droite de cette page, sur le bouton &quot;créer un compte&quot;"></i></div>
				<div class="card-deck">

					<div class="card" style="margin-left:7px;margin-right:7px;">
						<div class="text-center pt-4"><img src="{{ asset('img/logo-activites.png') }}" width="120" alt="Activités" /></div>
						<div class="card-body pt-0">
							<p class="card-text">
								<h2 class="text-center">Activités</h2>
								<h3>récitation, lecture expressive, explications orales...</h3>
							</p>
							<div class="text-center mt-2"><a class="btn btn-primary btn-sm" href="/activite" role="button"><i class="fas fa-check pl-2 pr-2"></i></a></div>
						</div>
					</div>

					<div class="card" style="margin-left:7px;margin-right:7px;">
						<div class="text-center pt-4"><img src="{{ asset('img/logo-entrainements.png') }}" width="120" alt="Entraînements" /></div>
						<div class="card-body pt-0">
							<p class="card-text">
								<h2 class="text-center">Entraînements</h2>
								<h3>épreuves de français, langues,<br />grand oral, brevet...</h3>
							</p>
							<div class="text-center mt-2"><a class="btn btn-primary btn-sm" href="/entrainement" role="button"><i class="fas fa-check pl-2 pr-2"></i></a></div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</div><!-- /container -->

	@include('inc-footer-welcome')
	@include('inc-bottom-js')
	@include('inc-bottom')

</body>
</html>
