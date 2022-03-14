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

				<?php
				$lectures = App\Activites_enregistrement::where([['activite_id', 2134]])->get();

				// creation de la liste des lectures - pour affichage
				foreach($lectures as $index => $lecture) {
					if (strpos($lecture->cr_texte, '#') != FALSE) {
						$lecture_titre = explode('#', $lecture->cr_texte);
						$lecture_siecle = (isset($lecture_titre[0])) ? trim($lecture_titre[0]) : "-";
						$lecture_auteur = (isset($lecture_titre[1])) ? trim($lecture_titre[1]) : "-";
						$lecture_extrait = (isset($lecture_titre[2])) ? trim($lecture_titre[2]) : "-";
						$liste_lectures[$index] = ['siecle' => $lecture_siecle, 'auteur' => $lecture_auteur, 'extrait' => $lecture_extrait, 'code_audio' => $lecture->code_audio, 'autorisation' => $lecture->is_checked];
					}
				}

				// tri pour siecles
				/*
				$keys = array_column($liste_lectures, 'siecle');
				array_multisort($keys, SORT_ASC, $liste_lectures);
				dump($liste_lectures);
				*/

				// affichage lecteur audio
				$siecles = ['XVe','XVIe','XVIIe', 'XVIIIe', 'XIXe', 'XXe', 'XXIe'];
				foreach($siecles as $siecle) {
					if (in_array($siecle, array_column($liste_lectures, 'siecle'))) {
						echo '<div class="text-light pt-5">' . substr($siecle, 0, -1) . '<sup>e</sup></div>';
					}
					?>
					<div class="row row-cols-1 row-cols-md-3">
					<?php
					foreach($liste_lectures as $lecteur_audio) {
						if($siecle == $lecteur_audio['siecle'] AND $lecteur_audio['autorisation'] == 0){
							?>
							<div class="col">
								<div class="card h-100" style="background-color:#2169b5;border:none;">
									<div class="card-body" style="padding:5px 0px 30px 0px">
										<audio controls style="width:100%;"><source src="/ndll-lfit/lecteur/{{Crypt::encryptString($lecteur_audio['code_audio'])}}" type="audio/mpeg"></audio>
										<div class="pb-1" style="color:black">{{$lecteur_audio['auteur']}}<span style="color:silver"> | </span>{{$lecteur_audio['extrait']}}</div>
									</div>
								</div>
							</div>
							<?php
						}
					}
					?>
					</div>
					<?php
				}
				?>



			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom')

	</body>
</html>
