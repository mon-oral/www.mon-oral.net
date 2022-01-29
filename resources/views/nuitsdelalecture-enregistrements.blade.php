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
						<div class="text-center pt-4 pl-4 pr-4"><img class="img-fluid" src="{{ asset('img/nuitsdelalecture-enregistrements.svg') }}" alt="Nuits de la lecture" width="500" /></div>
					</div>
				</div>

				<div class="row mt-4">

					<div class="col-md-8 offset-md-2">
					<?php
					$lectures = App\Activites_enregistrement::where([['activite_id', 2134]])->get();

					// creation de la liste des lectures - pour affichage
					foreach($lectures as $index => $lecture) {
						if (strpos($lecture->cr_texte, '#') != FALSE) {
							$lecture_titre = explode('#', $lecture->cr_texte);
							$lecture_siecle_1 = (isset($lecture_titre[0])) ? trim($lecture_titre[0]) : "-";
							$lecture_siecle_2 = (isset($lecture_titre[1])) ? trim($lecture_titre[1]) : "-";
							$lecture_auteur = (isset($lecture_titre[2])) ? trim($lecture_titre[2]) : "-";
							$lecture_extrait = (isset($lecture_titre[3])) ? trim($lecture_titre[3]) : "-";
							$liste_lectures[$index] = ['siecle_1' => $lecture_siecle_1, 'siecle_2' => $lecture_siecle_2, 'auteur' => $lecture_auteur, 'extrait' => $lecture_extrait, 'code_audio' => $lecture->code_audio];
						}
					}

					// tri pour siecles
					$keys = array_column($liste_lectures, 'siecle_1');
					array_multisort($keys, SORT_ASC, $liste_lectures);
					dump($liste_lectures);

					// affichage
					foreach($liste_lectures as $lecteur_audio) {
						echo $lecteur_audio['siecle_2'] . $lecteur_audio['auteur'] . $lecteur_audio['extrait'];
						echo '<audio controls style="width:100%;"><source src="/ndll/lecteur/'. Crypt::encryptString($lecteur_audio['code_audio']) .'" type="audio/mpeg"></audio>';
					}
					?>

					</div>
				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom')

	</body>
</html>
