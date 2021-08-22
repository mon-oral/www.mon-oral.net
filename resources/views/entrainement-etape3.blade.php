<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')	
		
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />	

		<title>Entraînement - Étape 3</title>
		
	</head>

	<body>	
	
		<div class="p-2 mb-3 text-monospace text-center text-danger" style="color:#d9ae00;background-color:#f1c40f">
			<i class="fas fa-chevron-circle-right pr-2"></i>suivez les étapes - ne rechargez pas cette page - ne revenez pas en arrière<i class="fas fa-chevron-circle-left pl-2"></i>
		</div>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><img src="{{ asset('img/mon-oral.png') }}" width="40" /></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:4px;">Entraînement - Étape 3</div>
					</div>
				</div>
			</nav>

			<?php
			$entrainement = App\Entrainement::find(Session::get('entrainement_id'));
			?>
			<div class="container">	

				<div class="row mt-5">
				
					<div class="col-md-6 offset-md-3">
					
						@if ($entrainement['soustitre']) <h1 class="mb-4">{{ $entrainement['soustitre'] }}</h1>@endif

						<p><b>Préparation : </b>{{ $entrainement['temps_prep'] }} minute(s)</p>
						<p><b>Oral : </b>{{ $entrainement['temps_oral'] }} minute(s)</p>
						
						<br />
						
						<?php
						if ($entrainement['consignes'] != ''){
							$consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($entrainement['consignes']));
							$consignes = \Illuminate\Mail\Markdown::parse($consignes);		
							$consignes = str_replace('<a href=', '<a target="_blank" href=', $consignes);							
							?>						
						
							<p class="mb-0"><b>Consignes</b></p>

							<div class="card"><div class="card-body"><?php echo $consignes ?></div></div>	
						
							<br />
							<?php
						}
						?>
						
						<div class="alert alert-danger " role="alert">
							<b style="font-weight:700">ATTENTION</b> : <b style="font-weight:700">vous n'avez qu'<u>un seul essai</u>.</b><br />
							L'entraînement débute dès que vous cliquez sur "débuter l'entraînement".
						</div>
						
						<p class="text-center mt-5">
							<a class="btn btn-primary" href="{{ route('entrainement-etape4') }}" role="button">débuter l'entraînement<i class="fas fa-arrow-right align-middle pl-2"></i></a>
						</p>	
									
					</div>
					
				</div>
							
			</div><!-- /container -->
		</div><!-- /app -->
		
	</body>
</html>	