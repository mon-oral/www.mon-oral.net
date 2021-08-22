<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Entraînement - Erreur</title>
				
	</head>
	
	<body>	
	
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
					</div>
				</div>
			</nav>
		
			<div class="container">
									
				<div class="row mt-5">
				
					<div class="col-md-6 offset-md-3">
						<?php
						if (session()->get('page') == 'etape4') {
							?>
							<div class="alert alert-danger" role="alert">
								<p><b>ATTENTION</b></p>
								<p>Vous avez quitté votre entraînement pendant la phase de préparation / oral.</p>
								Rappels :
								<ul>
								<li>suivre les étapes les unes après les autres</li>
								<li>ne pas recharger une page même si elle met du temps à se charger</li>
								<li>ne pas revenir à la page précédente en utilisant la touche "retour arrière" ("backspace" en anglais)</li>
								</ul>
								<p class="text-center"><a class="btn btn-primary btn-sm" href="{{ route('entrainement-etape1') }}" role="button"><i class="fas fa-arrow-left align-middle pr-2"></i>retour à l'étape 1</a></p>
								<p>Si vous avez rencontré un problème technique, vous pouvez utiliser ce <a href="https://forms.gle/rTJM8rNmV26ynC8t8" target="_blank">formulaire</a> pour décrire la situation.</p>
							</div>
							<?php
						} else {
							?>
							<div class="alert alert-warning" role="alert">
								<p><b>ATTENTION</b></p>
								<p>Vous avez quitté votre entraînement avant d'arriver aux dernières étapes.</p>
								Rappels :
								<ul>
								<li>suivre les étapes les unes après les autres</li>
								<li>ne pas recharger une page même si elle met du temps à se charger</li>
								<li>ne pas revenir à la page précédente en utilisant la touche "retour arrière" ("backspace" en anglais)</li>
								</ul>
								<p class="text-center"><a class="btn btn-primary btn-sm" href="{{ route('entrainement-etape1') }}" role="button"><i class="fas fa-arrow-left align-middle pr-2"></i>retour à l'étape 1</a></p>
								<p>Si vous avez rencontré un problème technique, vous pouvez utiliser ce <a href="https://forms.gle/rTJM8rNmV26ynC8t8" target="_blank">formulaire</a> pour décrire la situation.</p>
							</div>							
							<?php
						}
						?>
					</div>

				</div>
		
			</div><!-- /container -->
		</div><!-- /app -->
		
	</body>
</html>