@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<title>Console | Modifier l'activité</title>

	</head>

	<body>

		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-5px;">console</div>
					</div>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown">

								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<div class="dropdown-menu dropdown-menu-right p-1" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('logout') }}"
									   onclick="event.preventDefault();
													 document.getElementById('logout-form').submit();">
										{{ __('Logout') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>

							</li>
						</ul>
					</div>
				</div>
			</nav>

			<?php
			$user = Auth::user();
			$activite = App\Activite::where([['user_id', $user->id],['id', $activite_id]])->first();
			?>

			<!-- MODAL MARKDOWN HELP -->
			<div class="modal fade" id="markdown_help" tabindex="-1" aria-labelledby="markdown_helpLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<b class="modal-title" id="exampleModalLabel">Formatage du texte</b>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table class="table table-bordered table-hover small">
								<tr>
									<td></td>
									<td class="p-2 text-center">SYNTAXE</td>
									<td class="p-2 text-center">RENDU</td>
								</tr>
								<tr>
									<td class="p-2">PARAGRAPHES</td>
									<td class="p-2 text-monospace text-muted">paragraphe<br /><br />paragraphe<p class="mt-2 mb-0" style="color:silver">Laisser une ligne vide pour marquer un nouveau paragraphe.</p></td>
									<td class="p-2" style="vertical-align:top"><p class="mb-1">paragraphe</p>paragraphe</td>
								</tr>
								<tr>
									<td class="p-2">RETOUR Á LA LIGNE</td>
									<td class="p-2 text-monospace text-muted">ligne \<br />ligne<p class="mt-2 mb-0" style="color:silver">Ajouter un \ en bout de ligne pour forcer le retour à la ligne.</p></td>
									<td class="p-2" style="vertical-align:top">ligne<br />ligne</td>
								</tr>
								<tr>
									<td class="p-2">LISTES</td>
									<td class="p-2 text-monospace text-muted">* point 1<br />* point 2<br /></td>
									<td class="p-2" style="vertical-align:top"><ul style="padding-left:20px;margin-left:0;margin-bottom:0"><li>point 1</li><li>point 2</li></ul></td>
								</tr>
								<tr>
									<td class="p-2">ITALIQUE</td>
									<td class="p-2 text-monospace text-muted">*italique*</td>
									<td class="p-2"><em>italique</em></td>
								</tr>
								<tr>
									<td class="p-2">GRAS</td>
									<td class="p-2 text-monospace text-muted">**gras**</td>
									<td class="p-2"><b>gras</b></td>
								</tr>
								<tr>
									<td class="p-2">SOULIGNÉ</td>
									<td class="p-2 text-monospace text-muted">__souligné__</td>
									<td class="p-2"><u>souligné</u></td>
								</tr>
								<tr>
									<td class="p-2">IMAGE</td>
									<td class="p-2 text-monospace text-muted">
										<p>![](url-image)</p>
										<p class="mb-0"><i>Exemple : ![](https://www.mon-oral.net/img/mon-oral.png)<i></p>
									</td>
									<td class="p-2"><img src="https://www.mon-oral.net/img/mon-oral.png" width="60"/></td>
								</tr>
								<tr>
									<td class="p-2">LIEN</td>
									<td class="p-2 text-monospace text-muted">
										<p>[texte-cliquable](url-site)</p>
										<p class="mb-1"><i>Exemple 1 : Un [lien](https://eduscol.education.fr) vers Eduscol.</i></p>
										<p class="mb-0"><i>Exemple 2 : Un lien vers [Eduscol](https://eduscol.education.fr).</i></p>
									</td>
									<td class="p-2">
										<p><br /></p>
										<p class="mb-1">Un <a href="https://eduscol.education.fr">lien</a> vers Eduscol.</p>
										<p class="mb-0">Un lien vers <a href="https://eduscol.education.fr">Eduscol</a>.</p>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- MODAL MARKDOWN HELP -->

			<div class="container">
				<div class="row">

					<div class="col-md-2 pt-5">
						<a class="btn btn-light btn-sm" href="/console/activites" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>

					<div class="col-md-10 pt-5">

						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<?php
						if ($activite === null){
							?>
							<div class="text-danger text-monospace text-center">Cette activité n'existe pas !</div>
							<?php
						} else {
							?>

							<h1>{{$activite->titre}}</h1>

							<form method="POST" action="{{route('activite-modifier-post')}}">

								@csrf

								<div class="form-row pb-3 mt-4">
									<div class="col-2 text-secondary">titre</div>
									<div class="col">
										<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre', $activite->titre) }}" autocomplete="titre" autofocus />
										@error('titre')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<small class="form-text text-muted">visible seulement par les enseignants dans la console.</small>
									</div>
								</div>

								<div class="form-row pb-3">
									<div class="col-2 text-secondary">sous titre</div>
									<div class="col">
										<input id="soustitre" class="form-control @error('soustitre') is-invalid d-block @enderror" name="soustitre" type="text" value="{{ old('soustitre', $activite->soustitre) }}" autocomplete="soustitre" autofocus />
										@error('soustitre')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<small class="form-text text-muted">visible par les élèves - exemples : "Oral blanc EAF", "Exercice de lecture"...</small>
									</div>
								</div>

								<div class="form-row pb-3">
									<div class="col-2 text-secondary">
										<div>sujet / consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="modal" data-target="#markdown_help"></i></div>
										<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
									</div>
									<div class="col">
										<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="5">{{ old('consignes', $activite->consignes) }}</textarea>
										@error('consignes')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror

										<?php
										$consigne_audio = "Pour ajouter un sujet ou une consigne audio dans 'sujet / consignes' :";
										$consigne_audio .= "<ul>";
										$consigne_audio .= "<li>Créer un sujet ou une consigne audio dans la section 'commentaires'</li>";
										$consigne_audio .= "<li>Copier la balise <span class='text-monospace'>[:audio-xxxxxxxxxxxx:]</span.</li>";
										$consigne_audio .= "<li>Coller la balise à l'endroit où vous voulez voir apparaitre le lecteur audio</li></ul>";
										$consigne_audio .= "</ul>Les élèves pourront ainsi lire et/ou écouter le sujet ou les consignes.";
										?>
										<div class="text-monospace text-muted small">
											ajouter un sujet ou une consigne audio dans 'sujet/consignes'<span class="ml-1 small" style=""><i class="fas fa-question-circle" style="cursor:pointer"  data-container="body" data-html="true" data-trigger="hover"data-toggle="popover" data-placement="top" data-content="<?php echo $consigne_audio ?>"></i></span>
										</div>

									</div>

								</div>

								<input type="hidden" name="activite_id" value="<?php echo $activite_id ?>">
								<input type="hidden" name="type" value="<?php echo $activite->type ?>">

								<button type="submit" class="btn btn-primary mb-4 pl-4 pr-4"><i class="fas fa-check"></i></button>

							</form>

							<?php
						}
						?>

					</div>

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom-js')

		<script>

		$(document).ready(function($) {

			$("body").on("click", ".ajouter", function() {
				$(this).parent().prev().after(
				'<div style="clear:both;">'
				+'<textarea name="sujets[]" class="form-control mb-2" style="float:left;padding-right:30px;" rows="5"></textarea>'
				+'<i class="material-icons retirer" style="position:relative;display:block;top:2px;width:20px;right:26px;cursor:pointer;">indeterminate_check_box</i>'
				+'</div>');
			});

			$("body").on("click", ".retirer", function() {
				$(this).parent().remove();
			});

		});

		function set_temps_prep(m) {
			document.getElementById("temps_prep").innerHTML = m + " min.";
		}

		function set_temps_oral(m) {
			document.getElementById("temps_oral").innerHTML = m + " min.";
		}
		</script>

	</body>
</html>
