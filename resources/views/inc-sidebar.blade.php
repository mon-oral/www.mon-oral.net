<!--
<div class="mt-4 mb-5 text-center">
	<a class="btn btn-outline-secondary btn-sm" href="https://monoral.flarum.cloud" role="button">discussions</a>
	<a class="btn btn-outline-secondary btn-sm" href="https://docs.mon-oral.net" role="button">guides</a>
</div>


-->

<div style="clear:both">
	<div class="btn-toolbar mb-1" role="toolbar">
		<div class="btn-group" role="group" style="width:100%">
			<a href="/console/entrainements" role="button" class="btn btn-light text-left text-muted" style="width:100%"><span class="small">entraînements</span></a>
			<a href="/console/entrainement-creer" role="button" class="btn btn-light text-dark" data-toggle="tooltip" data-placement="top" title="créer un entraînement"><i class="fas fa-plus fa-xs"></i></a>
		</div>
	</div>
</div>

<div>
	<div class="btn-toolbar mb-1" role="toolbar">
		<div class="btn-group" role="group" style="width:100%">
			<a href="/console/activites" role="button" class="btn btn-light text-left text-muted" style="width:100%"><span class="small">activités</span></a>
			<a href="/console/activite-creer" role="button" class="btn btn-light text-dark" data-toggle="tooltip" data-placement="top" title="créer une activité audio"><i class="fas fa-plus fa-xs"></i></a>
		</div>
	</div>
</div>

<div style="clear:both">
	<div class="btn-toolbar mb-1" role="toolbar">
		<div class="btn-group" role="group" style="width:100%">
			<a href="/console/commentaires" role="button" class="btn btn-light text-left text-muted" style="width:100%"><span class="small">commentaires</span></a>
			<a href="/console/commentaire-creer" role="button" class="btn btn-light text-dark" data-toggle="tooltip" data-placement="top" title="créer un commentaire audio"><i class="fas fa-plus fa-xs"></i></a>
		</div>
	</div>
</div>

<a data-toggle="collapse" role="button" href="#conseils" class="mt-4 btn btn-light text-center btn-sm" style="width:100%" aria-expanded="false" aria-controls="conseils"><span class="text-danger small">CONSEILS ET REMARQUES</span></a>

<!--
<a href="https://monoraldotnet.flarum.cloud/" target="_blank" role="button"  class="mt-4 btn btn-light text-center btn-sm text-muted" style="width:100%" aria-expanded="false" aria-controls="conseils"><span style="font-size:90%">forum</span></a>
<a href="https://wiki.mon-oral.net" target="_blank" role="button"  class="mt-1 btn btn-light text-center btn-sm text-muted" style="width:100%" aria-expanded="false" aria-controls="conseils"><span style="font-size:90%">wiki</span></a>
-->

<div class="text-monospace text-center small mt-4 mt-5 mb-5" style="color:silver">
	contact : <a href="mailto:contact@mon-oral.net"><i class="fa fa-envelope text-info"></i></a>
</div>

<table class="mt-5 mt-5 mb-5 text-monospace small text-muted">	
	<tr>
		<td class="text-center pr-2 align-top pt-1 text-danger"><i class="fas fa-trash"></i></td>
		<td class="pt-1 supprimer"><a tabindex="0" role="button" style="cursor:pointer;" data-trigger="focus" data-container="body" data-placement="right" data-toggle="popover" data-html="true" data-content="<a class='btn btn-danger btn-sm' href='{{ route('supprimer') }}' role='button'>confirmer</a> <a tabindex='0' class='btn btn-secondary btn-sm text-light' role='button'>annuler</a>">supprimer ce compte </a></td>
	</tr>							
</table>