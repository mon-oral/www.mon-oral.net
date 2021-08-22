<h2>Enregistrements <span class="ml-1 small" style="color:#e74c3c"><i class="fas fa-exclamation-triangle" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="les enregistrements des élèves ont une durée de vie de trois mois"></i></span></h2>
<?php
$logs = App\Log::where('entrainement_id',$entrainement->id)->get();

if (count($logs) != 0) {

	foreach ($logs as $log) {
		
		$log_sujet = App\Sujet::find($log['sujet_id']);
		
		$sujet_audio_popover = '';
		$sujet_audio_popover = nl2br(htmlentities($log_sujet['sujet']));
		$sujet_audio_popover = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet_audio_popover);
		$sujet_audio_popover = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet_audio_popover);
		$sujet_audio_popover = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet_audio_popover);
		$sujet_audio_popover = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet_audio_popover);	
		$sujet_audio_popover = preg_replace( "/\r|\n/", "", $sujet_audio_popover);									

		if ($log->code_audio != "") {
			if (asset("storage/audio-entrainements/") . '/lrpxmensjw/' . $log->code_audio . '.mp3') {
				?>
				<p class="small text-muted mb-1">
					<i class="fas fa-user pl-4 pr-2"></i>{{ $log->nom }}
					<i class="fas fa-tag pl-4 pr-2"></i><a tabindex="0" role="button"  style="cursor:help;outline:none;" data-trigger="focus" data-placement="top" data-toggle="popover" data-html="true" data-content="{{ $sujet_audio_popover }}">sujet</a>
					<i class="fas fa-calendar-day pl-4 pr-2"></i>{{ date("d-m-Y", strtotime($log->created_at)) }}
				</p>
				<p>		

				@if(File::exists('/home/www/monoraldotnet/storage/app/public/audio-entrainements/lrpxmensjw/' . $log->code_audio . '.mp3'))
				<audio controls style="width:100%;"><source src="/console/lecteur/{{ $log->code_audio }}" type="audio/mpeg"></audio>
				@else
					<div class="pb-1 ml-1 text-monospace small" style="color:#f39c12">cet enregistrement n'est plus disponible <i class="fas fa-question-circle" style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="les enregistrements des élèves ont une durée de vie de trois mois"></i></div>
				@endif	
				
				</p>
				<?php
			}
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
$vue_sujets = App\Sujet::where('entrainement_id',$entrainement->id)->get();
foreach ($vue_sujets as $key => $vue_sujet) {
	$sujet = nl2br(htmlentities($vue_sujet->sujet));
	$sujet = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet);
	$sujet = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet);
	$sujet = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet);
	$sujet = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet);	
	$sujet = preg_replace( "/\r|\n/", "", $sujet);	
	?>
	<div class="card mb-2"><div class="card-body"><?php echo $sujet ?></div></div>		
	<?php
}		
?>

<br />
<br />

<h2>Journal</h2>

<table class="table text-muted text-monospace small">
	<?php
	$nb_message = 0;
	foreach ($logs as $log) {
		if ($log->message != ''){
		
			$log_sujet = App\Sujet::find($log->sujet_id);

			$sujet_popover = '';
			$sujet_popover = nl2br(htmlentities($log_sujet['sujet']));
			$sujet_popover = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet_popover);
			$sujet_popover = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet_popover);
			$sujet_popover = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet_popover);
			$sujet_popover = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet_popover);	
			$sujet_popover = preg_replace( "/\r|\n/", "", $sujet_popover);
			
			$nb_message++;
			?>		
			<tr>
				<td>{{ $log->created_at }}</td>
				<td>{{ $log->nom }}</td>
				<td><?php if ($sujet_popover != '') echo '<span style="cursor:pointer;color:#3490dc" data-trigger="hover" data-placement="left" data-toggle="popover" data-html="true" data-content="' . $sujet_popover . '">sujet</span>';?></td>
				<td>{{ $log->code_audio }}</td>
				<td>{{ $log->page }}</td>
				<td>{{ $log->message }}</td>
			</tr>
			<?php
		}
	}
	?>
</table>

<?php
if ($nb_message != 0){
	?>
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