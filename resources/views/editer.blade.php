<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console - Edtiter</title>
		
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
							<!-- Authentication Links -->
							@guest
								<li class="nav-item">
									<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
								</li>
								@if (Route::has('register'))
									<li class="nav-item">
										<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
									</li>
								@endif
							@else
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
							@endguest
						</ul>
					</div>
				</div>
			</nav>

			<?php
			$user = Auth::user();
			$entrainement = App\Entrainement::where([['user_id', $user->id],['id', $entrainement_id]])->first();
			?>

			<div class="container">
				<div class="row">
					<div class="col-md-3 pt-5">
					
						<table class="text-monospace small text-muted">
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-user-circle"></i></td>
								<td class="pt-1"><?php echo $user->name ?></td>
							</tr>
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-building"></i></td>
								<td class="pt-1"><?php echo $user->etablissement ?></td>
							</tr>
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-bookmark"></i></td>
								<td class="pt-1"><?php echo $user->matiere ?></td>
							</tr>	
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-at"></i></td>
								<td class="pt-1"><?php echo $user->email ?></td>
							</tr>					
						</table>
						
						<div class="text-center mt-3 mb-5">
							<a class="btn btn-primary btn-sm mt-3" href="/console" role="button"><i class="fas fa-arrow-left pr-2"></i>console</a>
						</div>
						
					</div>
					
					<div class="col-md-9">
					@if ($user->is_checked == 1)
					
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif		
								
						<div class="p-4">
							<?php
							if ($entrainement === null){
								?>
								<div class="alert alert-warning text-monospace text-center" role="alert">Cet entraînement n'existe pas !</div>
								<?php
							} else {
								
								$formatage = '
									<div class="text-muted"><p class="mb-1"><b>Formatage du texte</b></p>
									*italique* <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <em>italique</em><br />
									**gras** <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <b>gras</b><br />
									__souligné__ <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <u>souligné</u></div>
								';								
								?>
							
								<h1>MODIFICATIONS</h1>
								
								<form method="POST" action="/console/editer">
									
									@csrf
															
									<div class="form-row pb-3 mt-4">
										<div class="col-2 text-secondary">titre</div>
										<div class="col">
											<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre', $entrainement->titre) }}" autocomplete="titre" autofocus />
											@error('titre')
												<span class="invalid-feedback d-block" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<small class="form-text text-muted">Visible seulement par les enseignants dans la console.</small>		
										</div>
									</div>	

									<div class="form-row pb-3">
										<div class="col-2 text-secondary">sous titre</div>
										<div class="col">
											<input id="soustitre" class="form-control @error('soustitre') is-invalid d-block @enderror" name="soustitre" type="text" value="{{ old('soustitre', $entrainement->soustitre) }}" autocomplete="soustitre" autofocus />
											@error('soustitre')
												<span class="invalid-feedback d-block" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror	
											<small class="form-text text-muted">Visible par les élèves. Exemples : "Oral blanc EAF", "Exercice de lecture"...</small>											
										</div>
									</div>										
									
									<div class="form-row pb-3">
										<div class="col-2 text-secondary">préparation</div>
										<div class="col">
											<input type="range" class="custom-range" value="{{ old('temps_prep', $entrainement->temps_prep) }}" min="1" max="40" step="1" name="temps_prep" oninput="set_width(this.value);">
										</div>
										<div class="col-auto text-secondary" id="display_width" style="text-align:right;width:70px;">{{ old('temps_prep', $entrainement->temps_prep) }} min.</div>
									</div>
									
									<div class="form-row pb-3">
										<div class="col-2 text-secondary">oral</div>
										<div class="col">
											<input type="range" class="custom-range" value="{{ old('temps_oral', $entrainement->temps_oral) }}" min="1" max="20" step="1" name="temps_oral" oninput="set_size(this.value);">
										</div>
										<div class="col-auto text-secondary" id="display_size" style="text-align:right;width:70px;">{{ old('temps_oral', $entrainement->temps_oral) }} min.</div>
									</div>	

									<div class="form-row pb-3">
										<div class="col-2 text-secondary">consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></div>
										<div class="col">
											<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="5">{{ old('consignes', $entrainement->consignes) }}</textarea>
											@error('consignes')
												<span class="invalid-feedback d-block" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror	
										</div>

									</div>		
									
									<div class="form-group">
										<label class="text-secondary">Sujet(s)<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></label>
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
									
									<input type="hidden" id="entrainement_id" name="entrainement_id" value="<?php echo $entrainement_id ?>">
									
									<button type="submit" class="btn btn-primary"><i class="fas fa-check pr-2"></i>enregistrez</button>

								</form>							
								
							</div>
							<?php
						}
						?>

					</div>
					
					@endif
					
				</div>
				
			</div><!-- /container -->

		</div><!-- /app -->
	
		@include('inc-bottom-js')	
			
		<script>

		$(document).ready(function($) {
			check_keyup();
			$("body").on("click", ".ajouter", function() {
				$(this).parent().prev("div").append(
				'<div class="pt-2" style="clear:both;">'
				+'<textarea name="sujets[]" class="form-control" style="float:left;padding-right:30px;" rows="5"></textarea>'			
				+'<i class="material-icons retirer" style="position:relative;display:block;width:20px;top:2px;right:26px;cursor:pointer;">indeterminate_check_box</i>'
				+'</div>');
				check_keyup();
			});	
			$("body").on("click", ".retirer", function() {
				$(this).parent().remove();
			});
			function check_keyup(){
				var x_timer;
				$('.input_data').on("keyup",function() {
					clearTimeout(x_timer);
					var n = $(this).attr('data-num');
					var type = $(this).attr('data-type');
					var saisie = $(this).val();
					x_timer = setTimeout(function(){
						check_username(saisie,type,n);
					}, 100);
				});						
			}
		});		

		function set_size(s) {
			document.getElementById("display_size").innerHTML = s + " min.";
			document.getElementById("editor").style.fontSize = s + " min.";
			editor.resize();
		}
		
		function set_width(w) {
			document.getElementById("display_width").innerHTML = w + " min.";
			document.getElementById("code").style.width = w + " min.";
			editor.resize();
		}			
		</script>
		
	</body>
</html>