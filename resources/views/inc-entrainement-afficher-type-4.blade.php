<?php
$enregistrements = App\Enregistrement::where('entrainement_id',$entrainement->id)->orderBy('nom', 'asc')->orderBy('created_at', 'asc')->get();
?>

<h2>Enregistrements <span class="ml-1 small" style="color:#e74c3c"><i class="fas fa-exclamation-triangle" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="les enregistrements des élèves ont une durée de vie de trois mois"></i></span></h2>

<div class="mt-2 mb-2">
	<a tabindex='0' class='text-muted small' style="cursor:pointer;outline:none;vertical-align:2px;" role='button' data-toggle="modal" data-target="#liste"><i class="fas fa-print ml-1 mr-1"></i> imprimer la liste des corrections / commentaires audio</i></a>
</div>

<div id="liste" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="listeLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div id="print-content" class="modal-body">

				<table class="text-muted table table-bordered" style="width:100%">
				<?php
				foreach ($enregistrements as $enregistrement) {
					$correction = App\Commentaire::find($enregistrement->correction_id);
					if ($enregistrement->correction_id){
						?>
						<tr><td class="p-2">{{$enregistrement->nom}}</td><td class="text-monospace p-2">https://www.mon-oral.net/c/{{$correction->code_audio}}</td><td class="p-2 text-center"><img src="https://api.qrserver.com/v1/create-qr-code/?data={{urlencode('mon-oral.net/c/' . $correction->code_audio)}}&amp;size=100x100" /></td></tr>
						<?php
					}
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

<?php
if (count($enregistrements) != 0) {

	foreach ($enregistrements as $enregistrement) {

		if (asset("storage/audio-entrainements/") . '/lrpxmensjw/' . $enregistrement->code_audio . '.mp3') {

			$essais = App\Enregistrement::where([['entrainement_id',$entrainement->id],['nom',$enregistrement->nom]])->get();
			$n = 1;
			foreach ($essais as $essai){
				if ($essai->id == $enregistrement->id) $essai_num = $n;
				$n++;
			}

			$enregistrement_sujet = App\Sujet::find($enregistrement['sujet_id']);

			$sujet_audio_popover = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', htmlentities(htmlspecialchars(strip_tags($enregistrement_sujet['sujet']), ENT_QUOTES)));
			$sujet_audio_popover = \Illuminate\Mail\Markdown::parse($sujet_audio_popover);

			$opacity = ($enregistrement->is_checked == 1) ? 0.3 : 1;
			$checked = ($enregistrement->is_checked == 1) ? "checked" : "";
			?>
			<div  id="card_{{ $enregistrement->id }}"  style="opacity:{{ $opacity }}" class="card mb-2">

				<!-- options -->
				<div style="position:absolute;right:8px;top:8px;">
					<a tabindex="0" role="button" class="text-muted" style="cursor:pointer;outline:none;" data-toggle="popover" data-trigger="focus" data-placement="left" data-html="true" data-content="<a tabindex='0' id='/console/entrainement-enregistrement-supprimer/{{ Crypt::encryptString($enregistrement->id) }}' class='btn btn-danger btn-sm text-light' role='button' onclick='supprimer(this)'><i class='fas fa-trash fa-sm'></i></a>"><i class="fas fa-ellipsis-v"></i></a>
				</div>
				<!-- /options -->

				<div class="card-body p-3">

					<div class="small text-muted mb-3">

						<div id="checkbox_{{ $enregistrement->id }}" style="display:inline;top:-4px;" class="custom-control custom-checkbox" data-toggle="tooltip" data-placement="right" title="vu / non vu">
						  <input id="is_checked_{{$enregistrement->id}}" type="checkbox" class="custom-control-input" {{ $checked }} />
						  <label style="cursor:pointer;" class="custom-control-label" for="is_checked_{{$enregistrement->id}}" onclick="check({{ $enregistrement->id }})" ></label>
						</div>
						<script>
							function check(id){
								$('#checkbox_'+id).tooltip('hide');
								opacity = document.getElementById("card_"+id).style.opacity;
								if (opacity == 1) {
									opacity_value = 0.3;
								} else {
									opacity_value = 1;
								}
								document.getElementById("card_"+id).style.opacity=opacity_value;
								$.ajax({
								   url : 'https://www.mon-oral.net/console/enregistrement-statut/'+id,
								   type : 'POST', // Le type de la requête HTTP, ici devenu POST
									data:{
										'_token': '{{ csrf_token() }}',
									},
									success: function(html){
										console.log(html);
									}
								});
							}
						</script>

						<i class="fas fa-user pr-2"></i>
						<?php
						echo $enregistrement->nom;
						if(count($essais) > 1) echo ' <span style="color:red;">(essai '.$essai_num.')</span>';

						?>
						<i class="fas fa-tag pl-4 pr-2"></i><a tabindex="0" role="button"  style="cursor:pointer;outline:none;" data-trigger="hover" data-placement="top" data-toggle="popover" data-container="body" data-html="true" data-content='{{ $sujet_audio_popover }}'>sujet</a>
						<i class="fas fa-calendar-day pl-4 pr-2"></i>{{ date("d-m-Y", strtotime($enregistrement->created_at)) }}
					</div>

					<table>
						<tr style="line-height:10px;">
							<td><i class="fas fa-volume-up fa-lg mr-2 text-dark"></i></td>
							<td style="width:100%">
								@if(File::exists('/home/www/monoraldotnet/storage/app/public/audio-entrainements/lrpxmensjw/' . $enregistrement->code_audio . '.mp3'))
									<audio controls style="width:100%;"><source src="/console/lecteur/{{ $enregistrement->code_audio }}" type="audio/mpeg"></audio>
								@else
									<div class="pt-3 pb-3 ml-1 text-monospace small" style="color:#f39c12">cet enregistrement n'est plus disponible <i class="fas fa-question-circle" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="les enregistrements des élèves ont une durée de vie de trois mois"></i></div>
								@endif
							</td>
							<td>
								@if(File::exists('/home/www/monoraldotnet/storage/app/public/audio-entrainements/lrpxmensjw/' . $enregistrement->code_audio . '.mp3'))
									<a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-entrainement/{{$enregistrement->code_audio}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
								@endif
							</td>
							<td>
								@if(!$enregistrement->correction_id)
									@if(File::exists('/home/www/monoraldotnet/storage/app/public/audio-entrainements/lrpxmensjw/' . $enregistrement->code_audio . '.mp3'))
										<form method="POST" action="{{route('entrainement-correction-creer-post')}}">
											@csrf
											<input type="hidden" name="redirect_url" value="/console/entrainement-afficher/{{ $entrainement_id }}">
											<input type="hidden" name="enregistrement_id" value="{{ $enregistrement->id }}">
											<a href="#" class="ml-3 mr-2 text-success" onclick="this.closest('form').submit();return false;" data-toggle="tooltip" data-placement="top" title="lier une correction / des commentaires audio à cet enregistrement"><i class="fas fa-microphone fa-lg"></i></a>
										</form>
									@endif
								@endif
							</td>
						</tr>
						<?php
						if ($enregistrement->correction_id) {
							$correction = App\Commentaire::find($enregistrement->correction_id);
							?>
							<tr style="line-height:10px;">
								<td class="text-success"><i class="fas fa-copyright fa-lg mr-2"></i></td>
								<td style="width:100%">
									<audio controls style="width:100%;"><source src="/s/{{$correction->code_audio}}" type="audio/mpeg"></audio>
								</td>
								<td>
									<a style="display:block;font-size:120%;height:40px;line-height:40px;background-color:#f1f3f4;border-radius:4px;" href="/telecharger-commentaire/{{$correction->code_audio}}" class="text-dark" style="verticla-align:middle;"><i class="fas fa-download ml-3 mr-3 text-muted" data-toggle="tooltip" data-placement="top" title="télécharger le fichier mp3"></i></a>
								</td>
								<td>
									<a tabindex="0" class="ml-3 mr-2 text-dark" role="button" style="cursor:pointer;outline:none;" data-trigger="focus" data-container="body" data-placement="left" data-toggle="popover" data-html="true" data-content="<a class='btn btn-danger btn-sm' href='/console/entrainement-correction-supprimer/{{ Crypt::encryptString($enregistrement->correction_id) }}' role='button'>confirmer</a> <a tabindex='0' class='btn btn-secondary btn-sm text-light' role='button'>annuler</a>"><i class="fas fa-trash fa-sm"></i></a>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>

									<a data-toggle="collapse" role="button" href="#enregistrement-{{$enregistrement->id }}" style="color:black" aria-expanded="false" aria-controls="enregistrement-{{$enregistrement->id }}"><i class="fas fa-plus-square pr-2 text-muted"></i></a>
									<span class="small" style="color:silver;">lien à fournir à l'élève : <a href="https://www.mon-oral.net/c/{{ $correction->code_audio }}" class="text-monospace text-muted" target="_blank">www.mon-oral.net/c/{{ $correction->code_audio }}</a></span>

									<div class="collapse" id="enregistrement-{{$enregistrement->id }}">

										<table class="small ml-4">
											<tr>
												<td class="pt-3" style="font-size:150%"><i class="fas fa-calendar-week mr-2 text-muted"></i></td>
												<td class="pt-3 text-muted" style="width:100%">
													{{ date("d-m-Y", strtotime($enregistrement->created_at)) }}
												</td>
											</tr>
											<tr>
												<td class="pt-4" style="font-size:180%"><i class="fas fa-qrcode mr-4 text-muted"></i></td>
												<td class="pt-4" style="width:100%">QR code : <img src="https://api.qrserver.com/v1/create-qr-code/?data={{urlencode('mon-oral.net/c/' . session()->get('code_commentaire'))}}&amp;size=100x100" style="width:100px"mi alt="mon-oral.net/c/{{ session()->get('code_commentaire') }}" data-toggle="tooltip" data-placement="right" title="clic droit + 'Enregistrer l'image sous...' pour sauvegarder l'image du code" />
												</td>
											</tr>
											<tr>
												<td class="pt-4" style="font-size:150%"><i class="fas fa-code mr-4 text-muted"></i></td>
												<td class="pt-4 text-muted" style="width:100%">Code pour intégrer le lecteur dans une page HTML :
												<div class="text-monospace mt-1 p-3" style="background-color:#2c3e50; color:#ecf0f1; border-radius:3px;">
												&lt;audio controls="controls"&gt;<br />&nbsp;&nbsp;&lt;source src="https://www.mon-oral.net/s/{{$correction->code_audio}}" type="audio/mpeg"&gt;<br />&lt;/audio&gt;
												</div>
												</td>
											</tr>
											<tr>
												<td class="pt-4" style="font-size:200%"><i class="far fa-file-audio text-muted"></i></td>
												<td class="pt-4 text-muted" style="width:100%">Lien direct :
												<div class="text-monospace mt-1 p-3" style="background-color:#2c3e50; border-radius:3px;">
												<a href="https://www.mon-oral.net/s/{{$correction->code_audio}}" class="text-monospace" style="color:#ecf0f1" target="_blank">https://www.mon-oral.net/s/{{$correction->code_audio}}</a>
												</div>
												</td>
											</tr>
											<tr>
												<td class="pt-4" style="font-size:150%"><i class="fas fa-download mr-4 text-muted"></i></td>
												<td class="pt-4 text-muted text-justify">Pour télécharger votre fichier audio, cliquez sur les trois petits points verticaux à droite du lecteur. Si les trois petits points verticaux n'apparaissent pas (cela dépend des navigateurs), faites un clic droit sur le lecteur. Le fichier audio est au format mp3.</td>
											</tr>
										</table>

									</div>

								</td>
								<td></td>
							</tr>
							<?php
							}
						?>
					</table>
				</div>
			</div>
			<?php
		}

	}

} else {
	?>
	<div class="text-monospace small" style="color:silver">pas d'enregistrement pour l'instant</div>
	<?php
}
?>

<br />
<br />

<h2>Consignes</h2>
<?php
if ($entrainement['consignes'] != ''){
	$consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($entrainement->consignes));
	//$consignes = str_replace('\n', '<br>', $consignes);
	$consignes = str_replace('<a href=', '<a target="_blank" href=', $consignes);
	$consignes = str_replace('\\\\', ' \\\\\\\\', $consignes);
	$consignes = str_replace('\\begin', '\\\\begin', $consignes);
	$consignes = str_replace('\\end', '\\\\end', $consignes);
	$consignes = \Illuminate\Mail\Markdown::parse($consignes);
	?>
	<div class="card"><div class="card-body"><?php echo $consignes ?></div></div>
	<?php
} else {
	?>
	<div class="text-monospace small" style="color:silver">pas de consignes pour cet entraînement</div>
	<?php
}
?>


<br />
<br />

<h2>Sujets</h2>
<?php
foreach ($enregistrements as $enregistrement) {

	$essais = App\Enregistrement::where([['entrainement_id',$entrainement->id],['nom',$enregistrement->nom]])->get();
	$n = 1;
	foreach ($essais as $essai){
		if ($essai->id == $enregistrement->id) $essai_num = $n;
		$n++;
	}

	?>
	<div>
		<?php
		echo '<b>' . $enregistrement->nom . '</b>';
		if(count($essais) > 1) echo ' <span class="small" style="color:red;">(essai '.$essai_num.')</span>';
		?>
	</div>
	<div class="ml-3">
		<?php
		$sujet = App\Sujet::find($enregistrement->sujet_id);
		$sujet_texte = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($sujet->sujet));
		$sujet_texte = str_replace('<a href=', '<a target="_blank" href=', $sujet_texte);
		$sujet_texte = str_replace('\\\\', ' \\\\\\\\', $sujet_texte);
		$sujet_texte = str_replace('\\begin', '\\\\begin', $sujet_texte);
		$sujet_texte = str_replace('\\end', '\\\\end', $sujet_texte);
		$sujet_texte = \Illuminate\Mail\Markdown::parse($sujet_texte);
		?>
		<div class="card mb-2 "><div class="card-body p-3"><?php echo $sujet_texte ?></div></div>
	</div>
	<br />
	<?php
}
?>

