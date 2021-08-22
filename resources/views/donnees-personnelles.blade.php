@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')	
	
		<title>Mon Oral</title>

	</head>
		
	<body>
		<div id="app" class="mb-5">
		
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="60" /></a></div>
						<div class="text-monospace" style="font-size:60%;color:silver;margin-top:-6px;">mon-oral.net</div>
						<div class="text-monospace small text-danger" style="padding-left:70px;margin-top:-70px;">bêta</div>
					</div>
					
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							@if (Route::has('login'))				
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle text-muted" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-lock"></i></a>
									<div class="dropdown-menu m-0 p-0" aria-labelledby="navbarDropdownMenuLink">
										<div class="text-center small p-2" style="color:#227dc7;"><b>accès enseignants</b></div>
										@auth
											<a class="dropdown-item" href="{{ url('/console') }}">console</a>
										@else
											<a class="dropdown-item" href="{{ route('login') }}">se connecter</a>
											@if (Route::has('register'))
												<a class="dropdown-item" href="{{ route('register') }}">s'inscrire</a>
											@endif
										@endauth
									</div>
								</li>						
							@endif				
						</ul>
					</div>
				</div>
			</nav>
			
			<div class="container mt-5 pt-5">
			
				<div class="row">

					<div class="col-md-8 offset-md-2 text-justify">			
<h1>Politique de protection des données</h1>
<p>Le RGPD impose une information complète et précise. Les modalités de fourniture et de présentation de cette information doivent être adaptées au contexte.</p>
La transparence permet aux personnes concernées :
<ul>
<li>de connaître la raison de la collecte des différentes données les concernant;</li>
<li>de comprendre le traitement qui sera fait de leurs données;</li>
<li>d’assurer la maîtrise de leurs données, en facilitant l’exercice de leurs droits.</li>
</ul>
<p>Pour les responsables de traitement, elle contribue à un traitement loyal des données et permet d’instaurer une relation de confiance avec les personnes concernées.</p>

<h2>Introduction</h2>
<p>mon-oral.net est amené à collecter et à traiter des informations dont certaines sont qualifiées de "données personnelles". mon-oral.net limite la collecte des données personnelles au strict nécessaire.</p>

<h2>Données traitées</h2>
<p>Les données personnelles collectées lors de la création d'un compte enseignant sont : prénom, nom, établissement, matière, adresse électronique et mot de passe. Aucun mot de passe n'est sauvegardé en clair. Tous les mots de passe sont chiffrés dans la base de données.</p>

<h2>Base légale</h2>
<p>Les données personnelles ne sont collectées qu’après consentement obligatoire de l’utilisateur. Ce consentement est valablement recueilli lors de la création du compte  (information et case à cocher). Le consentement est libre, clair et sans équivoque.</p>

<h2>Utilisation</h2>
<p>Les données que vous nous transmettez sont utilisées :</p>
<ul>
<li>dans le but de vérifier que la personne qui s’enregistre a le statut d’enseignant (grâce aux informations données et au format de l’adresse courriel);</li>
<li>dans le but de contacter la personne si nécessaire</li>
</ul>
<p>Ces données ne seront jamais cédées à un tiers ni utilisées à d’autres fins que celles détaillées ci-dessus.</p>

<h2>Hébergement des données à caractère personnel</h2>
Les données à caractère personnel collectées et traitées sont hébergées en France sur le serveur de mon-oral.net. Les données à caractère personnel collectées par mon-oral.net ne sont transmises à aucun tier. Elles sont conservées sur le serveur de mon-oral.net jusqu'à expiration (voir "Durée de conservation"). 

<h2>Durée de conservation</h2>
<p>Les enregistrements des élèves sont convervés trois mois maximum. Les données des comptes des enseignants sont conservées durant une durée maximale de 2 ans. Elles peuvent être supprimées à tout moment par l'utilisateur en cliquant, dans son espace enseignant, sur "supprimer le compte".</p>

<h2>Finalités des traitements</h2>
La collecte et le traitement des données répondent aux finalités suivantes : accéder à la console des enseignants et proposer un outil pédagogique basé sur l'expression orale.

<h2>Cookies</h2>
<p>Ce site n'utilise que deux 'cookies' nécessaires au fonctionnement du site. Ils permettent de gérer la navigation et d'éviter les attaques extérieures par injection de code malicieux via un formulaire. Ces 'cookies' ne contiennent aucune donnée personnelle et ils ont une durée de vie de trois heures.</p>

<h2>Vos droits sur les données vous concernant</h2>
<p>Vous pouvez accéder et obtenir copie des données vous concernant, vous opposer au traitement de ces données, les faire rectifier ou les effacer depuis votre espace enseignant en cliquant sur « supprimer le compte ». Vous disposez également d'un droit à la limitation du traitement de vos données. Tout demande peut être faite en écrivant à l’adresse suivante : contact@mon-oral.net</p>

<h2>Destinataires des données</h2>
<p>Seul le webmaster du site mon-oral.net a accès aux données. Vous pouvez le contacter à cette adresse : contact@mon-oral.net. </p>

<h2>Caractère obligatoire ou facultatif du recueil des données</h2>
<p>Aucun recueil de données personnelles n’est obligatoire.</p>

<h2>Exercer vos droits</h2>
<p>Pour toute information ou exercice de vos droits Informatique et Libertés sur les traitements de données personnelles gérés par la CNIL, vous pouvez contacter son délégué à la protection des données (DPO) :</p>
<ul>
<li>par ce <a href="https://www.cnil.fr/fr/webform/contactez-le-dpo-de-la-cnil" target="_blank">formulaire</a></li>
<li>ou par courrier (avec copie de votre pièce d’identité en cas d'exercice de vos droits) à l'adresse suivante:<br />
Commission Nationale de l'Informatique et des Libertés<br />
A l'attention du délégué à la protection des données (DPO)<br />
3 Place de Fontenoy<br />
TSA 80715<br />
75334 PARIS CEDEX 07</li>

				</div>
			</div><!-- /container -->
		</div><!-- /app -->
		
		@include('inc-bottom')	
		
	</body>
</html>
