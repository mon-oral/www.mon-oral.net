@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>

		@include('inc-meta')

		<title>Console | Modifier l'entraînement</title>

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
			$entrainement = App\Entrainement::where([['user_id', $user->id],['id', $entrainement_id]])->first();
			?>

			@include('inc-markdown-modal-help')			

			<div class="container">
				<div class="row">

					<div class="col-md-2 pt-5">
						<a class="btn btn-light btn-sm" href="/console/entrainements" role="button"><i class="fas fa-arrow-left"></i></a>
					</div>

					<div class="col-md-10 pt-5">

						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<?php
						if ($entrainement === null){
							?>
							<div class="text-danger text-monospace text-center">Cet entraînement n'existe pas !</div>
							<?php
						} else {
							?>

							<h1>{{$entrainement->titre}}</h1>

							<form method="POST" action="{{route('entrainement-modifier-post')}}">

								@csrf

								<div class="form-row pb-3 mt-4">
									<div class="col-2 text-secondary">titre <sup style="color:red">*</sup></div>
									<div class="col">
										<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre', $entrainement->titre) }}" autocomplete="titre" autofocus />
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
										<div>sous titre</div>
										<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
									</div>

									<div class="col">
										<input id="soustitre" class="form-control @error('soustitre') is-invalid d-block @enderror" name="soustitre" type="text" value="{{ old('soustitre', $entrainement->soustitre) }}" autocomplete="soustitre" autofocus />
										@error('soustitre')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<small class="form-text text-muted">visible par les élèves - exemples : "Oral blanc EAF", "Exercice de lecture"...</small>
									</div>
								</div>

								<div class="form-row pb-3">
									<div class="col-2 text-secondary">préparation</div>
									<div class="col">
										<input type="range" id="temps_prep_slider" class="custom-range" value="{{ old('temps_prep', $entrainement->temps_prep) }}" min="1" max="40" step="1" name="temps_prep" oninput="set_temps_prep(this.value);">
									</div>
									<div class="col-auto text-secondary" id="temps_prep" style="text-align:right;width:70px;">{{ old('temps_prep', $entrainement->temps_prep) }} min.</div>
								</div>

								<div class="form-row pb-3">
									<div class="col-2 text-secondary">oral</div>
									<div class="col">
										<input type="range" id="temps_oral_slider" class="custom-range" value="{{ old('temps_oral', $entrainement->temps_oral) }}" min="1" max="20" step="1" name="temps_oral" oninput="set_temps_oral(this.value);">
									</div>
									<div class="col-auto text-secondary" id="temps_oral" style="text-align:right;width:70px;">{{ old('temps_oral', $entrainement->temps_oral) }} min.</div>
								</div>

								<div class="form-row pb-3">
									<div class="col-2 text-secondary">
										<div>consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="modal" data-target="#markdown_help""></i></div>
										<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
									</div>
									<div class="col">
										<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="5">{{ old('consignes', $entrainement->consignes) }}</textarea>
										@error('consignes')
											<span class="invalid-feedback d-block" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>

								</div>

								<div class="form-group" id="sujets" style="display:@if(in_array($entrainement->type, array(3,4))) none @endif">
									<label class="text-secondary">Sujet(s)<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="modal" data-target="#markdown_help""></i></label>
									@error('sujets.0')
										<span class="invalid-feedback d-block m-0 pb-1" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									<?php
									if (!empty(old())){
										if (!empty(old('sujets'))){
											foreach(old('sujets') as $key => $sujet) {
												if ($sujet != '' OR $key == 0){
													?>
													<div style="clear:both;">
														<textarea name="sujets[]" class="form-control <?php if ($key == 0 AND $errors->has('sujets.0')) echo 'is-invalid d-block'; ?> mb-2" style="float:left;padding-right:30px;" rows="5"><?php echo $sujet ?></textarea>
														<?php
														if ($key > 0){
															?>
															<i class="material-icons retirer" style="position:relative;display:block;top:2px;width:20px;right:26px;cursor:pointer;">indeterminate_check_box</i>
															<?php
														}
														?>
													</div>
													<?php
												}
											}
										} else {
											?>
											<div style="clear:both;">
												<textarea name="sujets[]" class="form-control mb-2 @error('sujets.0') is-invalid d-block @enderror" rows="5"></textarea>
											</div>
											<?php
										}
									} else {
										$sujets = App\Sujet::where('entrainement_id',$entrainement_id)->get();
										foreach ($sujets as $key => $sujet) {
											?>
											<div style="clear:both;">
											<textarea name="sujets[]" class="form-control mb-2" style="float:left;padding-right:30px;" rows="5">{{ old('sujets[]', $sujet->sujet) }}</textarea>
											<?php
											if ($key > 0){
												?>
												<i class="material-icons retirer" style="position:relative;display:block;width:20px;top:2px;right:26px;cursor:pointer;">indeterminate_check_box</i>
												<?php
											}
											?>
											</div>
											<?php
										}
									}
									?>
									<div style="margin-top:10px;clear:both;">
										<i class="material-icons ajouter" style="cursor:pointer;" data-toggle="tooltip" data-trigger="hover focus" data-placement="right" title="ajouter un sujet">add_box</i>
									</div>
								</div>

								<input type="hidden" name="entrainement_id" value="<?php echo $entrainement_id ?>">
								<input type="hidden" name="type" value="<?php echo $entrainement->type ?>">

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