<br />
<br />

<h2>Journal</h2>
<?php
$logs = App\Log::where([['entrainement_id',$entrainement->id],['message','!=','NULL']])->get();
if (count($logs) != 0) {
	?>
	<table class="table text-muted text-monospace small">
		<?php
		foreach ($logs as $log) {
			?>
			<tr>
				<td>{{ $log->created_at }}</td>
				<td>{{ $log->nom }}</td>
				<td>{{ $log->page }}</td>
				<td>{{ $log->message }}</td>
			</tr>
			<?php
		}
		?>
	</table>
	<div class="mt-3 small text-muted">
		Légende
		<ul>
			<li>'nouveau-test-audio' : l'élève a dû effectuer un nouveau test audio (problème de connexion, d'activation du micro, de haut-parleurs...)</li>
			<li>'inactif' : l'élève a tenté d'ouvrir un entraînement inactif</li>
			<li>'erreur1' : l'élève a interrompu son entraînement avant le tirage au sort du sujet en quittant la page consultée</li>
			<li>'erreur2' : l'élève a interrompu son entraînement après le tirage au sort du sujet en quittant la page consultée</li>
		</ul>
	</div>
	<?php
} else {
	?>
	<p class="text-monospace small" style="color:silver">journal vide</p>
	<?php
}
?>
