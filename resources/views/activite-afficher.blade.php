@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Console | Activité</title>
</head>

<body>

	@include('inc-nav-console')

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-2 pt-5">
				<a class="btn btn-light btn-sm" href="/console/activites" role="button"><i class="fas fa-arrow-left"></i></a>
				<div class="mt-5 text-left">
					<a class='btn btn-light btn-sm' href='/console/activite-modifier/{{ $activite_id }}' role='button'>modifier</a>
				</div>
			</div>

			<div class="col-md-10 pt-5">

				<?php
				$activite = App\Activite::where([['user_id', Auth::user()->id],['id', $activite_id]])->first();

				if ($activite === null){
					?>
					<div class="text-danger text-monospace text-center">Cette activité n'existe pas !</div>
					<?php
				} else {
					?>

					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<h1 class="mb-0">{{ $activite->titre }}</h1>
					<?php if ($activite->soustitre != '') echo '<p style="color:#84a9c7;font-style:italic;margin:-4px 0px 0px 0px;">' . $activite->soustitre . '</p>';?>
					<p class="mb-2 small text-monospace" style="color:#bdc3c7;">{{ date("d-m-Y", strtotime($activite->created_at)) }}</p>

					<div class="small text-muted pb-1">
						<i class="fa fa-link mr-2" aria-hidden="true"></i> <span class="text-monospace">www.mon-oral.net/a/{{ $activite->code }}</span>
					</div>
					<div class="small text-muted pb-1">
						<i class="fa fa-shield mr-2" aria-hidden="true"></i> <span class="text-monospace">{{ $activite->code }}</span>
					</div>

					<br />
					<br />

					<h2>Sujet / consignes</h2>
					<?php
					if ($activite['consignes'] != ''){
						$consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($activite->consignes));
						$consignes = \Illuminate\Mail\Markdown::parse($consignes);
						?>
						<div class="card"><div class="card-body"><?php echo $consignes ?></div></div>
						<?php
					} else {
						?>
						<div class="text-monospace small" style="color:silver">pas d'instructions / consignes pour cette activité</div>
						<?php
					}?>

					<br />
					<br />

					<h2>Enregistrements <span class="ml-1 small" style="color:#f39c12"><i class="fas fa-exclamation-circle" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="les enregistrements des élèves ont une durée de vie de trois mois"></i></span></h2>
					<?php
					$enregistrements = App\Activites_enregistrement::where('activite_id',$activite->id)->orderBy('nom', 'asc')->orderBy('created_at', 'asc')->get();
					?>

					<div class="mt-2 mb-2">
						<a href="{{ url('') }}/activite-cr/{{ Crypt::encryptString($activite->id) }}" class='text-muted'><i class="fas fa-print ml-1 mr-1"></i> afficher / imprimer tous les comptes-rendus</i></a>
					</div>

					<?php
					if (count($enregistrements) != 0) {

						foreach ($enregistrements as $enregistrement) {
							?>

							{{-- PRINT --}}
							<div id="print_cr_modal_{{ $enregistrement->id }}" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="print_cr_modal_{{ $enregistrement->id }}Label" aria-hidden="true">
								<div class="modal-dialog modal-xl">
									<div class="modal-content">

										<div id="print_cr_content_{{ $enregistrement->id }}" class="modal-body" style="width:100%;">

											<h1><span class="badge badge-light text-monospace">{{ $enregistrement->nom }}</span></h1>

											<p class="text-uppercase mt-3 mb-0">{{ $activite->titre }}</p>
											<p class="text-monospace mb-0" style="font-size:80%;color:silver;">{{ date("d-m-Y", strtotime($enregistrement->created_at)) }}</p>

											<?php
											if ($activite['consignes'] != ''){
												$consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($activite->consignes));
												$consignes = \Illuminate\Mail\Markdown::parse($consignes);
												?>
												<div class="card"><div class="card-body"><?php echo $consignes ?></div></div>
												<?php
											} else {
												?>
												<div class="card"><div class="card-body text-monospace small text-muted">pas d'instructions / consignes pour cette activité</div></div>
												<?php
											}?>
											<p class="text-monospace text-uppercase mt-4 mb-0">Commentaires / correction / conseils</p>
											<div class="card">
												<div class="card-body">
													<p id="cr_texte_{{$enregistrement->id }}_print"><?php echo nl2br($enregistrement->cr_texte) ?></p>
												</div>
											</div>
											@if ($enregistrement->cr_audio)
											<p>Ecouter : <span class="text-monospace">{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}</span></p>
											@endif

											<div class="text-center mt-2">
												<div>- consuter en ligne -</div>
												<div class="text-monospace text-muted"><a href="{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}" target="_blank">{{ url('') }}/acr/{{ base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT)) }}</a></div>
												<div class="p-2"><img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode(url('').'/acr/' . base64_encode(str_pad($enregistrement->id, 6, "0", STR_PAD_LEFT))) }}&amp;size=100x100" /></div>
											</div>

										</div>

										<div class="modal-footer">
											<button class="btn btn-light btn-sm" data-dismiss="modal" aria-hidden="true">annuler</button>
											<button class="btn btn-primary btn-sm" onclick="print_cr_modal('{{ $enregistrement->id }}')">imprimer</button>
										</div>

									</div>
								</div>
							</div>
							{{-- /PRINT --}}

							<?php
							$opacity = ($enregistrement->is_checked == 1) ? 0.3 : 1;
							$checked = ($enregistrement->is_checked == 1) ? "checked" : "";
							$display = ($enregistrement->is_checked == 1) ? "none" : "block";
							?>

							<div id="card_{{ $enregistrement->id }}"  style="opacity:{{ $opacity }}" class="card mb-2">

								<div class="card-body p-3">
									<div class="text-muted">

										{{-- VU / NON VU --}}
										<div id="checkbox_{{ $enregistrement->id }}" style="display:inline;" class="custom-control custom-checkbox">
											<input id="is_checked_{{$enregistrement->id}}" type="checkbox" class="custom-control-input" {{ $checked }} />
										  	<label style="cursor:pointer;" class="custom-control-label" for="is_checked_{{$enregistrement->id}}" onclick="checked({{ $enregistrement->id }})" ></label>
										</div>
										{{-- /VU / NON VU --}}

										<i class="fas fa-user pr-2"></i>{{ $enregistrement->nom }}
										<i class="fas fa-calendar-day pl-4 pr-2"></i><span class="text-monospace small">{{ date("d-m-Y", strtotime($enregistrement->created_at)) }}</span>
									</div>

									<div id="enregistrement_frame_{{ $enregistrement->id }}" class="mt-3" style="display:{{ $display }}">

									@if(File::exists(storage_path() . '/app/public/audio-activites/glensaeqmd/@' . $enregistrement->code_audio . '.mp3'))

										<table>
											<tr style="line-height:10px">
												<td style="width:100%">
													<audio controls style="width:100%;"><source src="/console/lecteur-activite/{{ $enregistrement->code_audio }}" type="audio/mpeg"></audio>
												</td>
												</td>
												<td>
													<a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-activite/{{$enregistrement->code_audio}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
												</td>
												<td>
													<?php
													$display_pen_active = ($enregistrement->cr_texte) ? 'none':'block';
													$display_pen_inactive = ($enregistrement->cr_texte) ? 'block':'none';
													?>

													<div id='pen_inactive_{{ $enregistrement->id }}' class='btn btn-success btn-sm' style='display:{{ $display_pen_inactive }};font-size:16px;height:40px;padding:7px 12px 0px 12px;cursor:not-allowed;opacity:0.2'><i class='fas fa-pen-alt' style='opacity:0.8'></i></div>

													<a id='pen_active_{{ $enregistrement->id }}' class='btn btn-success btn-sm' style='display:{{ $display_pen_active }};font-size:16px;height:40px;padding:7px 12px 0px 12px;opacity:0.4;' data-toggle='collapse' href='#cr_texte_{{ $enregistrement->id }}' role='button' aria-expanded='false' aria-controls='cr_texte_{{ $enregistrement->id }}' onclick='switch_pen_status({{ $enregistrement->id }})'><i class='fas fa-pen-alt'></i></a>

												</td>
												<td>
													@if($enregistrement->cr_audio)
														<div class='btn btn-success btn-sm btn-block' style='font-size:17px;height:40px;padding:7px 14px 0px 14px;cursor:not-allowed;opacity:0.2'><i class='fas fa-microphone' style='opacity:0.8'></i></div>
													@else
														<form method='POST' action='{{ route('activite-cr-audio-creer-post') }}'>
														@csrf
														<input type='hidden' name='redirect_url' value='/console/activite-afficher/{{ $activite_id }}#card_{{ $enregistrement->id }}' />
														<input type='hidden' name='enregistrement_id' value='{{ $enregistrement->id }}' />
														<button type='submit' class='btn btn-success btn-sm btn-block' style='font-size:17px;height:40px;padding:2px 14px 0px 14px;opacity:0.4;'><i class='fas fa-microphone'></i></button>
														</form>
													@endif
												</td>
											</tr>
										</table>

										<?php

										// SI CR AUDIO
										if ($enregistrement->cr_audio) {
											$cr_audio = App\Commentaire::find($enregistrement->cr_audio);
											?>

											<div class="mt-1 p-2" style="background-color:#dff0e5;border-radius:4px;">
												<table>
													<tr style="line-height:10px">
														<td style="width:100%">
															<audio controls style="width:100%;"><source src="/s/{{$cr_audio->code_audio}}" type="audio/mpeg"></audio>
														</td>
														<td>
															<a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-commentaire/{{$cr_audio->code_audio}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
														</td>
														<td>
															<a tabindex="0" class="ml-2 mr-2 small text-muted" role="button" style="cursor:pointer;outline:none;" data-trigger="focus" data-container="body" data-placement="left" data-toggle="popover" data-html="true" data-content="<a class='btn btn-danger btn-sm' href='/console/activite-cr-audio-supprimer/{{ Crypt::encryptString($enregistrement->cr_audio) }}' role='button'>confirmer</a> <a tabindex='0' class='btn btn-secondary btn-sm text-light' role='button'>annuler</a>"><i class="fas fa-trash"></i></a>
														</td>
													</tr>
												</table>
											</div>

											<?php
										}
										?>

										<!-- cr texte collapse -->
										<div class="collapse @if ($enregistrement->cr_texte) show @endif" id="cr_texte_{{$enregistrement->id }}">

											<div class="mt-1 p-2" style="background-color:#dff0e5;border-radius:4px;">
												<textarea class="form-control" id="cr_textarea_{{$enregistrement->id }}" rows="3" onkeyup="show_save({{ $enregistrement->id }})">{{ $enregistrement->cr_texte }}</textarea>
												<div class="row">
													<div class="col-md-6 text-left">
														<button type="submit" id="cr_texte_submit_{{$enregistrement->id }}" class="btn btn-light btn-sm mt-1" style="opacity:1" onclick="cr_texte_sauvegarde({{ $enregistrement->id }})" data-toggle="tooltip" data-placement="right" title="sauvegarder les modifications"><i class="fas fa-save"></i></button>
													</div>
													<div class="col-md-6 text-right pt-2">
														<a tabindex="0" class="ml-2 mr-2 small text-muted" role="button" style="cursor:pointer;outline:none;" data-trigger="focus" data-container="body" data-placement="left" data-toggle="popover" data-html="true" data-content="<a class='btn btn-danger btn-sm' href='/console/activite-enregistrement-cr-texte-effacer/{{ Crypt::encryptString($enregistrement->id) }}' role='button'>confirmer</a> <a tabindex='0' class='btn btn-secondary btn-sm text-light' role='button'>annuler</a>"><i class="fas fa-trash"></i></a>
													</div>
												</div>
											</div>

										</div><!-- /cr texte collapse -->

										<!-- imprimer le compte-rendu -->
										<div class="mt-2">
											<a tabindex='0' class='text-muted' style="cursor:pointer;outline:none;" role='button' data-toggle="modal" data-target="#print_cr_modal_{{ $enregistrement->id }}"><i class="fas fa-print ml-1 mr-1 text-success" style="opacity:0.5;"></i> imprimer ce compte-rendu</i></a>
										</div>

									@else
										<div class="pt-3 pb-3 ml-1 text-monospace small" style="color:#f39c12">cet enregistrement n'est plus disponible <i class="fas fa-question-circle" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="les enregistrements des élèves ont une durée de vie de trois mois"></i></div>
									@endif

									</div><!-- enregistrement-frame -->

								</div><!-- card-body -->
							</div><!-- card -->

							<?php
						}

					} else {
						?>
						<div class="text-monospace small" style="color:silver">pas d'enregistrement pour l'instant</div>
						<?php
					}

				}
				?>


			</div>

		</div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom-js')

	<script>

	// VU / NON VU
	function checked(id){
		opacity = document.getElementById("card_"+id).style.opacity;
		if (opacity == 1) {
			document.getElementById("enregistrement_frame_"+id).style.display='none';
			document.getElementById("card_"+id).style.opacity = 0.3;
		} else {
			document.getElementById("enregistrement_frame_"+id).style.display='block';
			document.getElementById("card_"+id).style.opacity = 1;
		}
		$.ajax({
		   url : '{{ url('') }}/console/activite-enregistrement-statut/'+id,
		   type : 'POST',
			data:{
				'_token': '{{ csrf_token() }}',
			},
			success: function(response){
				console.log(response);
			}
		});
	}


	// SAUVEGARDE CR TEXTE
	function show_save(id){
		texte = document.getElementById("cr_textarea_"+id).value;
		texte = texte.replace(/(?:\r\n|\r|\n)/g, '<br>');
		console.log(texte);
		document.getElementById("cr_texte_"+id+"_print").innerHTML = texte;
		document.getElementById('cr_texte_submit_'+id).style.opacity="1";
	}

	function switch_pen_status(id){
		status = document.getElementById('pen_active_'+id).style.display;
		if (status == 'block') {
			document.getElementById('pen_active_'+id).style.display = 'none';
			document.getElementById('pen_inactive_'+id).style.display = 'block';
		}
	}

	function cr_texte_sauvegarde(id){
		$('#cr_texte_submit_'+id).tooltip('hide');
		$('#cr_texte_submit_'+id).blur();
		document.getElementById('cr_texte_submit_'+id).style.opacity="0.3";
		$.ajax({
		   url : '{{ url('') }}/console/activite-enregistrement-cr-texte-sauvegarde',
		   type : 'POST',
			data:{
				enregistrement_id:id,
				cr_texte:document.getElementById("cr_textarea_"+id).value,
				_token:'{{ csrf_token() }}',
			},
			success: function(response){
				console.log(response);
			}
		});
	}


	// PRINT MODAL
	function print_cr_modal(id) {

		// close modal
		$('#print_cr_modal_'+id).modal('hide');

		// give enougth time to modal to close
		setTimeout(
			function() {

				// change width for 100% width print
				document.getElementById('print_cr_content_'+id).style.width = '100vw';

				var elem = document.getElementById('print_cr_content_'+id);
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
			},500
		)
	}

	</script>

</body>
</html>
