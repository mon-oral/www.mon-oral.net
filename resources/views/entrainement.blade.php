<!doctype html>
<html lang="fr">
	<head>
	
		@include('inc-meta')

		<title>Lecteur Audio</title>
		
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
		
			<div class="container">
									
				<div class="row mt-5">
				
					<div class="col-md-6 offset-md-3">
					
					<?php
					$user = Auth::user();
					$log = App\Log::where('code_audio', $code_audio)->first();
					$sujet = App\Sujet::where('id', $log->sujet_id)->first();
					$entrainement = App\Entrainement::where([['id', $log->entrainement_id],['user_id', $user->id]])->first();
					$entrainement_titre = strlen($entrainement->titre) > 37 ? substr($entrainement->titre,0,37)."..." : $entrainement->titre;
				
					$sujet_popover = '';
					$sujet_popover = nl2br(htmlentities($sujet->sujet));
					$sujet_popover = preg_replace('#\_{2}(.*?)\_{2}#', '<u>$1</u>', $sujet_popover);
					$sujet_popover = preg_replace('#\*{3}(.*?)\*{3}#', '<b><em>$1</em></b>', $sujet_popover);
					$sujet_popover = preg_replace('#\*{2}(.*?)\*{2}#', '<b>$1</b>', $sujet_popover);
					$sujet_popover = preg_replace('#\*{1}(.*?)\*{1}#', '<em>$1</em>', $sujet_popover);	
					$sujet_popover = preg_replace( "/\r|\n/", "", $sujet_popover);
					?>					

					@if ($entrainement AND $user->is_checked == 1)
						
						@if (asset("storage/audio-entrainements/") . '/lrpxmensjw/' . $code_audio . '.mp3')
					
							<table>
								<tr>
									<td style="font-size:150%"><i class="fas fa-volume-up mr-4 text-muted"></i></td>
									<td style="width:100%">

										<p class="small text-muted mb-1">
											<a href="/console/afficher/{{ $entrainement->id }}">{{ $entrainement_titre }}</a>
										</p>
										<p class="small text-muted mb-1">
											<i class="fas fa-calendar-day pr-2"></i>{{ date("d-m-Y", strtotime($log->created_at)) }}
											<i class="fas fa-user pl-4 pr-2"></i>{{ $log->nom }}
											<i class="fas fa-tag pl-4 pr-2"></i><a href="#" data-trigger="hover" data-placement="right" data-toggle="popover" data-html="true" data-content="{{ $sujet_popover }}">sujet</a>
										</p>
										<div>						
											<audio controls style="width:100%"><source src="/console/lecteur/{{ $code_audio }}" type="audio/mpeg"></audio>
											<p class="m-0 p-0 text-monospace text-muted text-center small">attendez quelques secondes que le lecteur se charge</p>
										</div>									
									</td>
								</tr>
								<tr>
									<td class="pt-4" style="font-size:150%"><i class="fas fa-link mr-4 text-muted"></i></td>
									<td class="pt-4"><input class="form-inline form-control text-monospace" value="<?php echo url('/') . '/entrainement/' . $code_audio ?>" readonly /></td>
								</tr>
								<tr>
									<td class="pt-4" style="font-size:150%"><i class="fas fa-download mr-4 text-muted"></i></td>
									<td class="pt-4 text-muted">Pour télécharger le fichier audio, cliquez sur les trois petit points verticaux à droite du lecteur.</td>
								</tr>								
							</table>
						
						@else
						
							<div class="alert alert-light text-center" role="alert">Cet enregistrement n'existe pas.</div>
					
						@endif
						
					@endif

						<p class="text-center mt-4">
							<a class="btn btn-primary" href="/console" role="button"><i class="fas fa-arrow-left pr-2"></i>console</a>
						</p>						

					</div>

				</div>
		
			</div><!-- /container -->
			
		</div><!-- /app -->
			
		@include('inc-bottom-js')	
					
	</body>
</html>