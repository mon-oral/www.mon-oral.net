<table style="width:100%">
	<tr>
		<td style="width:100%"><a href="/console/activites" role="button" class="btn btn-light text-left text-muted" style="width:100%" data-toggle="tooltip" data-placement="top" title="afficher les activités orales"><span class="small">activités</span></a></td>
		<td><a href="/console/activite-creer" role="button" class="btn btn-light text-dark" data-toggle="tooltip" data-placement="top" title="créer une activité orale pour les élèves (récitation, lecture expressive, description orale...)"><i class="fas fa-plus fa-xs"></i></a></td>
	</tr>
	<tr>
		<td style="width:90%"><a href="/console/commentaires" role="button" class="btn btn-light text-left text-muted" style="width:100%" data-toggle="tooltip" data-placement="top" title="afficher les commentaires audio"><span class="small">commentaires</span></a></td>
		<td><a href="/console/commentaire-creer" role="button" class="btn btn-light text-dark" data-toggle="tooltip" data-placement="top" title="créer un commentaire audio (correction orale de copies, consignes, explications...)"><i class="fas fa-plus fa-xs"></i></a></td>
	</tr>
	<tr>
		<td style="width:90%"><a href="/console/entrainements" role="button" class="btn btn-light text-left text-muted" style="width:100%" data-toggle="tooltip" data-placement="top" title="afficher les entraînements de type examen"><span class="small">entraînements</span></a></td>
		<td><a href="/console/entrainement-creer" role="button" class="btn btn-light text-dark" data-toggle="tooltip" data-placement="top" title="créer un entraînement de type examen (EAF, Grand Oral, langue, brevet...)"><i class="fas fa-plus fa-xs"></i></a></td>
	</tr>

</table>

<a data-toggle="collapse" role="button" href="#conseils" class="mt-4 btn btn-light text-center btn-sm" style="width:100%" aria-expanded="false" aria-controls="conseils">
	<span class="text-danger small">CONSEILS ET REMARQUES</span>
</a>

<a href="https://github.com/mon-oral/www.mon-oral.net/discussions" target="_blank" role="button" class="mt-5 btn btn-light btn-sm text-left text-muted" style="width:100%;opacity:0.8;">
	<span style="font-size:90%"><i class="fas fa-comment-alt" style="float:left;margin:4px 8px 5px 0px;"></i> discussions <span style="opacity:0.6;font-size:90%;">&</span> annonces</span>
</a>

<a href="https://github.com/mon-oral/www.mon-oral.net/issues/new/choose" target="_blank" role="button"  class="mt-1 btn btn-light text-left btn-sm text-muted" style="width:100%;opacity:0.8;">
	<span style="font-size:90%"><i class="fas fa-bug" style="float:left;margin:4px 8px 5px 0px;"></i> signalement de bogues <span style="opacity:0.6;font-size:90%;">&</span> questions techniques</span>
</a>

<a href="https://github.com/mon-oral/www.mon-oral.net/issues/new/choose" target="_blank" role="button"  class="mt-1 btn btn-light text-left btn-sm text-muted text-monospace" style="width:100%;opacity:0.8;">
	<span style="font-size:90%"><i class="fab fa-twitter" style="float:left;margin:4px 8px 5px 0px;"></i> @mon_oral</span>
</a>


<div class="text-monospace text-center small mt-5 mb-5" style="color:silver">
	<i class="fa fa-envelope"></i> <a href="mailto:contact@mon-oral.net">contact@mon-oral.net</a>
</div>

<table class="mt-5 mt-5 mb-5 text-monospace small text-muted">
	<tr>
		<td class="text-center pr-2 align-top pt-1 text-danger"><i class="fas fa-trash"></i></td>
		<td class="pt-1 supprimer"><a tabindex="0" role="button" style="cursor:pointer;" data-trigger="focus" data-container="body" data-placement="right" data-toggle="popover" data-html="true" data-content="<a class='btn btn-danger btn-sm' href='{{ route('supprimer') }}' role='button'>confirmer</a> <a tabindex='0' class='btn btn-secondary btn-sm text-light' role='button'>annuler</a>">supprimer ce compte </a></td>
	</tr>
</table>
