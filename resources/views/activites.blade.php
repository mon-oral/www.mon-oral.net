@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
		@include('inc-meta')
		<title>Console - Activités</title>
	</head>
		
	<body>	
	
		<?php
		$user = Auth::user();
		if (isset($is_archive)){
			$activites = App\Activite::where([['user_id', $user->id],['is_archive',1]])->orderBy('created_at', 'desc')->get();
		} else {
			$activites = App\Activite::where([['user_id', $user->id],['is_archive',0]])->orderBy('created_at', 'desc')->get();
		}
		?>

		<div id="app">

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

						<div class="row">
							<div class="col-md-12">
							
								@if(isset($is_archive))
									<a class="btn btn-light btn-sm mb-5" href="/console/activites" role="button"><i class="fas fa-arrow-left"></i></a>
									<h2 class="m-0">ACTIVITÉS AUDIO - ARCHIVES</h2>
								@else
									<h2 class="m-0">ACTIVITÉS AUDIO</h2>
								@endif
							
								<p class="mb-3 small font-italic" style="color:silver;">activités orale à faire par les élèves : récitation, lecture expressive, explications... sans chronomètre  - plusieurs essais possibles</p>
								
								@if(!isset($is_archive))
									<div class="text-right mb-4"><a class='btn btn-light btn-sm text-monospace text-muted' href='/console/activites-archives' role='button'>archives</a></div>
								@endif
										
								<?php
								if (count($activites) == 0){
									?>
									@if(isset($is_archive))
										<div class="pt-1 text-monospace small text-muted">Aucune activité archivée. Pour archiver une activité, cliquer sur <i class="fas fa-ellipsis-v"></i> puis sur "archiver".</div>
									@else
										<div class="pt-1 text-monospace small text-muted">Aucune activité. <a href="activite-creer">Créer une activité</a>.</div>
									@endif
									<?php
								} else {	
								
									foreach($activites as $activite) {
										$checked = ($activite->is_active == 1) ? "checked" : "";
										$opacity = ($activite->is_active == 1) ? 1 : 0.5;		
										$action = ($activite->is_active == 1) ? 'désactiver' : 'activer';										
										$archiver = ($activite->is_archive == 0) ? 'archiver' : 'désarchiver';	

										$nb_enregistrements = App\Activites_enregistrement::where('activite_id',$activite->id)->count();																				
										?>

										<div id="card_{{ $activite->id }}"  style="opacity:{{ $opacity }}" class="card mb-2">

											<div class="card-body p-3">
											
												<!-- options -->
												<div style="position:absolute;right:8px;top:8px;"><a tabindex="0" role="button" class="text-muted" style="cursor:pointer;outline:none;" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="<a class='btn btn-light btn-sm m-1' href='/console/activite-modifier/{{ $activite->id }}' role='button'>modifier</a><a class='btn btn-light btn-sm m-1' href='/console/activite-statut/{{ $activite->id }}' role='button'>{{ $action }}</a><a class='btn btn-light btn-sm m-1' href='/console/activite-archiver/{{ $activite->id }}' role='button'>{{ $archiver }}</a>"><i class="fas fa-ellipsis-v"></i></a></div>
												<!-- /options -->

												<div class="pr-4" style="line-height:1.2">
													<a href="/console/activite-afficher/{{ $activite->id }}">{{ $activite->titre }}</a><span class="badge badge-pill badge-success ml-1" style="padding-bottom:1px;">{{ $nb_enregistrements }}</span><span class="badge badge-pill badge-light ml-1" style="cursor:pointer;background-color:#e7e9eb;padding-bottom:1px;" data-trigger="hover" data-toggle="popover" data-html="true" data-content="Date : {{ date('d-m-Y', strtotime($activite->created_at)) }}">i</span>
												</div>	
												
												<div class="small pt-2 pb-1">
													<i class="fa fa-link mr-2 text-muted"></i><span style="color:silver;">lien à fournir aux élèves : </span><a href="https://www.mon-oral.net/a/{{ $activite->code }}" class="text-monospace text-muted ml-2" target="_blank">www.mon-oral.net/a/{{ $activite->code }}</a>
												</div>

											</div>
										</div>
										<?php
									}
								}
								?>	

							</div>
						</div>
						
					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->
	
		@include('inc-bottom')
		@include('inc-bottom-js')
					
	</body>
</html>