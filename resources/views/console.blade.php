@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Console</title>
</head>

<body>

	@include('inc-nav-console')

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-2">
				@include('inc-sidebar')
			</div>

			<div class="col-md-10">

				@if (session('status'))
					<div class="text-success text-monospace text-center pb-4" role="alert">
						{{ session('status') }}
					</div>
				@endif

				<div class="collapse" id="conseils">
					<div class="row pb-5">
						<div class="col-md-10 offset-md-1">
							<ul class="text-justify text-muted">
								<li class="pb-2"><b>Avant une première utilisation avec les élèves, faire une démonstration en classe</b> pour expliquer les étapes et insister sur les points importants: tester le micro et les écouteurs avant de débuter une activité, vérifier que l'appareil est correctement alimenté ou que la batterie est suffisamment chargée, s'assurer que l'appareil ne se mettra pas en veille pendant l'activité, utiliser de préférence un ordinateur ou un portable récent et à jour, éviter le navigateur Safari...</li>
								<li class="pb-2">Certains élèves ont tendance à prétexter le "problème technique" en cas d'enregistrement raté. Or, jusqu'à présent, tous les enregistrements "ratés" étaient liés à une mauvaise manipulation (volontaire ou involontaire) ou à un manque de préparation: rafraichissement d'une page pendant un entraînement, arrêt de l'entraînement en cours de route, absence de vérification du micro et des écouteurs, batterie insuffisamment chargée, appareil qui se met en veille...</li>
								<li class="pb-2">Cependant, des bugs sont toujours possibles. Si des élèves rencontrent des difficultés, vous pouvez faire remonter l'information en envoyant un courriel à <a href="mailto:contact@mon-oral.net">contact@mon-oral.net</a> décrivant le problème ainsi que l'environnement utilisé (système d'exploitation, type d'appareil, nom du navigateur...).</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="row mb-5">
					<div class="col-md-6 offset-md-3 text-muted text-justify">
						<br />
						<h2>Activités</h2>
						<p>
							Activités orales à proposer aux élèves : récitation, lecture expressive, description d'image / schéma / graphique...<br />
						</p>
						<br />
						<h2>Entraînements</h2>
						<p>
							Entraînements aux épreuves orales de collège et de lycée avec temps de préparation, tirage au sort de sujets et chronométrage.<br />
						</p>
						<br />
						<h2>Commentaires</h2>
						<p>
							Création de capsules audio pour les élèves : correction orale de copies, consignes, explications...<br />
						</p>
					</div>
				</div>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom')
	@include('inc-bottom-js')

</body>
</html>
