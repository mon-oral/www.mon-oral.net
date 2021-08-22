@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
		@include('inc-meta')
		<title>Console - Commentaires</title>
	</head>
		
	<body>	
	
		<?php
		$user = Auth::user();
		$commentaires = App\Commentaire::where([['user_id', $user->id],['dossier',0],['type',NULL]])->orderBy('created_at', 'desc')->get();
		$commentaires_dossiers = App\Commentaires_dossier::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
		?>
		
		<!-- SUPPRIMER - CONFIRMATION -->
		<div id="supprimer" class="modal fade" tabindex="-1" aria-labelledby="supprimerLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-body text-center">
					<p class="text-monospace text-muted">suppression ?</p>
					<a tabindex="0" id="supprimer_lien" href="" role="button" class="btn btn-danger btn-sm">confirmer</a>
					<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">annuler</button>
					</div>
				</div>
			</div>
		</div>		
		
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
								<h2 class="m-0">COMMENTAIRES AUDIO</h2>
								<p class="mb-3 small font-italic" style="color:silver;">capsules audio créées par les enseignants pour les élèves (correction orale de devoirs, consignes orales, explications...)</p>
								
								<div class="mt-3 mb-3">
									<a href="/console/commentaires/dossier-creer" style="background-color:#ffe791;border:solid 1px #ffe791; border-radius:4px; padding:5px; margin-bottom:10px; color:#eecb49;" data-toggle="tooltip" data-placement="top" title="créer un dossier"><i class="fas fa-plus fa-xs pl-2 pr-2"></i></a>
								</div>

								<?php	
								if (count($commentaires_dossiers) != 0){
									foreach($commentaires_dossiers as $commentaires_dossier){
										?>
										<div style="position:relative;background-color:#ffe791;border:solid 1px #ffe791; border-radius:4px; padding:10px; margin-bottom:10px; color:#eecb49;">
											<div style="position:absolute;right:8px;top:8px;"><a tabindex="0" role="button" class="text-muted" style="cursor:pointer;outline:none;" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="<a class='btn btn-light btn-sm' href='/console/commentaires/dossier-modifier/{{$commentaires_dossier->id}}' role='button'>modifier</a>"><i class="fas fa-ellipsis-v"></i></a></div>
										
											<i class="fas fa-folder fa-lg mr-2"></i> <a href="/console/commentaires/dossier/{{ $commentaires_dossier->id }}" class="text-dark">{{ $commentaires_dossier->nom }}</a>
										</div>
										<?php
									}
								}
								
								if (count($commentaires) == 0){
									?>
									<div class="mt-5 text-monospace small text-muted">Aucun commentaire pour l'instant. <a href="/console/commentaire-creer">Créer un commentaire</a>.</div>
									<?php
								} else {
									
									?>
									<div class="mt-4 mb-2">
										<a tabindex='0' class='text-muted small' style="cursor:pointer;outline:none;vertical-align:2px;" role='button' data-toggle="modal" data-target="#liste"><i class="fas fa-print ml-1 mr-1"></i> imprimer la liste des liens</i></a>
									</div>
									<?php
								
									foreach($commentaires as $commentaire) {
										?>
										<div id="card_{{ $commentaire->id }}" class="card mb-2">
										
											<div class="card-body p-3">

												<!-- options -->
												<div style="position:absolute;right:8px;top:8px;">
													<a tabindex="0" role="button" class="text-muted" style="cursor:pointer;outline:none;" data-toggle="popover" data-trigger="focus" data-placement="left" data-html="true" data-content="<a class='btn btn-light btn-sm' href='/console/commentaire-modifier/{{$commentaire->id}}' role='button'>modifier</a><a tabindex='0' id='/console/commentaire-supprimer/{{ Crypt::encryptString($commentaire->id) }}' class='ml-2 btn btn-danger btn-sm text-light' role='button' onclick='supprimer(this)'><i class='fas fa-trash fa-sm'></i></a>"><i class="fas fa-ellipsis-v"></i></a>
												</div>
												<!-- /options -->
											
												<div style="line-height:1">
													<table>
														<tr>
															<td>
																<a data-toggle="collapse" role="button" href="#commentaire-{{$commentaire->id }}" style="color:black" aria-expanded="false" aria-controls="commentaire-{{$commentaire->id }}"><i class="fas fa-plus-square pr-2 text-muted"></i></a>
															</td>
															<td style="width:60%">{{ $commentaire->titre }}</td>
															<td style="width:40%">
																<a href="https://www.mon-oral.net/c/{{ $commentaire->code_audio }}" class="text-monospace text-muted small" target="_blank">www.mon-oral.net/c/{{ $commentaire->code_audio }}</a>
															</td>
														</tr>
													</table>

												</div>

												<div class="collapse" id="commentaire-{{$commentaire->id }}">

													<table class="small m-4">
														<tr>
															<td class="pt-3" style="font-size:150%"><i class="fas fa-calendar-week mr-2 text-muted"></i></td>
															<td class="pt-3 text-muted" style="width:100%">
																{{ date("d-m-Y", strtotime($commentaire->created_at)) }}
															</td>
														</tr>														
														<tr>
															<td class="pt-3" style="font-size:140%"><i class="fa fa-link mr-2 text-muted"></i></td>
															<td class="pt-3" style="width:100%;color:silver;">
																lien à fournir aux élèves : <a href="https://www.mon-oral.net/c/{{ $commentaire->code_audio }}" class="text-monospace text-muted" target="_blank">www.mon-oral.net/c/{{ $commentaire->code_audio }}</a>
															</td>
														</tr>														
														<tr style="line-height:10px;">
															<td class="pt-4" style="font-size:150%"><i class="fas fa-volume-up mr-4 text-muted"></i></td>
															<td class="pt-4" style="width:100%">
																<audio controls style="width:100%"><source src="/s/{{$commentaire->code_audio}}" type="audio/mpeg"></audio>
															</td>
															<td class="pt-4">
																<a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-commentaire/{{$commentaire->code_audio}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
															</td>															
														</tr>	
														<tr>
															<td class="pt-4" style="font-size:180%"><i class="fas fa-qrcode mr-4 text-muted"></i></td>
															<td class="pt-4" style="width:100%">QR code : <img src="https://api.qrserver.com/v1/create-qr-code/?data={{urlencode('mon-oral.net/c/' . session()->get('code_commentaire'))}}&amp;size=100x100" style="width:100px" alt="mon-oral.net/c/{{ session()->get('code_commentaire') }}" data-toggle="tooltip" data-placement="right" title="clic droit + 'Enregistrer l'image sous...' pour sauvegarder l'image du code" />
															</td>
														</tr>
														<tr>
															<td class="pt-4" style="font-size:150%"><i class="fas fa-code mr-4 text-muted"></i></td>
															<td class="pt-4 text-muted" style="width:100%">Code pour intégrer le lecteur dans une page HTML :
															<div class="text-monospace mt-1 p-3" style="background-color:#2c3e50; color:#ecf0f1; border-radius:3px;">
															&lt;audio controls="controls"&gt;<br />&nbsp;&nbsp;&lt;source src="https://www.mon-oral.net/s/{{$commentaire->code_audio}}" type="audio/mpeg"&gt;<br />&lt;/audio&gt;
															</div>
															</td>
														</tr>
														<tr>
															<td class="pt-4" style="font-size:200%"><i class="far fa-file-audio text-muted"></i></td>
															<td class="pt-4 text-muted" style="width:100%">Lien direct :
															<div class="text-monospace mt-1 p-3" style="background-color:#2c3e50; border-radius:3px;">
															<a href="https://www.mon-oral.net/s/{{$commentaire->code_audio}}" class="text-monospace" style="color:#ecf0f1" target="_blank">https://www.mon-oral.net/s/{{$commentaire->code_audio}}</a>
															</div>
															</td>
														</tr>																
														<tr>
															<td class="pt-4" style="font-size:150%"><i class="fas fa-download mr-4 text-muted"></i></td>
															<td class="pt-4 text-muted text-justify">Pour télécharger votre fichier audio, cliquez sur les trois petits points verticaux à droite du lecteur. Si les trois petits points verticaux n'apparaissent pas (cela dépend des navigateurs), faites un clic droit sur le lecteur. Le fichier audio est au format mp3.</td>
														</tr>								
													</table>
													
												</div>

											</div>
										</div>
										<?php
									}
								}
								?>
								

								
								<div id="liste" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="listeLabel" aria-hidden="true">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div id="print-content" class="modal-body">
												<table class="text-muted table table-bordered" style="width:100%">
												<?php
												foreach($commentaires as $commentaire) {
													?>
													<tr><td class="p-2">{{$commentaire->titre}}</td><td class="text-monospace p-2">https://www.mon-oral.net/c/{{$commentaire->code_audio}}</td><td class="p-2 text-center"><img src="https://api.qrserver.com/v1/create-qr-code/?data={{urlencode('mon-oral.net/c/' . $commentaire->code_audio)}}&amp;size=100x100" /></td></tr>
													<?php
												}
												?>
												</table>
											</div>
											<div class="modal-footer">
												<button class="btn btn-light btn-sm" data-dismiss="modal" aria-hidden="true">annuler</button>
												<button class="btn btn-primary btn-sm" id="print-button">imprimer</button>
											</div>												
										</div>
									</div>
								</div>
						
							</div>
						</div>
						
					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->

		@include('inc-bottom')
		@include('inc-bottom-js')
		
		<script>
		// PRINT MODAL		
		document.getElementById("print-button").onclick = function () {
			printElement(document.getElementById("print-content"));
		};

		function printElement(elem) {
			var domClone = elem.cloneNode(true);

			var $printSection = document.getElementById("printSection");

			if (!$printSection) {
				var $printSection = document.createElement("div");
				$printSection.id = "printSection";
				document.body.appendChild($printSection);
			}

			$printSection.innerHTML = "";
			$printSection.appendChild(domClone);
			window.print();
		}	
		// /PRINT MODAL

		$.fn.tooltip.Constructor.Default.whiteList['*'].push('onclick');
		
		function supprimer(item) {
			$('#supprimer').modal('show');
			$('#supprimer_lien').attr("href", item.id);
		}

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