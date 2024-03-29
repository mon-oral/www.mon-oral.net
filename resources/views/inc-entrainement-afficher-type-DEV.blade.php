<h2>Enregistrements</h2>
<?php
$enregistrements = App\Enregistrement::where('entrainement_id',$entrainement->id)->orderBy('nom', 'asc')->orderBy('created_at', 'asc')->get();

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
			
			$sujet_audio_popover = '';
			$sujet_audio_popover = nl2br(htmlentities($enregistrement_sujet['sujet']));
			$sujet_audio_popover = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet_audio_popover);
			$sujet_audio_popover = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet_audio_popover);
			$sujet_audio_popover = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet_audio_popover);
			$sujet_audio_popover = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet_audio_popover);	
			$sujet_audio_popover = preg_replace( "/\r|\n/", "", $sujet_audio_popover);									
			?>
			<div class="card mb-2">
				<div class="card-body p-3">
				
					<p class="small text-muted">
						
						<i class="fas fa-user pr-2"></i>
						<?php
						echo $enregistrement->nom;
						if(count($essais) > 1) echo ' <span style="color:red;">(essai '.$essai_num.')</span>';
						
						?>
						<i class="fas fa-tag pl-4 pr-2"></i><span style="cursor:help;" data-trigger="hover" data-placement="right" data-toggle="popover" data-html="true" data-content="{{ $sujet_audio_popover }}">sujet</span>
						<i class="fas fa-calendar-day pl-4 pr-2"></i>{{ date("d-m-Y", strtotime($enregistrement->created_at)) }}
					</p>
					
					<table>		
						<tr>
							<td class="text-muted"><i class="fas fa-volume-up fa-lg mr-2"></i></td>
							<td style="width:100%">
								<audio controls style="width:100%;"><source src="/console/lecteur/{{ $enregistrement->code_audio }}" type="audio/mpeg"></audio>
							</td>
							<td>
								@if(!$enregistrement->correction_id)
								<form method="POST" action="{{route('entrainement-correction-creer-post')}}">
									@csrf
									<input type="hidden" name="redirect_url" value="/console/entrainement-afficher/{{ $entrainement_id }}">
									<input type="hidden" name="enregistrement_id" value="{{ $enregistrement->id }}">
									<a href="#" class="ml-3 mr-2 text-success" onclick="this.closest('form').submit();return false;" data-toggle="tooltip" data-placement="top" title="lier une correction / des commentaires audio à cet enregistrement"><i class="fas fa-microphone fa-lg"></i></a>
								</form>		
								@endif
							</td>
						</tr>
						<?php
						if ($enregistrement->correction_id) {
							$correction = App\Commentaire::find($enregistrement->correction_id);
							?>
							<tr>
								<td class="text-success"><i class="fas fa-copyright fa-lg mr-2"></i></td>
								<td style="width:100%">
									<audio controls style="width:100%;"><source src="/s/{{$correction->code_audio}}" type="audio/mpeg"></audio>
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
												<td class="pt-4" style="width:100%">QR code : <img src="https://api.qrserver.com/v1/create-qr-code/?data={{urlencode('mon-oral.net/c/' . session()->get('code_commentaire'))}}&amp;size=100x100" alt="mon-oral.net/c/{{ session()->get('code_commentaire') }}" data-toggle="tooltip" data-placement="right" title="clic droit + 'Enregistrer l'image sous...' pour sauvegarder l'image du code" />
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
	$consignes = nl2br(htmlentities($entrainement->consignes));
	$consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $consignes);
	$consignes = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $consignes);
	$consignes = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $consignes);
	$consignes = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $consignes);	
	$consignes = preg_replace( "/\r|\n/", "", $consignes);								
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
$sujets = App\Sujet::where('entrainement_id',$entrainement->id)->get();
foreach ($sujets as $sujet) {
	$sujet_texte = nl2br(htmlentities($sujet->sujet));
	$sujet_texte = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet_texte);
	$sujet_texte = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet_texte);
	$sujet_texte = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet_texte);
	$sujet_texte = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet_texte);	
	$sujet_texte = preg_replace( "/\r|\n/", "", $sujet_texte);	
	?>
	<div class="card mb-2"><div class="card-body p-3"><?php echo $sujet_texte ?></div></div>		
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