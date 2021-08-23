@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<title>Console</title>

	</head>

	<body>

		<?php
		$user = Auth::user();
		$entrainements = App\Entrainement::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
		$commentaires = App\Commentaire::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
		//$grandoral_entrainements = App\Grandoral_entrainement::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
		?>
				
		@include('inc-nav-console')

		<div class="container mt-4 mb-5">

			<div class="row pt-3">

				<div class="col-md-2">
					@include('inc-sidebar')
				</div>

				<div class="col-md-10 pl-5 pr-5">

					@if (session('status'))
						<div class="text-success text-monospace text-center pb-4" role="alert">
							{{ session('status') }}
						</div>
					@endif


					<div class="collapse" id="conseils">
						<div class="row pb-5">
							<div class="col-md-12">
								<ul class="text-justify text-muted">
									<li class="pb-2"><b>Avant une première utilisation avec les élèves, faire une démonstration en classe</b> pour expliquer les étapes et insister sur les points importants: tester le micro et les écouteurs avant de débuter une activité, vérifier que l'appareil est correctement alimenté ou que la batterie est suffisamment chargée, s'assurer que l'appareil ne se mettra pas en veille pendant l'activité, utiliser de préférence un ordinateur ou un portable récent et à jour, éviter le navigateur Safari...</li>
									<li class="pb-2">Certains élèves ont tendance à prétexter le "problème technique" en cas d'enregistrement raté. Or, jusqu'à présent, tous les enregistrements "ratés" étaient liés à une mauvaise manipulation (volontaire ou involontaire) ou à un manque de préparation: rafraichissement d'une page pendant un entraînement, arrêt de l'entraînement en cours de route, absence de vérification du micro et des écouteurs, batterie insuffisamment chargée, appareil qui se met en veille...</li>
									<li class="pb-2">Cependant, des bugs sont toujours possibles. Si des élèves rencontrent des difficultés, vous pouvez faire remonter l'information en envoyant un courriel à <a href="mailto:contact@mon-oral.net">contact@mon-oral.net</a> décrivant le problème ainsi que l'environnement utilisé (système d'exploitation, type d'appareil, nom du navigateur...).</li>
									<!--<li>Vous pouvez aussi utiliser le <a href="https://monoraldotnet.flarum.cloud/" target="_blank">forum</a>.</li>-->
								</ul>
							</div>
						</div>
					</div>

					<div class="row mb-5">
						<div class="col-md-12 text-center p-1 mt-4">
							<a href="{{route('entrainement-creer')}}" class="btn btn-success" role="button" data-toggle="tooltip" data-placement="top" title="créer un entraînement"><i class="fas fa-plus pr-2 fa-xs"></i>entraînement</a><i class="fas fa-info-circle" style="color:silver;vertical-align:18px;margin-left:-6px;" data-toggle="tooltip" data-placement="right" title="entraînement aux épreuves orales de collège et de lycée avec temps de préparation, tirage au sort de sujets et chronométrage"></i>

							<a href="{{route('commentaire-creer')}}" class="btn btn-success ml-3" role="button" data-toggle="tooltip" data-placement="top" title="créer un commentaire audio"><i class="fas fa-plus pr-2 fa-xs"></i>commentaire</a><i class="fas fa-info-circle" style="color:silver;vertical-align:18px;margin-left:-6px;" data-toggle="tooltip" data-placement="right" title="capsule audio créée par l'enseignant pour les élèves (correction orale de copies, consignes orales, explications...)"></i>

							<a href="{{route('activite-creer')}}" class="btn btn-success ml-3" role="button" data-toggle="tooltip" data-placement="top" title="créer une activité audio"><i class="fas fa-plus pr-2 fa-xs"></i>activité</a><i class="fas fa-info-circle" style="color:silver;vertical-align:18px;margin-left:-6px;" data-toggle="tooltip" data-placement="right" title="activité orale à faire par les élèves : récitation, lecture expressive, explications... sans chronomètre  - plusieurs essais possibles"></i>
						</div>
						<!--
						<div class="col-md-6 text-center p-1">
							<a href="{{route('grandoral-creer-get')}}" class="btn btn-primary" role="button" data-toggle="tooltip" title="créer un nouveau entraînement"><i class="fas fa-plus pr-2"></i>Grand Oral &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</a>
						</div>
						-->
					</div>

				</div>
			</div>

		</div><!-- /container -->

		@include('inc-bottom')
		@include('inc-bottom-js')

		<script>
		function active(id){
			opacity = document.getElementById("card_"+id).style.opacity;
			if (opacity == 1) {
				opacity_value = 0.5;
			} else {
				opacity_value = 1;
			}
			document.getElementById("card_"+id).style.opacity=opacity_value;
			$.ajax({
			   url : '/console',
			   type : 'POST', // Le type de la requête HTTP, ici devenu POST
				data:{
					'entrainement_id': id,
					'_token': '{{ csrf_token() }}',
				},
				success: function(html){
					console.log(html);
				 }
			});
		}
		</script>

	</body>
</html>
