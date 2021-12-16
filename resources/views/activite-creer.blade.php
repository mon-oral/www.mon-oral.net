@include('inc-top')
<!doctype html>
<html lang="fr">
<head>
	@include('inc-meta')
	<title>Console | Nouvelle activité</title>
</head>

<body>

	@include('inc-nav-console')

	<?php
	$user = Auth::user();
	?>

	@include('inc-markdown-modal-help')

	<div class="container mb-5">
		<div class="row">

			<div class="col-md-2 pt-5">
				<a class="btn btn-light btn-sm" href="/console" role="button"><i class="fas fa-arrow-left"></i></a>
			</div>

			<div class="col-md-10 pt-5">

				@if (session('status'))
					<div class="text-success text-monospace text-center pb-4" role="alert">
						{{ session('status') }}
					</div>
				@endif

				<h1>Nouvelle activité</h1>
				<!--<h1 style="color:red;font-size:200%">EN TRAVAUX PENDANT UNE HEURE - NE PAS UTILISER CETTE PAGE</h1>-->

				<form method="POST" action="{{route('activite-creer-post')}}">

					@csrf

					<div class="form-row pb-3 mt-4">
						<div class="col-2 text-secondary">titre <sup style="color:red">*</sup></div>
						<div class="col">
							<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre') }}" autocomplete="titre" autofocus />
							@error('titre')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							<small class="form-text text-muted">visible seulement par les enseignants dans la console.</small>
						</div>
					</div>

					<div class="form-row pb-3">
						<div class="col-2 text-secondary">
							<div>sous-titre</div>
							<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
						</div>
						<div class="col">
							<input id="soustitre" class="form-control @error('soustitre') is-invalid d-block @enderror" name="soustitre" type="text" value="{{ old('soustitre') }}" autocomplete="soustitre" autofocus />
							@error('soustitre')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							<small class="form-text text-muted">visible par les élèves - exemples : "Exercice de lecture", "Récitation", "Podcast", "Emission webradio"...</small>
						</div>
					</div>

					<div class="form-row pb-3">
						<div class="col-3 text-secondary">
							<div>sujet / consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="modal" data-target="#markdown_help"></i></div>
							<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
						</div>
						<div class="col">
							<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="8">{{ old('consignes') }}</textarea>
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
							$consigne_audio .= "</ul>Les élèves pourront ainsi lire et/ou écouter le sujet ou les consignes."
							?>
							<div class="text-monospace text-muted small">
								ajouter un sujet ou une consigne audio dans 'sujet/consignes'<span class="ml-1 small" style=""><i class="fas fa-question-circle" style="cursor:pointer"  data-container="body" data-html="true" data-trigger="hover"data-toggle="popover" data-placement="top" data-content="<?php echo $consigne_audio ?>"></i></span>
							</div>

						</div>

					</div>

					<input type="hidden" name="user_id" value="{{ $user->id }}">

					<button type="submit" class="btn btn-primary mt-2 pl-4 pr-4"><i class="fas fa-check"></i></button>

				</form>

			</div>

		</div><!-- /row -->
	</div><!-- /container -->

	@include('inc-bottom')
	@include('inc-bottom-js')

</body>
</html>
