<!doctype html>
<html lang="fr">
	<head>
		
		@include('inc-meta')

		<title>Console - Afficher</title>
		
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
			?>

			<div class="container">
				<div class="row">
					<div class="col-md-3 pt-5">
						<table class="text-monospace small text-muted">
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-user-circle"></i></td>
								<td class="pt-1">{{ $user->name }}</td>
							</tr>
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-building"></i></td>
								<td class="pt-1">{{ $user->etablissement }}</td>
							</tr>
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-bookmark"></i></td>
								<td class="pt-1">{{ $user->matiere }}</td>
							</tr>	
							<tr>
								<td class="text-center pr-2 align-top pt-1"><i class="fas fa-at"></i></td>
								<td class="pt-1">{{ $user->email }}</td>
							</tr>					
						</table>
						
						<div class="text-center mt-3 mb-5">
							<a class="btn btn-primary btn-sm mt-3" href="/console" role="button"><i class="fas fa-arrow-left pr-2"></i>console</a>	
						</div>						

						@if ($user->is_checked == 1)

							<?php
							$entrainements = App\Entrainement::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

							foreach($entrainements as $entrainement) {
								$checked = ($entrainement->is_active == 1) ? "checked" : "";
								$opacity = ($entrainement->is_active == 1) ? 1 : 0.5;
								
								$nb_sujets = App\Sujet::where('entrainement_id', $entrainement->id)->count();
								$nb_enregistrements = App\Log::where([['entrainement_id', $entrainement->id],['code_audio', '!=', '']])->count();
								
								$info = 'Préparation : ' . $entrainement->temps_prep . ' minutes <br />Oral : ' . $entrainement->temps_oral . ' minutes<br />Nombre de sujets : ' . $nb_sujets . '<br />Nombre d\'enregistrements : ' . $nb_enregistrements;
								?>
								<div id="card_{{ $entrainement->id }}"  style="opacity:{{ $opacity }}" class="card mt-2">

									<div class="card-body p-3">
									
										<div style="position:absolute;right:8px;top:16px;" class="custom-control custom-switch" data-toggle="tooltip" title="activer / désactiver cet entraînement">
											<input type="checkbox" class="custom-control-input" id="active_{{ $entrainement->id }}" {{ $checked }} />
											<label class="custom-control-label" style="cursor:pointer;" for="active_{{ $entrainement->id }}" onclick="active({{ $entrainement->id }})" ></label>
										</div>

										<div style="position:absolute;right:20px;bottom:14px;"><a href="/console/editer/{{ $entrainement->id }}" style="color:silver" data-toggle="tooltip" title="modifier cet entraînement"><i class="fas fa-pen"></i></a></div>	
										
										<div class="mb-3">
											<kbd>{{ $entrainement->code }}</kbd>
											<span class="badge badge-pill badge-light ml-2" style="cursor:pointer;background-color:#e7e9eb;padding-bottom:1px;" data-trigger="hover" data-toggle="popover" data-html="true" data-content="{{ $info }}">i</span>
											<span class="pl-2 small text-muted">{{ date("d-m-Y", strtotime($entrainement->created_at)) }}</span>
										</div>
										<div class="pr-4" style="line-height:1.2">
											<a href="/console/afficher/{{ $entrainement->id }}">{{ $entrainement->titre }}</a><span class="badge badge-pill badge-success ml-1" style="padding-bottom:1px;">{{ $nb_enregistrements }}</span>
										</div>														
									</div>
								</div>
								<?php
							}
							?>				

						@endif				
					</div>
					
					<div class="col-md-9 p-5">
					
						@if ($user->is_checked == 0)
							
							<p class="alert alert-warning" role="alert">Votre compte est en attente de vérification.</p>
						
						@else
						
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif		
							
							<?php
							$vue_entrainement = App\Entrainement::where([['user_id', $user->id],['id', $entrainement_id]])->first();

							if ($vue_entrainement === null){
								?>
								<div class="alert alert-warning text-monospace text-center" role="alert">Cet entraînement n'existe pas !</div>
								<?php
							} else {

								$logs = App\Log::where('entrainement_id',$vue_entrainement->id)->get();
								?>
								<h1 class="mb-0">{{ $vue_entrainement->titre }}</h1>
								<?php if ($vue_entrainement->soustitre != '') echo '<p style="color:#84a9c7;font-style:italic;margin:-4px 0px 0px 0px;">' . $vue_entrainement->soustitre . '</p>';?>
								<p class="mb-2 small" style="color:#bdc3c7;margin-top:-4px;">{{ date("d-m-Y", strtotime($vue_entrainement->created_at)) }}</p>
								<p class="mt-3 mb-0 text-center"><b>Code : </b> <kbd class="small">{{ $vue_entrainement->code }}</kbd></p>
								<p class="mb-0 text-center"><b>Préparation : </b> {{ $vue_entrainement->temps_prep }} minutes</p>
								<p class="mb-0 text-center"><b>Oral : </b> {{ $vue_entrainement->temps_oral }} minutes</p>
									
								<br />
								<br />

								<h2>Enregistrements</h2>
								<?php
								foreach ($logs as $log) {
									
									$log_sujet = App\Sujet::find($log['sujet_id']);
									
									$sujet_audio_popover = '';
									$sujet_audio_popover = nl2br(htmlentities($log_sujet['sujet']));
									$sujet_audio_popover = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet_audio_popover);
									$sujet_audio_popover = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet_audio_popover);
									$sujet_audio_popover = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet_audio_popover);
									$sujet_audio_popover = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet_audio_popover);	
									$sujet_audio_popover = preg_replace( "/\r|\n/", "", $sujet_audio_popover);									

									if ($log->code_audio != "") {
										if (asset("storage/audio-entrainements/") . '/lrpxmensjw/' . $log->code_audio . '.mp3') {
											?>
											<p class="small text-muted mb-1">
												<i class="fas fa-calendar-day pr-2"></i>{{ date("d-m-Y", strtotime($log->created_at)) }}
												<i class="fas fa-user pl-4 pr-2"></i>{{ $log->nom }}
												<i class="fas fa-tag pl-4 pr-2"></i><a href="#" data-trigger="hover" data-placement="right" data-toggle="popover" data-html="true" data-content="{{ $sujet_audio_popover }}">sujet</a>
											</p>
											<p>						
												<audio controls style="width:100%"><source src="/console/lecteur/{{ $log->code_audio }}" type="audio/mpeg"></audio>
											</p>
											<?php
										}
									}

								}	
								?>	
								
								<br />
								<br />

								<h2>Journal</h2>
								
								<table class="table text-muted text-monospace small">
									<?php
									foreach ($logs as $log) {
										if ($log->message != ''){
										
											$log_sujet = App\Sujet::find($log->sujet_id);

											$sujet_popover = '';
											$sujet_popover = nl2br(htmlentities($log_sujet['sujet']));
											$sujet_popover = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet_popover);
											$sujet_popover = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet_popover);
											$sujet_popover = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet_popover);
											$sujet_popover = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet_popover);	
											$sujet_popover = preg_replace( "/\r|\n/", "", $sujet_popover);
											?>		
											<tr>
												<td>{{ $log->created_at }}</td>
												<td>{{ $log->nom }}</td>
												<td><?php if ($sujet_popover != '') echo '<span style="cursor:pointer;color:#3490dc" data-trigger="hover" data-placement="left" data-toggle="popover" data-html="true" data-content="' . $sujet_popover . '">sujet</span>';?></td>
												<td>{{ $log->code_audio }}</td>
												<td>{{ $log->page }}</td>
												<td>{{ $log->message }}</td>
											</tr>
											<?php
										}
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
								
							
								
								<br />
								<br />

								<h2>Consignes</h2>
								<?php
								$consignes = nl2br(htmlentities($vue_entrainement->consignes));
								$consignes = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $consignes);
								$consignes = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $consignes);
								$consignes = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $consignes);
								$consignes = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $consignes);	
								$consignes = preg_replace( "/\r|\n/", "", $consignes);								
								?>
								<div class="card"><div class="card-body"><?php echo $consignes ?></div></div>							
								
								<br />
								<br />

								<h2>Sujets</h2>								
								<?php
								$vue_sujets = App\Sujet::where('entrainement_id',$vue_entrainement->id)->get();
								foreach ($vue_sujets as $key => $vue_sujet) {
									$sujet = nl2br(htmlentities($vue_sujet->sujet));
									$sujet = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet);
									$sujet = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet);
									$sujet = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet);
									$sujet = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet);	
									$sujet = preg_replace( "/\r|\n/", "", $sujet);	
									?>
									<div class="card mb-2"><div class="card-body"><?php echo $sujet ?></div></div>		
									<?php
								}
							}
							?>
											
						@endif
						
					</div>
				</div>
				
			</div><!-- /container -->
			
		</div><!-- /app -->
		
		@include('inc-bottom-js')
		
		<script>
		function active(id){	
			opacity = document.getElementById("card_"+id).style.opacity;
			if (opacity == 1) {
				opacity_value = 0.5;
			} else {
				opacity_value = 1;
			}
			document.getElementById("card_"+id).style.opacity=opacity_value; 	
			$.ajax({
			   url : '/console',
			   type : 'POST', // Le type de la requête HTTP, ici devenu POST
				data:{
					'entrainement_id': id,
					'_token': '{{ csrf_token() }}',
				},
				success: function(html){
					console.log(html);
				 }
			});
		}

		$(document).ready(function($) {
			check_keyup();
			$("body").on("click", ".ajouter", function() {
				$(this).parent().prev("div").append(
				'<div style="clear:both;">'
				+'<textarea name="sujets[]" class="form-control mb-2" style="float:left;padding-right:30px;" rows="5"></textarea>'			
				+'<i class="material-icons retirer" style="position:relative;display:block;top:2px;width:20px;right:26px;cursor:pointer;">indeterminate_check_box</i>'
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
		</script>
		
	</body>
</html>