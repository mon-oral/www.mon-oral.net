<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Formulaire</title>
		<style>
		.survol span{font-size:110%}
		.survol:hover span{color:#38c172}
		.survol i{color:#34495e}
		.survol:hover i{color:#38c172}
		.survol:hover{background-color:#e9eef2;border-radius:4px;}
		a:hover {text-decoration:underline;}
		</style>
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-2px;">mon-oral.net</div>
					</div>
				</div>
			</nav>

			<div class="container mb-5">

				<div class="row">
				
					<div class="col-md-4 pt-3 text-center">
						<p><img src="{{ asset('img/AEFE_RF_logo-xs.png') }}" width="250" /></p>
					</div>					
					
					<div class="col-md-6 pt-3">
					
						
							<h1>WEBINAIRE AEFE</h1>
							<div class="text-monospace text-muted small pl-2" style="margin-top:-8px;">Présentation de mon-oral.net</div>
							<!--<div class="text-monospace small pl-2" style="color:#c5c7c9">16 décembre 2020</div>-->
							<!--<div class="text-monospace small pl-2" style="color:#c5c7c9">3 février 2021</div>-->
							<div class="text-monospace small pl-2" style="color:#c5c7c9">15 avril 2021</div>
							
							<br />
							<br />
							
							<h2 style="font-size:130%;">Élèves</h2>
							<div class="text-monospace small mb-3" style="color:#a1b6c7">pas de compte à créer &bull; rien à installer &bull; multiplateforme</div>
							
								<div class="p-2 survol">
									<div class="pl-3 text-muted">
										<i class="fas fa-arrow-right pr-2"></i> <span>Entraînements <small>(mode examen)</small></span>
									</div>
									<table class="text-muted">
										<tr>
											<td style="padding-left:40px;color:silver">Lien fourni par l'enseignant :</td>
											<td style="padding-left:5px;"><a style="color:#227dc7" href="https://www.mon-oral.net/e/NTK4MHJS" role="button">mon-oral.net/e/NTK4MHJS</a></td>
											<td class="small" style="color:silver;padding-left:10px;">(EAF / langue)</td>
										</tr>
										<tr>
											<td></td>
											<td style="padding-left:5px;"><a style="color:#227dc7" href="https://www.mon-oral.net/e/MDY2NNRP" role="button">mon-oral.net/e/MDY2NNRP</a></td>
											<td class="small" style="color:silver;padding-left:10px;">(Grand Oral)</td>
										</tr>
									</table>									
								</div>	
								
								<div class="p-2 survol">
									<div class="pl-3 text-muted">
										<i class="fas fa-arrow-right pr-2"></i> <span>Activités <small>(pas de chronométrage, essais multiples)</small></span>
									</div>

									<table class="text-muted">
										<tr>
											<td style="padding-left:40px;color:silver">Lien fourni par l'enseignant :</td>
											<td style="padding-left:5px;"><a style="color:#227dc7" href="https://www.mon-oral.net/a/NJYYN3ZJ" role="button">mon-oral.net/a/NJYYN3ZJ</a></td>
										</tr>
									</table>
								</div>
								
								<div class="p-2 survol">
									<div class="pl-3 text-muted">
										<i class="fas fa-arrow-right pr-2"></i> <span>Enregistrements libres</span>
									</div>

									<table class="text-muted">
										<tr>
											<td style="padding-left:40px;color:silver"><a style="color:#227dc7" href="https://www.mon-oral.net" role="button">création de capsules audio en autonomie</a></td>
										</tr>
									</table>
								</div>						

							<br />	
							
							<h2 style="font-size:130%;">Enseignants</h2>
							<div class="text-monospace small mb-3" style="color:#a1b6c7">rien à installer &bull; multiplateforme</div>
							
								<div class="p-2 survol">
									<div class="pl-3 text-muted">
										<i class="fas fa-arrow-right pr-2"></i> <span>Entraînements</span>
									</div>
									
									<table class="text-muted">
										<tr>
											<td style="padding-left:40px;color:silver">
											<a style="color:#227dc7" href="https://www.mon-oral.net/console/entrainement-modifier/88" role="button">créer un entraînement</a> / <a style="color:#227dc7" href="https://www.mon-oral.net/console/entrainement-afficher/88" role="button">corriger un entraînement</a></td>
										</tr>
									</table>									
								</div>	

								<div class="p-2 survol">
									<div class="pl-3 text-muted">
										<i class="fas fa-arrow-right pr-2"></i> <span>Activités</span>
									</div>
									
									<table class="text-muted">
										<tr>
											<td style="padding-left:40px;color:silver"><a style="color:#227dc7" href="https://www.mon-oral.net/console/activite-modifier/104" role="button">créer une activité</a> / <a style="color:#227dc7" href="https://www.mon-oral.net/console/activite-afficher/104" role="button">corriger une activité</a></td>
										</tr>
									</table>									
								</div>									
							
								<div class="p-2 survol">
									<div class="pl-3 text-muted">
										<i class="fas fa-arrow-right pr-2"></i> <span>Commentaires audio</span>
									</div>
									
									<table class="text-muted">
										<tr>
											<td style="padding-left:40px;color:silver"><a style="color:#227dc7" href="https://www.mon-oral.net/console/commentaires" role="button">créer des commentaires</a></td>
										</tr>
									</table>									
								</div>

					</div>
					<div class="col-md-2 pt-5"></div>
				</div>
				
			</div><!-- /container -->
			
	
			<div id="correction" style="text-align:center;margin-top:1000px;padding-top:60px;margin-bottom:2000px"><a href="#app"><img src="{{ asset('img/correction.png') }}" /></a></div>
			
		</div><!-- /app -->
	
		@include('inc-bottom')
		@include('inc-bottom-js')
	
	</body>
</html>