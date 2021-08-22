@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Console | Français / langues - Nouvel entraînement</title>
		
	</head>
		
	<body>	
		
		<div id="app">
			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div><a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="text-monospace small" style="color:#c5c7c9;margin-top:-2px;">console</div>
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
			?>

			<div class="container">

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

						<?php
						$formatage = '
							<div class="text-muted"><p class="mb-1"><b>Formatage du texte</b></p>
							*italique* <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <em>italique</em><br />
							**gras** <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <b>gras</b><br />
							__souligné__ <i class="fas fa-long-arrow-alt-right pl-2 pr-2"></i> <u>souligné</u></div>
						';
						?>
							
						<h1>Nouvel Entraînement</h1>
							
						<form method="POST" action="{{route('grandoral-creer-post')}}">
							
							@csrf
														
							<div class="form-row pb-3 mt-4">		
								<div class="col-2 text-secondary">titre</div>
								<div class="col">
									<input id="titre" class="form-control @error('titre') is-invalid d-block @enderror" name="titre" type="text" value="{{ old('titre') }}" autocomplete="titre" autofocus />
									@error('titre')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
									<small class="form-text text-muted">visible par les enseignants dans la console seulement</small>
								</div>
							</div>	


							<div class="form-row pb-3">	
								
								<div class="col-2 text-secondary">type</div>	

								<div class="col">	
															
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="type_francaislangues" name="type" value="1" class="custom-control-input" @if(old('type') == 1) checked @endif />
									  <label class="custom-control-label text-secondary" for="type_francaislangues">français / langues</label>
									</div>

									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="type_grandoral" name="type" value="2" class="custom-control-input" @if(old('type') == 2) checked @endif />
									  <label class="custom-control-label text-secondary" for="type_grandoral">grand oral</label>
									</div>	

									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="type_brevet" name="type" value="3" class="custom-control-input" @if(old('type') == 3) checked @endif />
									  <label class="custom-control-label text-secondary" for="type_brevet">brevet</label>
									</div>	

									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="type_autre" name="type" value="0" class="custom-control-input" @if(old('type') == 0) checked @endif />
									  <label class="custom-control-label text-secondary" for="type_autre">autre</label>
									</div>	

									@error('type')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror

								</div>	
								
							</div>	

							<div class="row" id="info_grandoral" style="display:{{(old('type') == 2) ? 'block' : 'none'}}">	
								<div class="col-md-10 offset-md-2 text-success text-justify pb-4 small">
									Au début de son entraînement, l'élève sera invité à saisir ses deux sujets (ou un seul sujet si les deux sujets n'ont pas encore été définis). Un  sujet sera ensuite tiré au sort. Tous les sujets saisis par les élèves seront consultables par l'enseignant. 
								</div>	
							</div>	

							<div class="row" id="info_brevet" style="display:{{(old('type') == 3) ? 'block' : 'none'}}">	
								<div class="col-md-10 offset-md-2 text-success text-justify pb-4 small">
									Au début de son entraînement, l'élève sera invité à saisir le sujet de son exposé. Tous les sujets saisis par les élèves seront consultables par l'enseignant. 
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
									<small class="form-text text-muted">visible par les élèves - exemples : "Oral blanc EAF", "Grand Oral blanc", "Exercice de lecture"...</small>
								</div>
							</div>										
							
							<div class="form-row pb-3">
								<div class="col-2 text-secondary">préparation</div>
								<div class="col">
									<input type="range"  id="temps_prep_slider" class="custom-range" value="{{ old('temps_prep','30') }}" min="1" max="40" step="1" name="temps_prep" oninput="set_temps_prep(this.value);">
								</div>
								<div class="col-auto text-secondary" id="temps_prep" style="text-align:right;width:70px;">{{ old('temps_prep','30') }} min.</div>
							</div>
							
							<div class="form-row pb-3">
								<div class="col-2 text-secondary">oral</div>
								<div class="col">
									<input type="range" id="temps_oral_slider" class="custom-range" value="{{ old('temps_oral','12') }}" min="1" max="20" step="1" name="temps_oral" oninput="set_temps_oral(this.value);">
								</div>
								<div class="col-auto text-secondary" id="temps_oral" style="text-align:right;width:70px;">{{ old('temps_oral','12') }} min.</div>
							</div>	

							<div class="form-row pb-3">
								<div class="col-2 text-secondary">
									<div>consignes<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></div>
									<div class="small" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">optionnel</div>
								</div>
								<div class="col">
									<textarea class="form-control @error('consignes') is-invalid d-block @enderror" id="consignes" name="consignes" rows="5">{{ old('consignes') }}</textarea>
									@error('consignes')
										<span class="invalid-feedback d-block" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror	
								</div>

							</div>	
							
							<div class="form-group" id="sujets" style="display:@if(in_array(old('type'), array(2,3))) none @endif">
								<label class="text-secondary">sujet(s)<i class="fas fa-info-circle pl-2" style="cursor:pointer" data-toggle="popover" data-html="true" data-trigger="hover" data-content="{{ trim($formatage) }}"></i></label>
								<div class="small pb-2" style="color:#c5c7c9;font-style:italic;margin-top:-5px;">si plusieurs sujets sont saisis, un sujet sera tiré au sort au début de l'entraînement</div>
								@error('sujets.0')
									<span class="invalid-feedback d-block m-0 pb-1" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<?php
								if (!empty(old('sujets'))){ 
									// array_filter : pour retirer les champs vides
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
								?>
								<div style="margin-top:10px;clear:both;">
									<i class="material-icons ajouter" style="cursor:pointer;" data-toggle="tooltip" data-trigger="hover focus" data-placement="right" title="ajouter un sujet">add_box</i>
								</div>
							</div>
							
							<input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
							
							<button type="submit" class="btn btn-primary mt-4 pl-4 pr-4"><i class="fas fa-check"></i></button>

						</form>	

					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->
	
		@include('inc-bottom')
		@include('inc-bottom-js')
			
		<script>		
		
		$(document).ready(function($) {

			$("body").on("click", ".ajouter", function() {
				$(this).parent().prev("div").append(
				'<div style="clear:both;">'
				+'<textarea name="sujets[]" class="form-control mb-2" style="float:left;padding-right:30px;" rows="5"></textarea>'			
				+'<i class="material-icons retirer" style="position:relative;display:block;top:2px;width:20px;right:26px;cursor:pointer;">indeterminate_check_box</i>'
				+'</div>');
			});
			
			$("body").on("click", ".retirer", function() {
				$(this).parent().remove();
			});
			
			$("body").on("click", "#type_francaislangues", function() {
				$('#sujets').css('display', 'block');
				$('#info_grandoral').css('display', 'none');
				$('#info_brevet').css('display', 'none');				
				$('#temps_prep_slider').val(30);
				$('#temps_oral_slider').val(12);
				$('#temps_prep').html("30 min.");
				$('#temps_oral').html("12 min.");
			});

			$("body").on("click", "#type_grandoral", function() {
				$('#sujets').css('display', 'none');
				$('#info_grandoral').css('display', 'block');
				$('#info_brevet').css('display', 'none');
				$('#temps_prep_slider').val(20);
				$('#temps_oral_slider').val(5);
				$('#temps_prep').html("20 min.");
				$('#temps_oral').html("5 min.");				
			});
			
			$("body").on("click", "#type_brevet", function() {
				$('#sujets').css('display', 'none');
				$('#info_grandoral').css('display', 'none');
				$('#info_brevet').css('display', 'block');
				$('#temps_prep_slider').val(2);
				$('#temps_oral_slider').val(5);
				$('#temps_prep').html("2 min.");
				$('#temps_oral').html("5 min.");
			});	

			$("body").on("click", "#type_autre", function() {
				$('#sujets').css('display', 'block');
				$('#info_grandoral').css('display', 'none');
				$('#info_brevet').css('display', 'none');
				$('#temps_prep_slider').val(5);
				$('#temps_oral_slider').val(10);
				$('#temps_prep').html("5 min.");
				$('#temps_oral').html("10 min.");
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