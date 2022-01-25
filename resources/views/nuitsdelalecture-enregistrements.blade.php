@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
		@include('inc-meta')
		<title>Nuits de la lecture | Enregistrements</title>
		<style>
		body {background-color:#2169b5;}
		</style>
	</head>

	<body>

		<div id="app">

			<div class="container mb-5">

				<div class="row mt-4">
					<div class="col-md-12">
						<div class="text-center"><img class="img-fluid" src="{{ asset('img/nuitsdelalecture-top.svg') }}" alt="Nuits de la lecture" width="600" /></div>
						<div class="text-center pt-3 pl-4 pr-4"><img class="img-fluid" src="{{ asset('img/nuitsdelalecture-titre.svg') }}" alt="Nuits de la lecture" width="500" /></div>
					</div>
				</div>

				<div class="row mt-4">

					<div class="col-md-8 offset-md-2">
					<?php
					$lectures = App\Activites_enregistrement::where([['activite_id', 5]])->get();
					foreach($lectures as $lecture) {
						if (strpos($lecture->nom, '#') != FALSE) {
							$lecture_titre = explode('#', $lecture->nom);
							$lecture_siecle = trim($lecture_titre[3]);
							$lecture_auteur = trim($lecture_titre[4]);
							$lecture_extrait = trim($lecture_titre[5]);
							echo $lecture_siecle . $lecture_auteur . $lecture_extrait;
							echo '<audio controls style="width:100%;"><source src="/console/lecteur-activite/'. $lecture->code_audio .'" type="audio/mpeg"></audio>';
						}
					}
					?>

					</div>
				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom')

	</body>
</html>
