<?php
if (Auth::user() and Auth::user()->is_checked == 0){
	?>
	<p style="text-align:center;font-family: monospace;padding-top:20px;color:red">COMPTE INACTIF</p>
	<p style="text-align:center;font-family: monospace;padding-top:20px;color:gray;font-size:90%;">Si vous êtes un élève, c'est normal. Les élèves n'ont pas besoin de créer de compte. Voyez avec votre enseignant pour savoir comment utiliser mon-oral.net</p>
	<p style="text-align:center;font-family: monospace;padding-top:20px;color:gray;font-size:90%;">Autre raison possible (si vous n'êtes pas un élève) : vous avez utilisé une adresse qui n'est pas une adresse académique, une adresse professionnelle ou une adresse autorisée.</p>
	<p style="text-align:center;font-family: monospace;padding-top:20px;color:gray;font-size:90%;">Vous pouvez nous contacter à cette adresse : contact@mon-oral.net</p>
	<?php
	exit;
}

if (isset($_GET['a']) AND $_GET['a'] == 'dev') {
	setcookie('dev', 'Y', time() + (86400 * 30 * 12), "/"); // 86400 = 1 day	
}
?>