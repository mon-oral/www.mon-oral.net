<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />

		<title>Commentaire Audio - Vérification</title>

	</head>

	<body>

		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light mt-2">
				<div class="container">
				<div>
						<div class="float-left"><a href="{{ url('/console/') }}"><img src="{{ asset('img/mon-oral.svg') }}" width="40" /></a></div>
						<div class="float-left text-monospace small pl-3" style="color:#c5c7c9;">Commentaire Audio<br />Vérification</div>
					</div>
				</div>
			</nav>

			<div class="container">

				<div class="row mt-5">

					<div class="col-md-6 offset-md-3">

						<audio controls style="width:100%"><source src="/console/commentaire-verifier-ecoute" type="audio/mpeg"></audio>
						<p class="m-0 p-0 text-monospace text-muted text-center small" style="color:silver;">attendre quelques secondes que le lecteur se charge</p>

						<form method="POST" action="{{ route('commentaire-sauvegarder-post')}}">

							@csrf

							<?php
							if (Session::has('commentaire_type') OR Session::has('commentaire_code_audio')) {
								?>
								<input type="hidden" name="titre" value="compte rendu audio">
								<p class="text-center mt-4">
									<button type="submit" class="btn btn-primary btn-sm pl-4 pr-4"><i class="fas fa-check mr-2"></i> sauvegarder cet enregistrement</button>
								</p>
								<?php
							} else {
								?>
								<div class="form-row pb-2 mt-4">
									<div class="col-2 text-secondary">titre <sup style="color:red">*</sup></div>
									<div class="col">
										<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre') }}" autocomplete="titre" autofocus />
										@error('titre')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>

								<?php
								$user = Auth::user();
								$commentaires_dossiers = App\Commentaires_dossier::where([['user_id', $user->id]])->get();

								if (count($commentaires_dossiers) != 0){
									?>
									<div class="form-row pb-2">
										<div class="col-2 text-secondary">
											<div>dossier <sup><i class="fas fa-info-circle" style="color:silver;" data-toggle="tooltip" data-placement="right" title="Laisser le champ vide pour placer l'enregistrement en dehors des dossiers. Il est toujours possible de déplacer les enregistrements dans des dossiers après leur sauvegarde."></i></sup></div>
											<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
										</div>
										<div class="col">
											<select class="custom-select" name="dossier">
											<option value="0" selected></option>
											<?php
											foreach($commentaires_dossiers as $commentaires_dossier){
												echo '<option value="' . $commentaires_dossier->id . '">' . $commentaires_dossier->nom . '</option>';
											}
											?>
											</select>
										</div>
									</div>
									<?php
								}
								?>
								<div class="form-row pb-3">
									<div class="col-2"></div>
									<div class="col">
										<button type="submit" class="btn btn-primary btn-sm pl-4 pr-4"><i class="fas fa-check mr-2"></i> sauvegarder cet enregistrement</button>
									</div>
								</div>


								<?php
							}
							?>
						</form>

						<p class="text-center mt-4">
							<a class="btn btn-light btn-sm mr-3" href="/console/commentaire-refaire" role="button"><i class="fas fa-sync-alt align-middle pr-2"></i>refaire l'enregistrement</a>
							<a class="btn btn-dark btn-sm" href="/console/commentaire-quitter" role="button"><i class="fas fa-times align-middle pr-2"></i>quitter</a>
						</p>

					</div>

				</div>

			</div><!-- /container -->

		</div><!-- /app -->

		@include('inc-bottom-js')

	</body>
</html>
