@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Console</title>
</head>

<body>

	@include('inc-nav-console-accueil')

	@if (Auth::user()->etablissement_type == NULL)
		<div class="container mb-5">
			<div class="row">
				<div class="col-md-8 offset-md-2">
					DEMANDE D'INFORMATION COMPLÉMENTAIRE
					<br />
					<br />
					<form method="POST" action="{{ route('maj-renseignements') }}">
						@csrf
						<div class="form-group row mb-0">
							<label for="etablissement_type" class="col-md-6 col-form-label text-md-right mt-0 pt-0">Votre établissement est un établissement:</label>
							<div class="col-md-6">
								<div class="form-group">
									<select name="etablissement_type" class="custom-select @error('etablissement_type') is-invalid @enderror">
										<option></option>
										<option value="public">public</option>
										<option value="private">privé</option>
									</select>
								</div>
								@error('etablissement_type')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>                            
						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-6">
								<button type="submit" id="inscription" class="btn btn-primary pl-4 pr-4"><i class="fas fa-check"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@php
		exit();
		@endphp
	@endif

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

				{!!$message_1 ?? ''!!}
				{!!$message_2 ?? ''!!}

				@if (Auth::user()->etablissement_type == 'private' AND strpos(Auth::user()->email, 'lfitokyo') === false AND strpos(Auth::user()->email, 'aefe') === false)
					<div class="row mt-3 mb-3">
						<div class="col-md-10 offset-md-1 text-muted text-justify text-monospace small" style="background-color:white;padding:15px;border:solid 1px silver;border-radius:4px;">
							Développé et maintenu par des enseignants, ce site est ouvert à tous les professeurs et formateurs, que la structure soit publique ou privée.<br />
							Si votre établissement ou votre département souhaite soutenir le projet, il est possible de le faire en cliquant sur le bouton ci-dessous.
							<div class="text-center mt-1 mb-2">
								<a class="btn btn-light btn-sm" href="https://www.mon-oral.net/soutien" role="button" target="_blank"><i class="text-danger fas fa-heart"></i> soutenir ce projet</a></a>
							</div>
							Le seul but est de couvrir les frais d'hébergement et de renouvellement du nom de domaine car le site ne bénéficie pas de financement extérieur. Cet encart sera retiré quand les coûts seront couverts.<br />Remarque: les dons d'enseignants ne sont pas acceptés car ce n'est pas à eux de financer un outil de travail
						</div>
					</div>
				@endif

				<div class="row mb-5">
					<div class="col-md-10 offset-md-1 text-muted text-justify">
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
							Création de capsules audio pour les élèves : correction orale de copies, consignes, explications... avec liens et QR codes.<br />
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
