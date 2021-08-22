@include('inc-entrainement-afficher-common')

<br />
<br />

<h2>Sujets</h2>
<?php
$sujets = App\Sujet::where('entrainement_id',$entrainement->id)->get();
foreach ($sujets as $sujet) {
	$sujet_texte = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', strip_tags($sujet->sujet));
	$sujet_texte = \Illuminate\Mail\Markdown::parse($sujet_texte);
	$sujet_texte = str_replace('<a href=', '<a target="_blank" href=', $sujet_texte);
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
